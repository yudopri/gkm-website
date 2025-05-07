<?php

namespace App\Http\Controllers\Admin\KualitasPembelajaran;

use App\Http\Controllers\Controller;
use App\Models\IntegrasiPenelitian;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IntegrasiPenelitianController extends Controller
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
            $integrasi = IntegrasiPenelitian::with('user')->where('tahun', $tahun)->get();

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.kualitas-pembelajaran.integrasi-penelitian.index', [
                'integrasi_penelitian' => $integrasi,
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
            $IntegrasiPenelitian = new IntegrasiPenelitian();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.kualitas-pembelajaran.integrasi-penelitian.form', [
                'integrasi_penelitian' => $IntegrasiPenelitian,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.kualitas-pembelajaran.integrasi-penelitian.store', $tahunAjaran),
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
                'judul_penelitian' => 'required|string|max:255',
                'nama_dosen' => 'required|string|max:255',
                'mata_kuliah' => 'required|string|max:255',
                'bentuk_integrasi' => 'required|string|max:255',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }
            $validated = $request->all();
            $validated['user_id'] = Auth::id();

            $create = IntegrasiPenelitian::create($validated);

            if ($create) {
                return redirect()->route('admin.kualitas-pembelajaran.integrasi-penelitian.index', $tahunAjaran)
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
            $dosen = User::with('profile', 'integrasi_penelitian')->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.kualitas-pembelajaran.integrasi-penelitian.detail', [
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
        $IntegrasiPenelitian = IntegrasiPenelitian::with('user')->find($id);
        $userId = Auth::id();
        $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
        $tahunAjaranId = $tahunAjaranObj->id;
        $tahun = $tahunAjaranObj->tahun_ajaran;
        if (!$IntegrasiPenelitian) {
            return back()->withErrors('Data tidak ditemukan.');
        }

        return view('pages.admin.kualitas-pembelajaran.integrasi-penelitian.form', [
            'integrasi_penelitian' => $IntegrasiPenelitian,
            'tahun_ajaran' => $tahunAjaran,
            'tahun' => $tahun,
            'form_title' => 'Edit Data',
            'form_action' => route('admin.kualitas-pembelajaran.integrasi-penelitian.update', [
                'penelitianId' => $IntegrasiPenelitian->id,
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
                'judul_penelitian' => 'required|string|max:255',
                'nama_dosen' => 'required|string|max:255',
                'mata_kuliah' => 'required|string|max:255',
                'bentuk_integrasi' => 'required|string|max:255',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }
            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $IntegrasiPenelitian = IntegrasiPenelitian::findOrFail($id);
            $update = $PenelitianDtps->update($validated);

            if ($update) {
                return redirect()->route('admin.kualitas-pembelajaran.integrasi-penelitian.index', $tahunAjaran)
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
        $IntegrasiPenelitian = IntegrasiPenelitian::findOrFail($id);
        $delete = $IntegrasiPenelitian->delete();

        if ($delete) {
            return redirect()->route('admin.kualitas-pembelajaran.integrasi-penelitian.index', $tahunAjaran)
                ->with('toast_success', 'Data penelitian dtps berhasil ditambahkan');
        }
        throw new \Exception('Data penelitian dtps gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
