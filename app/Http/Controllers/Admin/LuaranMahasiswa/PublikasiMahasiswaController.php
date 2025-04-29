<?php

namespace App\Http\Controllers\Admin\LuaranMahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\PublikasiMahasiswa;

class PublikasiMahasiswaController extends Controller
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
        $publikasi = PublikasiMahasiswa::with('user')->where('tahun', $tahun)->get();
        // Get the totals grouped by 'jenis_artikel' for the given year and user
        $total = PublikasiMahasiswa::where('user_id', $userId)
    ->whereNull('deleted_at')
    ->where('tahun', $tahun)
    ->count();



        // Return the view with just the total counts and unique 'jenis_artikel'
        return view('pages.admin.luaran-mahasiswa.publikasi.index', [
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
            $publikasi = new PublikasiMahasiswa();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.luaran-mahasiswa.publikasi.form', [
                'publikasi_ilmiah' => $publikasi,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.luaran-mahasiswa.publikasi.store', $tahunAjaran),
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
                'nama_mahasiswa' => 'required|string',
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

            $create = PublikasiMahasiswa::create($validated);
            if ($create) {
                return redirect()->route('admin.luaran-mahasiswa.publikasi.index', $tahunAjaran)
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
            $dosen = User::with('profile', 'publikasi_mahasiswa')->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.luaran-mahasiswa.publikasi.detail', [
                'data_dosen' => $dosen,
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
            $publikasi = PublikasiMahasiswa::with('user')->first();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;

            return view('pages.admin.luaran-mahasiswa.publikasi.form', [
                'publikasi_ilmiah' => $publikasi,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.luaran-mahasiswa.publikasi.update', [
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
                'nama_mahasiswa' => 'required|string',
                'judul_artikel' => 'required|string',
                'jenis_artikel' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $dosenPraktisi = PublikasiMahasiswa::findOrFail($id);
            $update = $dosenPraktisi->update($validated);
            if ($update) {
                return redirect()->route('admin.luaran-mahasiswa.publikasi.index', $tahunAjaran)
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
            $publikasi = PublikasiMahasiswa::findOrFail($id);
            $delete = $dosenPraktisi->delete();

            if ($delete) {
                return redirect()->route('admin.kinerja-dosen.publikasi.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen praktisi berhasil dihapus');
            }

            throw new \Exception('Data dosen praktisi gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
