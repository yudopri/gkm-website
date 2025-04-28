<?php

namespace App\Http\Controllers\Admin\KualitasPembelajaran;

use App\Http\Controllers\Controller;
use App\Models\KurikulumPembelajaran;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KurikulumPembelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $kurikulum = KurikulumPembelajaran::with('user')->get();

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.kualitas-pembelajaran.kurikulum-pembelajaran.index', [
                'kurikulum_pembelajaran' => $kurikulum,
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
            $KurikulumPembelajaran = new KurikulumPembelajaran();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.kualitas-pembelajaran.kurikulum-pembelajaran.form', [
                'kurikulum' => $KurikulumPembelajaran,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.kualitas-pembelajaran.kurikulum-pembelajaran.store', $tahunAjaran),
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
                'nama_mata_kuliah' => 'required|string|max:255',
                'kode_mata_kuliah' => 'required|string|max:255',
                'mata_kuliah_kompetensi' => 'nullable|boolean',
                'sks_kuliah' => 'nullable|integer',
                'sks_praktikum' => 'nullable|integer',
                'sks_seminar' => 'nullable|integer',
                'konversi_sks' => 'required|integer',
                'semester' => 'required|integer',
                'metode_pembelajaran' => 'required|string|max:255',
                'dokumen' => 'required|string|max:255',
                'unit_penyelenggara' => 'required|string|max:255',
                'capaian_kuliah_sikap' => 'nullable|boolean',
                'capaian_kuliah_pengetahuan' => 'nullable|boolean',
                'capaian_kuliah_keterampilan' => 'nullable|boolean',
                'capaian_kuliah_keterampilan_khusus' => 'nullable|boolean',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            // dd($validated);

            $create = KurikulumPembelajaran::create($validated);
            if ($create) {
                return redirect()->route('admin.kualitas-pembelajaran.kurikulum-pembelajaran.index', $tahunAjaran)
                    ->with('toast_success', 'Data kurikulum dtps berhasil ditambahkan');
            }

            throw new \Exception('Data kurikulum dtps gagal ditambahkan');
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
            $dosen = User::with('profile', 'kurikulum_pembelajaran')->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.kualitas-pembelajaran.kurikulum-pembelajaran.detail', [
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
            $kurikulum = KurikulumPembelajaran::with('user')->first();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.kualitas-pembelajaran.kurikulum-pembelajaran.form', [
                'kurikulum' => $kurikulum,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.kualitas-pembelajaran.kurikulum-pembelajaran.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'kurikulumId' => $kurikulum->id,
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
    public function update(Request $request,string $tahunAjaran,string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_mata_kuliah' => 'required|string|max:255',
                'kode_mata_kuliah' => 'required|string|max:255',
                'mata_kuliah_kompetensi' => 'nullable|boolean',
                'sks_kuliah' => 'nullable|integer',
                'sks_praktikum' => 'nullable|integer',
                'sks_seminar' => 'nullable|integer',
                'konversi_sks' => 'required|integer',
                'semester' => 'required|integer',
                'metode_pembelajaran' => 'required|string|max:255',
                'dokumen' => 'required|string|max:255',
                'unit_penyelenggara' => 'required|string|max:255',
                'capaian_kuliah_sikap' => 'nullable|boolean',
                'capaian_kuliah_pengetahuan' => 'nullable|boolean',
                'capaian_kuliah_keterampilan' => 'nullable|boolean',
                'capaian_kuliah_keterampilan_khusus' => 'nullable|boolean',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $dosenPraktisi = KurikulumPembelajaran::findOrFail($id);
            $update = $dosenPraktisi->update($validated);
            if ($update) {
                return redirect()->route('admin.kualitas-pembelajaran.kurikulum-pembelajaran.index', $tahunAjaran)
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
    public function destroy(string $id,string $tahunAjaran)
    {
        try {
            $dosenPraktisi = KurikulumPembelajaran::findOrFail($id);
            $delete = $dosenPraktisi->delete();

            if ($delete) {
                return redirect()->route('admin.kualitas-pembelajaran.kurikulum-pembelajaran.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen praktisi berhasil dihapus');
            }

            throw new \Exception('Data dosen praktisi gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
