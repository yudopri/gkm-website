<?php

namespace App\Http\Controllers\Admin\DataMahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SeleksiMahasiswaBaru;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SeleksiMabaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranId = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

            $seleksiMaba = SeleksiMahasiswaBaru::with('user')
                ->where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->paginate(5);

            $totals = SeleksiMahasiswaBaru::selectRaw('
                SUM(pendaftar) as total_pendaftar,
                SUM(lulus_seleksi) as total_lulus_seleksi,
                SUM(maba_reguler) as total_maba_reguler,
                SUM(maba_transfer) as total_maba_transfer,
                SUM(COALESCE(mhs_aktif_reguler, 0) + COALESCE(mhs_aktif_transfer, 0)) as total_mhs_aktif
            ')->first();

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.dosen.data-mahasiswa.seleksi-maba.index', [
                'seleksi_maba' => $seleksiMaba,
                'tahun_ajaran' => $tahunAjaran,
                'total' => $totals
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
            $seleksiMaba = new SeleksiMahasiswaBaru();
            return view('pages.admin.dosen.data-mahasiswa.seleksi-maba.form', [
                'seleksi' => $seleksiMaba,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.dosen.dm.seleksi-maba.store', $tahunAjaran),
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
                'tahun_akademik' => 'required|string',
                'daya_tampung' => 'required|numeric',
                'pendaftar' => 'nullable|numeric',
                'lulus_seleksi' => 'nullable|numeric',
                'maba_reguler' => 'nullable|numeric',
                'maba_transfer' => 'nullable|numeric',
                'mhs_aktif_reguler' => 'nullable|numeric',
                'mhs_aktif_transfer' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $validated['tahun_ajaran_id'] = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;
            $create = SeleksiMahasiswaBaru::create($validated);

            if ($create) {
                return redirect()->route('admin.dosen.dm.seleksi-maba.index', $tahunAjaran)
                    ->with('toast_success', 'Data seleksi maba berhasil ditambahkan');
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
            $dosen = User::with('profile', 'mahasiswa_asing')->whereId($id)->firstOrFail();

            $totals = SeleksiMahasiswaBaru::selectRaw('
                SUM(pendaftar) as total_pendaftar,
                SUM(lulus_seleksi) as total_lulus_seleksi,
                SUM(maba_reguler) as total_maba_reguler,
                SUM(maba_transfer) as total_maba_transfer,
                SUM(COALESCE(mhs_aktif_reguler, 0) + COALESCE(mhs_aktif_transfer, 0)) as total_mhs_aktif
            ')->first();

            // dd($dosen);

            return view('pages.admin.petugas.data-mahasiswa.detail-seleksi-maba', [
                'data_dosen' => $dosen,
                'dosenId' => $dosen->id,
                'total' => $totals,
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
            $seleksiMaba = SeleksiMahasiswaBaru::with('user')->whereId($id)->first();
            return view('pages.admin.data-mahasiswa.seleksi-maba.form', [
                'seleksi' => $seleksiMaba,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.data-mahasiswa.seleksi-mahasiswa-baru.update', $seleksiMaba->id),
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
                'tahun_akademik' => 'required|string',
                'daya_tampung' => 'required|numeric',
                'pendaftar' => 'nullable|numeric',
                'lulus_seleksi' => 'nullable|numeric',
                'maba_reguler' => 'nullable|numeric',
                'maba_transfer' => 'nullable|numeric',
                'mhs_aktif_reguler' => 'nullable|numeric',
                'mhs_aktif_transfer' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $seleksiMaba = SeleksiMahasiswaBaru::findOrFail($id);
            $update = $seleksiMaba->update($validated);
            if ($update) {
                return redirect()->route('admin.data-mahasiswa.seleksi-mahasiswa-baru.index')
                    ->with('toast_success', 'Data seleksi maba berhasil diupdate');
            }

            throw new \Exception('Data seleksi maba gagal diupdate');
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
            $seleksiMaba = SeleksiMahasiswaBaru::findOrFail($id);
            $delete = $seleksiMaba->delete();

            if ($delete) {
                return redirect()->route('admin.data-mahasiswa.seleksi-mahasiswa-baru.index')
                    ->with('toast_success', 'Data seleksi maba berhasil dihapus');
            }

            throw new \Exception('Data seleksi maba gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
