<?php

namespace App\Http\Controllers\Admin\KerjasamaTridharma;

use App\Http\Controllers\Controller;
use App\Models\KerjasamaTridharmaPengmas;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengmasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranId = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

            $kerjasamaPengmas = KerjasamaTridharmaPengmas::with('user')
                ->where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->paginate(5);

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.dosen.kerjasama-tridharma.pengmas.index', [
                'kerjasama_pengmas' => $kerjasamaPengmas,
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
            $kerjasamaPengmas = new KerjasamaTridharmaPengmas();
            return view('pages.admin.dosen.kerjasama-tridharma.pengmas.form', [
                'kerjasama' => $kerjasamaPengmas,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.dosen.kt.pengmas.store', $tahunAjaran),
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
                'lembaga_mitra' => 'required|string',
                'tingkat' => 'required|string|in:lokal,nasional,internasional',
                'judul_kegiatan' => 'required|string',
                'manfaat' => 'required',
                'waktu_durasi' => 'required|string',
                'bukti_kerjasama' => 'required|url',
                'tahun_berakhir' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $validated['tahun_ajaran_id'] = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;
            $create = KerjasamaTridharmaPengmas::create($validated);

            if ($create) {
                return redirect()->route('admin.dosen.kt.pengmas.index', $tahunAjaran)
                    ->with('toast_success', 'Data kerjasama berhasil ditambahkan');
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
            $dosen = User::with('profile', 'kerjasama_tridharma_pengmas')->whereId($id)->firstOrFail();
            // dd($dosen);
            return view('pages.admin.petugas.kerjasama-tridharma.detail-pengmas', [
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
    public function edit(string $tahunAjaran, string $id)
    {
        try {
            $kerjasamaPengmas = KerjasamaTridharmaPengmas::with('user')->whereId($id)->first();
            return view('pages.admin.dosen.kerjasama-tridharma.pengmas.form', [
                'kerjasama' => $kerjasamaPengmas,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.dosen.kt.pengmas.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'pengmasId' => $kerjasamaPengmas->id
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
                'lembaga_mitra' => 'required|string',
                'tingkat' => 'required|string|in:lokal,nasional,internasional',
                'judul_kegiatan' => 'required|string',
                'manfaat' => 'required',
                'waktu_durasi' => 'required|string',
                'bukti_kerjasama' => 'required|url',
                'tahun_berakhir' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $kerjasamaPengmas = KerjasamaTridharmaPengmas::findOrFail($id);
            $update = $kerjasamaPengmas->update($validated);
            if ($update) {
                return redirect()->route('admin.dosen.kt.pengmas.index', $tahunAjaran)
                    ->with('toast_success', 'Data kerjasama berhasil diupdate');
            }

            throw new \Exception('Data kerjasama gagal diupdate');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $tahunAjaran, string $id)
    {
        try {
            $kerjasamaPengmas = KerjasamaTridharmaPengmas::findOrFail($id);
            $delete = $kerjasamaPengmas->delete();

            if ($delete) {
                return redirect()->route('admin.dosen.kt.pengmas.index', $tahunAjaran)
                    ->with('toast_success', 'Data kerjasama berhasil dihapus');
            }

            throw new \Exception('Data kerjasama gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
