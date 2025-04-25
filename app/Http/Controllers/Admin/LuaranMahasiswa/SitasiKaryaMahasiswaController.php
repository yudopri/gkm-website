<?php

namespace App\Http\Controllers\Admin\LuaranMahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\SitasiKaryaMahasiswa;

class SitasiKaryaMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $sitasi = SitasiKaryaMahasiswa::with('user')->get();
            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.luaran-mahasiswa.sitasi-karya.index', [
                'sitasi_karya' => $sitasi,
                'tahun_ajaran' => $tahunAjaran,
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
            $SitasiKaryaMahasiswa = new SitasiKaryaMahasiswa();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.luaran-mahasiswa.sitasi-karya.form', [
                'sitasi' => $SitasiKaryaMahasiswa,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.luaran-mahasiswa.sitasi-karya.store', $tahunAjaran),
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
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'nama_mahasiswa' => 'required|string|max:255',
                'judul_artikel' => 'required|string|max:255',
                'jumlah_sitasi' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            // dd($validated);

            $create = SitasiKaryaMahasiswa::create($validated);
            if ($create) {
                return redirect()->route('admin.luaran-mahasiswa.sitasi-karya.index', $tahunAjaran)
                    ->with('toast_success', 'Data sitasi dtps berhasil ditambahkan');
            }

            throw new \Exception('Data sitasi dtps gagal ditambahkan');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $tahunAjaran,string $id)
    {
        try {
            $sitasi = SitasiKaryaMahasiswa::with('user')->find($id);
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.luaran-mahasiswa.sitasi-karya.form', [
                'sitasi' => $sitasi,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.luaran-mahasiswa.sitasi-karya.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'sitasiId' => $sitasi->id,
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
    public function update(Request $request, string $tahunAjaran, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_mahasiswa' => 'required|string|max:255',
                'judul_artikel' => 'required|string|max:255',
                'jumlah_sitasi' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $mahasiswaPraktisi = SitasiKaryaMahasiswa::findOrFail($id);
            $update = $mahasiswaPraktisi->update($validated);
            if ($update) {
                return redirect()->route('admin.luaran-mahasiswa.sitasi-karya.index', $tahunAjaran)
                    ->with('toast_success', 'Data mahasiswa praktisi berhasil diupdate');
            }

            throw new \Exception('Data mahasiswa praktisi gagal diupdate');
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
            $mahasiswaPraktisi = SitasiKaryaMahasiswa::findOrFail($id);
            $delete = $mahasiswaPraktisi->delete();

            if ($delete) {
                return redirect()->route('admin.luaran-mahasiswa.sitasi-karya.index', $tahunAjaran)
                    ->with('toast_success', 'Data mahasiswa praktisi berhasil dihapus');
            }

            throw new \Exception('Data dosen praktisi gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
