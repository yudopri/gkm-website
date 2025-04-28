<?php

namespace App\Http\Controllers\Admin\KinerjaLulusan\PrestasiMahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PrestasiNonakademikMhs;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class NonakademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $prestasiNonakademik = PrestasiNonakademikMhs::with('user')->get();

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.kinerja-lulusan.prestasi-nonakademik-mhs.index', [
                'prestasi_nonakademik' => $prestasiNonakademik,
                'tahun_ajaran' => $tahunAjaran,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function create(string $tahunAjaran)
    {
        try {
            $PrestasiNonakademikMhs = new PrestasiNonakademikMhs();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.kinerja-lulusan.prestasi-nonakademik-mhs.form', [
                'nonakademik' => $PrestasiNonakademikMhs,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.kinerja-lulusan.prestasi-mahasiswa.nonakademik.store', $tahunAjaran),
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
                'nama_kegiatan' => 'required|string',
                'tingkat' => 'required|string',
                'prestasi' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            // dd($validated);

            $create = PrestasiNonakademikMhs::create($validated);
            if ($create) {
                return redirect()->route('admin.kinerja-lulusan.prestasi-mahasiswa.nonakademik.index', $tahunAjaran)
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
            $dosen = User::with('profile', 'prestasi_nonakademik')->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.kinerja-lulusan.prestasi-nonakademik-mhs.detail', [
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
            $PrestasiNonakademikMhs = PrestasiNonakademikMhs::with('user')->first();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;

            return view('pages.admin.kinerja-lulusan.prestasi-nonakademik-mhs.form', [
                'nonakademik' => $PrestasiNonakademikMhs,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.kinerja-lulusan.prestasi-mahasiswa.nonakademik.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'nonakademikId' => $PrestasiAkademikMhs->id,
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
                'nama_kegiatan' => 'required|string',
                'tingkat' => 'required|string',
                'prestasi' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $dosenPraktisi = PrestasiAkademikMhs::findOrFail($id);
            $update = $dosenPraktisi->update($validated);
            if ($update) {
                return redirect()->route('admin.kinerja-lulusan.prestasi-mahasiswa.nonakademik.index', $tahunAjaran)
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
            $PrestasiAkademikMhs = PrestasiAkademikMhs::findOrFail($id);
            $delete = $PrestasiAkademikMhs->delete();

            if ($delete) {
                return redirect()->route('admin.kinerja-lulusan.prestasi-mahasiswa.nonakademik.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen praktisi berhasil dihapus');
            }

            throw new \Exception('Data dosen praktisi gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
