<?php

namespace App\Http\Controllers\Admin\DataMahasiswa;

use App\Http\Controllers\Controller;
use App\Models\MahasiswaAsing;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MahasiswaAsingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranId = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

            $mhsAsing = MahasiswaAsing::with('user')
                ->where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->paginate(5);

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.dosen.data-mahasiswa.mhs-asing.index', [
                'mhs_asing' => $mhsAsing,
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
            $mhsAsing = new MahasiswaAsing();
            return view('pages.admin.data-mahasiswa.mhs-asing.form', [
                'mhs' => $mhsAsing,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.dosen.dm.mahasiswa-asing.store', $tahunAjaran),
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
                'mhs_aktif' => 'nullable|numeric',
                'mhs_asing_fulltime' => 'nullable|numeric',
                'mhs_asing_parttime' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $validated['tahun_ajaran_id'] = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;
            $create = MahasiswaAsing::create($validated);

            if ($create) {
                return redirect()->route('admin.dosen.dm.mahasiswa-asing.index', $tahunAjaran)
                    ->with('toast_success', 'Data mahasiswa asing berhasil ditambahkan');
            }

            throw new \Exception('Data gagal ditambahhkan');
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
            $dosen = User::with('profile', 'seleksi_maba')->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.data-mahasiswa.detail-mhs-asing', [
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
    public function edit(string $id)
    {
        try {
            $mhsAsing = MahasiswaAsing::with('user')->whereId($id)->first();
            return view('pages.admin.data-mahasiswa.mhs-asing.form', [
                'mhs' => $mhsAsing,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.data-mahasiswa.mahasiswa-asing.update', $mhsAsing->id),
                'form_method' => "PUT",
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'mhs_aktif' => 'nullable|numeric',
                'mhs_asing_fulltime' => 'nullable|numeric',
                'mhs_asing_parttime' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $mhsAsing = MahasiswaAsing::findOrFail($id);
            $update = $mhsAsing->update($validated);
            if ($update) {
                return redirect()->route('admin.data-mahasiswa.mahasiswa-asing.index')
                    ->with('toast_success', 'Data mahasiswa asing berhasil diupdate');
            }

            throw new \Exception('Data mahasiswa asing gagal diupdate');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $mhsAsing = MahasiswaAsing::findOrFail($id);
            $delete = $mhsAsing->delete();

            if ($delete) {
                return redirect()->route('admin.data-mahasiswa.mahasiswa-asing.index')
                    ->with('toast_success', 'Data mahasiswa asing berhasil dihapus');
            }

            throw new \Exception('Data mahasiswa asing gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
