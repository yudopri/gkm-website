<?php

namespace App\Http\Controllers\Admin\LuaranMahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\ProdukJasaMahasiswa;

class ProdukJasaMahasiswaController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $produk = ProdukJasaMahasiswa::with('user')->get();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.luaran-mahasiswa.produk-jasa.index', [
                'produk_jasa' => $produk,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
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
            $produk = new ProdukJasaMahasiswa();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.luaran-mahasiswa.produk-jasa.form', [
                'produk_jasa' => $produk,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.luaran-mahasiswa.produk-jasa.store', $tahunAjaran),
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

            $create = ProdukJasaMahasiswa::create($validated);

            if ($create) {
                return redirect()->route('admin.luaran-mahasiswa.produk-jasa.index', $tahunAjaran)
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
            $mahasiswa = User::with('profile', 'kerjasama_tridharma_pendidikan')->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.kerjasama-tridharma.detail-pendidikan', [
                'data_mahasiswa' => $mahasiswa,
                'mahasiswaId' => $mahasiswa->id,
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
        $ProdukJasaMahasiswa = ProdukJasaMahasiswa::with('user')->find($id);
        $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
        $tahunAjaranId = $tahunAjaranObj->id;
        $tahun = $tahunAjaranObj->tahun_ajaran;
        $userId = Auth::id();
        if (!$ProdukJasaMahasiswa) {
            return back()->withErrors('Data tidak ditemukan.');
        }

        return view('pages.admin.luaran-mahasiswa.produk-jasa.form', [
            'produk_jasa' => $ProdukJasaMahasiswa,
            'tahun_ajaran' => $tahunAjaran,
            'tahun' => $tahun,
            'form_title' => 'Edit Data',
            'form_action' => route('admin.luaran-mahasiswa.produk-jasa.update', [
                'produkId' => $ProdukJasaMahasiswa->id,
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
                'nama_mahasiswa' => 'required|string',
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
            $ProdukJasaMahasiswa = ProdukJasaMahasiswa::findOrFail($id);
            $update = $ProdukJasaMahasiswa->update($validated);

            if ($update) {
                return redirect()->route('admin.luaran-mahasiswa.produk-jasa.index', $tahunAjaran)
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
        $ProdukJasaMahasiswa = ProdukJasaMahasiswa::findOrFail($id);
        $delete = $ProdukJasaMahasiswa->delete();

        if ($delete) {
            return redirect()->route('admin.luaran-mahasiswa.produk-jasa.index', $tahunAjaran)
                ->with('toast_success', 'Data penelitian dtps berhasil ditambahkan');
        }
        throw new \Exception('Data penelitian dtps gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
