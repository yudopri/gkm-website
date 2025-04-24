<?php

namespace App\Http\Controllers\Admin\KinerjaDosen;

use App\Http\Controllers\Controller;
use App\Models\PenelitianDtps;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PenelitianDtpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranId = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            $penelitianDtps = PenelitianDtps::whereIn('id', function ($query) use ($userId,$tahun) {
                $query->selectRaw('MAX(id)') // Ambil ID terbesar (terbaru)
                    ->from('penelitian_dtps')
                    ->where('user_id', $userId)
                    ->where('tahun_penelitian', $tahun)
                    ->whereNull('deleted_at')
                    ->groupBy('sumber_dana');
            })->get();

        // Ambil total jumlah_judul per sumber_dana dalam bentuk array
        $totals = PenelitianDtps::where('user_id', $userId)
            ->where('tahun_penelitian', $tahun)
            ->whereNull('deleted_at')
            ->groupBy('sumber_dana')
            ->selectRaw('sumber_dana, SUM(jumlah_judul) as total')
            ->pluck('total', 'sumber_dana'); // Mengubah ke bentuk [sumber_dana => total]

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.kinerja-dosen.penelitian-dtps.index', [
                'penelitian_dtps' => $penelitianDtps,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'totals' => $totals,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $tahunAjaran)
    {
        try {
            $penelitianDtps = new PenelitianDtps();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.kinerja-dosen.penelitian-dtps.form', [
                'penelitian_dtps' => $penelitianDtps,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.kinerja-dosen.penelitian-dtps.store', $tahunAjaran),
                'form_method' => "POST",
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $tahunAjaran)
{
    try {
        $validator = Validator::make($request->all(), [
            'jumlah_judul' => 'required|integer',
            'sumber_dana' => 'required|string|in:lokal,nasional,internasional',
            'tahun_penelitian' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages()->all()[0])->withInput();
        }

        $validated = $request->only(['jumlah_judul', 'sumber_dana', 'tahun_penelitian']);
        $validated['user_id'] = Auth::id();

        // Cari data yang sudah ada
        $existing = PenelitianDtps::where('user_id', $validated['user_id'])
            ->where('tahun_penelitian', $validated['tahun_penelitian'])
            ->where('sumber_dana', $validated['sumber_dana'])
            ->first();

        if ($existing) {
            // Tambahkan jumlah_judul
            $existing->jumlah_judul += $validated['jumlah_judul'];
            $existing->save();
        } else {
            // Buat data baru
            PenelitianDtps::create($validated);
        }

        return redirect()->route('admin.kinerja-dosen.penelitian-dtps.index', $tahunAjaran)
            ->with('toast_success', 'Data penelitian dtps berhasil disimpan');
    } catch (\Exception $e) {
        return back()->withErrors($e->getMessage())->withInput();
    }
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $dosen = User::with('profile', 'penelitian_dtp')->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.kinerja-dosen.penelitian-dtps.show', [
                'penelitian' => $dosen,
                'dosenId' => $dosen->id,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $tahunAjaran,string $id)
{
    try {
        // Gunakan find() agar bisa menangani null
        $penelitianDtps = PenelitianDtps::with('user')->find($id);
        $userId = Auth::id();
        $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
        $totals = PenelitianDtps::where('user_id', $userId)
        ->where('tahun_penelitian', $tahun)
        ->whereNull('deleted_at')
        ->groupBy('sumber_dana')
        ->selectRaw('sumber_dana, SUM(jumlah_judul) as total')
        ->pluck('total', 'sumber_dana'); // Mengubah ke bentuk [sumber_dana => total]

        if (!$penelitianDtps) {
            return back()->withErrors('Data tidak ditemukan.');
        }

        return view('pages.admin.kinerja-dosen.penelitian-dtps.form', [
            'penelitian_dtps' => $penelitianDtps,
            'tahun_ajaran' => $tahunAjaran,
            'tahun' => $tahun,
            'form_title' => 'Edit Data',
            'form_action' => route('admin.kinerja-dosen.penelitian-dtps.update', [
                'penelitianId' => $penelitianDtps->id,
                'tahunAjaran' => $tahunAjaran,
            ]),
            'form_method' => "PUT",
            'totals' => $totals,
        ]);
    } catch (\Exception $e) {
        return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $tahunAjaran,string $id)
    {
        try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'jumlah_judul' => 'required|integer',
                'sumber_dana' => 'required|string|in:lokal,nasional,internasional',
                'tahun_penelitian' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }
            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $PenelitianDtps = PenelitianDtps::findOrFail($id);
            $update = $PenelitianDtps->update($validated);

            if ($update) {
                return redirect()->route('admin.kinerja-dosen.penelitian-dtps.index', $tahunAjaran)
                    ->with('toast_success', 'Data penelitian dtps berhasil ditambahkan');
            }

            throw new \Exception('Data penelitian dtps gagal diubah');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $tahunAjaran,string $id)
    {
        try {
        $PenelitianDtps = PenelitianDtps::findOrFail($id);
        $delete = $PenelitianDtps->delete();

        if ($delete) {
            return redirect()->route('admin.kinerja-dosen.penelitian-dtps.index', $tahunAjaran)
                ->with('toast_success', 'Data penelitian dtps berhasil ditambahkan');
        }
        throw new \Exception('Data penelitian dtps gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
