<?php

namespace App\Http\Controllers\Admin\KerjasamaTridharma;

use App\Http\Controllers\Controller;
use App\Models\KerjasamaTridharmaPendidikan;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranId = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

            $kerjasamaPendidikan = KerjasamaTridharmaPendidikan::with('user')
                ->where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->paginate(5);

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.dosen.kerjasama-tridharma.pendidikan.index', [
                'kerjasama_pendidikan' => $kerjasamaPendidikan,
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
            $kerjasamaPendidikan = new KerjasamaTridharmaPendidikan();
            return view('pages.admin.dosen.kerjasama-tridharma.pendidikan.form', [
                'kerjasama' => $kerjasamaPendidikan,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.dosen.kt.pendidikan.store', $tahunAjaran),
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
            $create = KerjasamaTridharmaPendidikan::create($validated);

            if ($create) {
                return redirect()->route('admin.dosen.kt.pendidikan.index', $tahunAjaran)
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
    public function edit(string $tahunAjaran, string $id)
    {
        try {
            $kerjasamaPendidikan = KerjasamaTridharmaPendidikan::with('user')->whereId($id)->first();
            return view('pages.admin.dosen.kerjasama-tridharma.pendidikan.form', [
                'kerjasama' => $kerjasamaPendidikan,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.dosen.kt.pendidikan.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'pendidikanId' => $kerjasamaPendidikan->id
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

            $kerjasamaPendidikan = KerjasamaTridharmaPendidikan::findOrFail($id);
            $update = $kerjasamaPendidikan->update($validated);
            if ($update) {
                return redirect()->route('admin.dosen.kt.pendidikan.index', $tahunAjaran)
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
            $kerjasamaPendidikan = KerjasamaTridharmaPendidikan::findOrFail($id);
            $delete = $kerjasamaPendidikan->delete();

            if ($delete) {
                return redirect()->route('admin.dosen.kt.pendidikan.index', $tahunAjaran)
                    ->with('toast_success', 'Data kerjasama berhasil dihapus');
            }

            throw new \Exception('Data kerjasama gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
