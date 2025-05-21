<?php

namespace App\Http\Controllers\Admin\DataDosen;

use Illuminate\Http\Request;
use App\Models\DosenPembimbingTA;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaranSemester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class PembimbingTaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranId = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

            $dospem = DosenPembimbingTA::with('user')
                ->where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->paginate(8);

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.dosen.data-dosen.dospem-ta.index', [
                'dospem' => $dospem,
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
            $dospem = new DosenPembimbingTA();
            return view('pages.admin.dosen.data-dosen.dospem-ta.form', [
                'dosen' => $dospem,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.dosen.dd.dosen-pembimbing-ta.store', $tahunAjaran),
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
                'nama_dosen' => 'required|string|max:255',
                'mhs_bimbingan_ps' => 'nullable|numeric',
                'mhs_bimbingan_ps_lain' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $validated['tahun_ajaran_id'] = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;
            $create = DosenPembimbingTA::create($validated);

            if ($create) {
                return redirect()->route('admin.dosen.dd.dosen-pembimbing-ta.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen pembimbing berhasil ditambahkan');
            }

            throw new \Exception('Data dosen pembimbing gagal ditambahhkan');
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
            $dosen = User::with(['profile', 'dosen_pembimbing_ta'=> function ($query) {
        $query->whereNotNull('tahun_ajaran_id');
    }])->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.data-dosen.dospem-ta.detail-dospem-ta', [
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
            $dospem = DosenPembimbingTA::with('user')->whereId($id)->first();
            return view('pages.admin.dosen.data-dosen.dospem-ta.form', [
                'dosen' => $dospem,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.dosen.dd.dosen-pembimbing-ta.update',[
                    'tahunAjaran' => $tahunAjaran,
                    'pembimbingTaId' => $dospem->id
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
                'nama_dosen' => 'required|string|max:255',
                'mhs_bimbingan_ps' => 'nullable|numeric',
                'mhs_bimbingan_ps_lain' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['tahun_ajaran_id'] = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

            $dospem = DosenPembimbingTA::findOrFail($id);
            $update = $dospem->update($validated);
            if ($update) {
                return redirect()->route('admin.dosen.dd.dosen-pembimbing-ta.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen pembimbing berhasil diupdate');
            }

            throw new \Exception('Data dosen pembimbing gagal diupdate');
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
            $dospem = DosenPembimbingTA::findOrFail($id);
            $delete = $dospem->delete();

            if ($delete) {
                return redirect()->route('admin.dosen.dd.dosen-pembimbing-ta.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen pembimbing berhasil dihapus');
            }

            throw new \Exception('Data dosen pembimbing gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
