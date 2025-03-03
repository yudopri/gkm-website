<?php

namespace App\Http\Controllers\Admin\DataDosen;

use App\Models\EwmpDosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaranSemester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EwmpDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranId = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

            $ewmp = EwmpDosen::with('user')
                ->where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->paginate(8);

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.dosen.data-dosen.ewmp-dosen.index', [
                'ewmp_dosen' => $ewmp,
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
            $ewmp = new EwmpDosen();
            return view('pages.admin.dosen.data-dosen.ewmp-dosen.form', [
                'ewmp' => $ewmp,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.dosen.dd.ewmp-dosen.store', $tahunAjaran),
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
                'is_dtps' => 'nullable|boolean',
                'ps_diakreditasi' => 'nullable|numeric',
                'ps_lain_dalam_pt' => 'nullable|numeric',
                'ps_lain_luar_pt' => 'nullable|numeric',
                'penelitian' => 'nullable|numeric',
                'pkm' => 'nullable|numeric',
                'tugas_tambahan' => 'nullable|numeric',
                'jumlah_sks' => 'nullable|numeric',
                'avg_per_semester' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $validated['tahun_ajaran_id'] = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;
            $validated['is_dtps'] = $request->has('is_dtps') ? 1 : 0;
            $create = EwmpDosen::create($validated);

            if ($create) {
                return redirect()->route('admin.dosen.dd.ewmp-dosen.index', $tahunAjaran)
                    ->with('toast_success', 'Data ewmp dosen berhasil ditambahkan');
            }

            throw new \Exception('Data ewmp dosen gagal ditambahhkan');
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
            $ewmp = EwmpDosen::with('user')->whereId($id)->first();
            return view('pages.admin.dosen.data-dosen.ewmp-dosen.form', [
                'ewmp' => $ewmp,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.data-dosen.ewmp-dosen.update', $ewmp->id),
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
                'is_dtps' => 'nullable|boolean',
                'ps_diakreditasi' => 'nullable|numeric',
                'ps_lain_dalam_pt' => 'nullable|numeric',
                'ps_lain_luar_pt' => 'nullable|numeric',
                'penelitian' => 'nullable|numeric',
                'pkm' => 'nullable|numeric',
                'tugas_tambahan' => 'nullable|numeric',
                'jumlah_sks' => 'nullable|numeric',
                'avg_per_semester' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }


            $validated = $request->all();
            $validated['is_dtps'] = $request->has('is_dtps') ? 1 : 0;

            $ewmp = EwmpDosen::findOrFail($id);
            $update = $ewmp->update($validated);
            if ($update) {
                return redirect()->route('admin.data-dosen.ewmp-dosen.index')
                    ->with('toast_success', 'Data ewmp dosen berhasil diupdate');
            }

            throw new \Exception('Data ewmp dosen gagal diupdate');
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
            $ewmp = EwmpDosen::findOrFail($id);
            $delete = $ewmp->delete();

            if ($delete) {
                return redirect()->route('admin.data-dosen.ewmp-dosen.index')
                    ->with('toast_success', 'Data ewmp dosen berhasil dihapus');
            }

            throw new \Exception('Data ewmp dosen gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
