<?php

namespace App\Http\Controllers\Admin\LuaranMahasiswa\LuaranLain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\TeknologiKaryaMahasiswa;


class TeknologiKaryaMahasiswaController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $tnk = TeknologiKaryaMahasiswa::with('user')->get();

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.luaran-mahasiswa.luaran-lain.teknologi-karya.index', [
                'teknologi_karya' => $tnk,
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
            $TeknologiKaryaMahasiswa = new TeknologiKaryaMahasiswa();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.luaran-mahasiswa.luaran-lain.teknologi-karya.form', [
                'teknologi_karya' => $TeknologiKaryaMahasiswa,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.luaran-mahasiswa.luaran-lain.teknologi-karya.store', $tahunAjaran),
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
                'luaran_penelitian' => 'required|string|max:255',
                'keterangan' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            // dd($validated);

            $create = TeknologiKaryaMahasiswa::create($validated);
            if ($create) {
                return redirect()->route('admin.luaran-mahasiswa.luaran-lain.teknologi-karya.index', $tahunAjaran)
                    ->with('toast_success', 'Data teknologi_karya dtps berhasil ditambahkan');
            }

            throw new \Exception('Data teknologi_karya dtps gagal ditambahkan');
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
            $dosen = User::with('profile', 'teknologi_karya_mahasiswa')->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.luaran-mahasiswa.luaran-lain.teknologi-karya.detail', [
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
            $teknologi_karya = TeknologiKaryaMahasiswa::with('user')->find($id);
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.luaran-mahasiswa.luaran-lain.teknologi-karya.form', [
                'teknologi_karya' => $teknologi_karya,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.luaran-mahasiswa.luaran-lain.teknologi-karya.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'karyaId' => $teknologi_karya->id,
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
                'luaran_penelitian' => 'required|string|max:255',
                'keterangan' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $dosenPraktisi = TeknologiKaryaMahasiswa::findOrFail($id);
            $update = $dosenPraktisi->update($validated);
            if ($update) {
                return redirect()->route('admin.luaran-mahasiswa.luaran-lain.teknologi-karya.index', $tahunAjaran)
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
            $dosenPraktisi = TeknologiKaryaMahasiswa::findOrFail($id);
            $delete = $dosenPraktisi->delete();

            if ($delete) {
                return redirect()->route('admin.luaran-mahasiswa.luaran-lain.teknologi-karya.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen praktisi berhasil dihapus');
            }

            throw new \Exception('Data dosen praktisi gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
