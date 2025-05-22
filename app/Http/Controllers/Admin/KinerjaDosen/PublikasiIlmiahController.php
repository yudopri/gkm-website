<?php

namespace App\Http\Controllers\Admin\KinerjaDosen;

use App\Http\Controllers\Controller;
use App\Models\PublikasiIlmiahDosen;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PublikasiIlmiahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
{
    try {
        // Fetch the Year Object and ensure it's valid
        $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
        $tahunAjaranId = $tahunAjaranObj->id;
        $tahun = $tahunAjaranObj->tahun_ajaran;

        $userId = Auth::id();
        $publikasi = PublikasiIlmiahDosen::with('user')->where('tahun', $tahun)->get();
        // Get the totals grouped by 'jenis_artikel' for the given year and user
        $total = PublikasiIlmiahDosen::where('user_id', $userId)
    ->where('tahun', $tahun)
    ->whereNull('deleted_at')
    ->get()
    ->sum(function ($item) {
        $raw = trim($item->judul_artikel);
        $sanitized = str_replace(',', '.', $raw);
        $sanitized = preg_replace('/[^0-9.]/', '', $sanitized);
        return is_numeric($sanitized) ? (float) $sanitized : 0;
    });





        // Return the view with just the total counts and unique 'jenis_artikel'
        return view('pages.admin.kinerja-dosen.publikasi-ilmiah.index', [
            'publikasi' => $publikasi,
            'totals' => $total,
            'tahun_ajaran' => $tahunAjaran,
            'tahun' => $tahun,
        ]);
    } catch (\Exception $e) {
        // Log the error for debugging purposes
        \Log::error('Error fetching Publikasi Ilmiah Dosen data: ' . $e->getMessage());

        // Return back with the error message
        return back()->withErrors($e->getMessage());
    }
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $tahunAjaran)
    {
        try {
            $publikasi = new PublikasiIlmiahDosen();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.kinerja-dosen.publikasi-ilmiah.form', [
                'publikasi_ilmiah' => $publikasi,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.kinerja-dosen.publikasi-ilmiah.store', $tahunAjaran),
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
                'nama_dosen' => 'required|string',
                'judul_artikel' => 'required|string',
                'jenis_artikel' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            // dd($validated);

            $create = PublikasiIlmiahDosen::create($validated);
            if ($create) {
                return redirect()->route('admin.kinerja-dosen.publikasi-ilmiah.index', $tahunAjaran)
                    ->with('toast_success', 'Data rekognisi dtps berhasil ditambahkan');
            }

            throw new \Exception('Data rekognisi dtps gagal ditambahkan');
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
        $dosen = User::with(['profile', 'publikasi_ilmiah'=> function ($query) {
        $query->whereNotNull('tahun');
    }])->findOrFail($id);

        $total = $dosen->publikasi_ilmiah
            ->filter(function ($item) {
                return is_null($item->deleted_at);
            })
            ->sum(function ($item) {
                $raw = trim($item->judul_artikel);

                // Ganti koma jadi titik jika ada, dan buang karakter selain angka dan titik
                $sanitized = str_replace(',', '.', $raw);
                $sanitized = preg_replace('/[^0-9.]/', '', $sanitized);

                return is_numeric($sanitized) ? (float) $sanitized : 0;
            });

        return view('pages.admin.petugas.kinerja-dosen.publikasi-ilmiah.detail', [
            'data_dosen' => $dosen,
            'totals'     => $total,
            'dosenId'    => $dosen->id,
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
            $publikasi = PublikasiIlmiahDosen::with('user')->first();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;

            return view('pages.admin.kinerja-dosen.publikasi-ilmiah.form', [
                'publikasi_ilmiah' => $publikasi,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.kinerja-dosen.publikasi-ilmiah.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'publikasiId' => $publikasi->id,
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
    public function update(Request $request, string $tahunAjaran,string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_dosen' => 'required|string',
                'judul_artikel' => 'required|string',
                'jenis_artikel' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $dosenPraktisi = PublikasiIlmiahDosen::findOrFail($id);
            $update = $dosenPraktisi->update($validated);
            if ($update) {
                return redirect()->route('admin.kinerja-dosen.publikasi-ilmiah.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen praktisi berhasil diupdate');
            }

            throw new \Exception('Data dosen praktisi gagal diupdate');
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
            $publikasi = PublikasiIlmiahDosen::findOrFail($id);
            $delete = $publikasi->delete();

            if ($delete) {
                return redirect()->route('admin.kinerja-dosen.publikasi-ilmiah.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen praktisi berhasil dihapus');
            }

            throw new \Exception('Data dosen praktisi gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
