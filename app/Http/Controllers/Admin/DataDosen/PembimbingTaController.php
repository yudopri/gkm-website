<?php

namespace App\Http\Controllers\Admin\DataDosen;

use Illuminate\Http\Request;
use App\Models\DosenPembimbingTA;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaranSemester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    public function create()
    {
        try {
            $dospem = new DosenPembimbingTA();
            return view('pages.admin.data-dosen.dospem-ta.form', [
                'dosen' => $dospem,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.data-dosen.dosen-pembimbing-ta.store'),
                'form_method' => "POST",
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            $create = DosenPembimbingTA::create($validated);

            if ($create) {
                return redirect()->route('admin.data-dosen.dosen-pembimbing-ta.index')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $dospem = DosenPembimbingTA::with('user')->whereId($id)->first();
            return view('pages.admin.data-dosen.dospem-ta.form', [
                'dosen' => $dospem,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.data-dosen.dosen-pembimbing-ta.update', $dospem->id),
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
                'nama_dosen' => 'required|string|max:255',
                'mhs_bimbingan_ps' => 'nullable|numeric',
                'mhs_bimbingan_ps_lain' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $dospem = DosenPembimbingTA::findOrFail($id);
            $update = $dospem->update($validated);
            if ($update) {
                return redirect()->route('admin.data-dosen.dosen-pembimbing-ta.index')
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
    public function destroy(string $id)
    {
        try {
            $dospem = DosenPembimbingTA::findOrFail($id);
            $delete = $dospem->delete();

            if ($delete) {
                return redirect()->route('admin.data-dosen.dosen-pembimbing-ta.index')
                    ->with('toast_success', 'Data dosen pembimbing berhasil dihapus');
            }

            throw new \Exception('Data dosen pembimbing gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
