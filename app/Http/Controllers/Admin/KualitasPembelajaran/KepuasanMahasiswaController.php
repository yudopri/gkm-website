<?php

namespace App\Http\Controllers\Admin\KualitasPembelajaran;

use App\Http\Controllers\Controller;
use App\Models\KepuasanMahasiswa;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KepuasanMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
        $tahunAjaranId = $tahunAjaranObj->id;
        $tahun = $tahunAjaranObj->tahun_ajaran;
            $kepuasan = KepuasanMahasiswa::with('user')->where('tahun', $tahun)->get();

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.kualitas-pembelajaran.kepuasan-mahasiswa.index', [
                'kepuasan_mahasiswa' => $kepuasan,
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
            $KepuasanMahasiswa = new KepuasanMahasiswa();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.kualitas-pembelajaran.kepuasan-mahasiswa.form', [
                'kepuasan_mahasiswa' => $KepuasanMahasiswa,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.kualitas-pembelajaran.kepuasan-mahasiswa.store', $tahunAjaran),
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
                'aspek_penilaian' => 'required|string|max:255',
                'tingkat_kepuasan_sangat_baik' => 'nullable|integer',
                'tingkat_kepuasan_baik' => 'nullable|integer',
                'tingkat_kepuasan_cukup' => 'nullable|integer',
                'tingkat_kepuasan_kurang' => 'nullable|integer',
                'rencana_tindakan' => 'nullable|string|max:255',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }
            $validated = $request->all();
            $validated['user_id'] = Auth::id();

            $create = KepuasanMahasiswa::create($validated);

            if ($create) {
                return redirect()->route('admin.kualitas-pembelajaran.kepuasan-mahasiswa.index', $tahunAjaran)
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
    public function show(string $id)
    {
        try {
            $dosen = User::with('profile', 'kepuasan_mahasiswa')->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.kualitas-pembelajaran.kepuasan-mahasiswa.detail', [
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
        // Gunakan find() agar bisa menangani null
        $KepuasanMahasiswa = KepuasanMahasiswa::with('user')->find($id);
        $userId = Auth::id();
        $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
        $tahunAjaranId = $tahunAjaranObj->id;
        $tahun = $tahunAjaranObj->tahun_ajaran;
        if (!$KepuasanMahasiswa) {
            return back()->withErrors('Data tidak ditemukan.');
        }

        return view('pages.admin.kualitas-pembelajaran.kepuasan-mahasiswa.form', [
            'kepuasan_mahasiswa' => $KepuasanMahasiswa,
            'tahun_ajaran' => $tahunAjaran,
            'tahun' => $tahun,
            'form_title' => 'Edit Data',
            'form_action' => route('admin.kualitas-pembelajaran.kepuasan-mahasiswa.update', [
                'kepuasanId' => $KepuasanMahasiswa->id,
                'tahunAjaran' => $tahunAjaran,
            ]),
            'form_method' => "PUT",
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
                'aspek_penilaian' => 'required|string|max:255',
                'tingkat_kepuasan_sangat_baik' => 'nullable|integer',
                'tingkat_kepuasan_baik' => 'nullable|integer',
                'tingkat_kepuasan_cukup' => 'nullable|integer',
                'tingkat_kepuasan_kurang' => 'nullable|integer',
                'rencana_tindakan' => 'nullable|string|max:255',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }
            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $KepuasanMahasiswa = KepuasanMahasiswa::findOrFail($id);
            $update = $PenelitianDtps->update($validated);

            if ($update) {
                return redirect()->route('admin.kualitas-pembelajaran.kepuasan-mahasiswa.index', $tahunAjaran)
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
        $KepuasanMahasiswa = KepuasanMahasiswa::findOrFail($id);
        $delete = $KepuasanMahasiswa->delete();

        if ($delete) {
            return redirect()->route('admin.kualitas-pembelajaran.kepuasan-mahasiswa.index', $tahunAjaran)
                ->with('toast_success', 'Data penelitian dtps berhasil ditambahkan');
        }
        throw new \Exception('Data penelitian dtps gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
