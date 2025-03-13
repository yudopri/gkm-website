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

            $penelitianDtps = PenelitianDtps::with('user')
                ->where('user_id', $userId)
                ->paginate(5);
            $totals = PenelitianDtps::selectRaw('
                SUM(jumlah_judul) as total,
            ')->first();
            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.kinerja-dosen.penelitian-dtps.index', [
                'penelitian_dtps' => $penelitianDtps,
                'tahun_ajaran' => $tahunAjaran,
                'total' => $totals,
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
            return view('pages.admin.kinerja-dosen.penelitian-dtps.form', [
                'penelitian_dtps' => $penelitianDtps,
                'tahun_ajaran' => $tahunAjaran,
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
    public function store(Request $request,string $tahunAjaran)
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

            $create = PenelitianDtps::create($validated);

            if ($create) {
                return redirect()->route('admin.kinerja-dosen.penelitian-dtps.index', $tahunAjaran)
                    ->with('toast_success', 'Data penelitian dtps berhasil ditambahkan');
            }

            throw new \Exception('Data penelitian dtps gagal ditambahkan');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,string $tahunAjaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id,string $tahunAjaran)
    {
        try {
            $penelitianDtps = PenelitianDtps::with('user')->findOrFail($id);

            return view('pages.admin.kinerja-dosen.penelitian-dosen.form', [
                'penelitian_dtps' => $penelitianDtps,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.kinerja-dosen.penelitian-dtps.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'penelitianId' => $penelitianDtps->id,
                ]),
                'form_method' => "PUT",
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,string $tahunAjaran)
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
    public function destroy(string $id,string $tahunAjaran)
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
