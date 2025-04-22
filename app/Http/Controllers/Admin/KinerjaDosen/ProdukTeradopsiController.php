<?php

namespace App\Http\Controllers\Admin\KinerjaDosen;

use App\Http\Controllers\Controller;
use App\Models\ProdukTeradopsiDosen;
use Illuminate\Http\Request;

class ProdukTeradopsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $produk = ProdukTeradopsiDosen::with('user')->get();

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.kinerja-dosen.produk-teradopsi.index', [
                'produk_teradopsi' => $produk,
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
            $produk = new ProdukTeradopsiDosen();
            return view('pages.admin.kinerja-dosen.produk-teradopsi.form', [
                'produk_teradopsi' => $produk,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.kinerja-dosen.produk-teradopsi.store', $tahunAjaran),
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
                'nama_produk' => 'required|string',
                'deskripsi_produk' => 'required|string',
                'bukti' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }
            $validated = $request->all();
            $validated['user_id'] = Auth::id();

            $create = ProdukTeradopsiDosen::create($validated);

            if ($create) {
                return redirect()->route('admin.kinerja-dosen.produk-teradopsi.index', $tahunAjaran)
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
            $dosen = User::with('profile', 'kerjasama_tridharma_pendidikan')->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.kerjasama-tridharma.detail-pendidikan', [
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
        $ProdukTeradopsiDosen = ProdukTeradopsiDosen::with('user')->find($id);
        $userId = Auth::id();
        if (!$ProdukTeradopsiDosen) {
            return back()->withErrors('Data tidak ditemukan.');
        }

        return view('pages.admin.kinerja-dosen.produk-teradopsi.form', [
            'produk_teradopsi' => $ProdukTeradopsiDosen,
            'tahun_ajaran' => $tahunAjaran,
            'form_title' => 'Edit Data',
            'form_action' => route('admin.kinerja-dosen.produk-teradopsi.update', [
                'produkId' => $ProdukTeradopsiDosen->id,
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
                'nama_dosen' => 'required|string',
                'nama_produk' => 'required|string',
                'deskripsi_produk' => 'required|string',
                'bukti' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }
            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $ProdukTeradopsiDosen = ProdukTeradopsiDosen::findOrFail($id);
            $update = $ProdukTeradopsiDosen->update($validated);

            if ($update) {
                return redirect()->route('admin.kinerja-dosen.produk-teradopsi.index', $tahunAjaran)
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
        $ProdukTeradopsiDosen = ProdukTeradopsiDosen::findOrFail($id);
        $delete = $ProdukTeradopsiDosen->delete();

        if ($delete) {
            return redirect()->route('admin.kinerja-dosen.produk-teradopsi.index', $tahunAjaran)
                ->with('toast_success', 'Data penelitian dtps berhasil ditambahkan');
        }
        throw new \Exception('Data penelitian dtps gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
