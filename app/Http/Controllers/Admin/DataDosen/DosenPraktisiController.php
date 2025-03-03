<?php

namespace App\Http\Controllers\Admin\DataDosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\DosenIndustriPraktisi;
use App\Models\TahunAjaranSemester;
use Illuminate\Support\Facades\Validator;

class DosenPraktisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranId = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

            $dosenPraktisi = DosenIndustriPraktisi::with('user')
                ->where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->paginate(8);

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.dosen.data-dosen.dosen-praktisi.index', [
                'dosen_praktisi' => $dosenPraktisi,
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
            $dosenPraktisi = new DosenIndustriPraktisi();
            return view('pages.admin.dosen.data-dosen.dosen-praktisi.form', [
                'dosen' => $dosenPraktisi,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.dosen.dd.dosen-praktisi.store', $tahunAjaran),
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
                'nidk' => 'nullable|numeric',
                'perusahaan' => 'nullable|string',
                'pendidikan_tertinggi' => 'nullable|string',
                'bidang_keahlian' => 'nullable|string|max:255',
                'sertifikat_kompetensi' => 'nullable|string',
                'mk_diampu' => 'nullable|string',
                'bobot_kredit_sks' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $validated['tahun_ajaran_id'] = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;
            $create = DosenIndustriPraktisi::create($validated);

            if ($create) {
                return redirect()->route('admin.dosen.dd.dosen-praktisi.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen praktisi berhasil ditambahkan');
            }

            throw new \Exception('Data dosen praktisi gagal ditambahkan');
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
            $dosenPraktisi = DosenIndustriPraktisi::with('user')->whereId($id)->first();
            return view('pages.admin.data-dosen.dosen-praktisi.form', [
                'dosen' => $dosenPraktisi,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.data-dosen.dosen-praktisi.update', $dosenPraktisi->id),
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
                'nidk' => 'nullable|numeric',
                'perusahaan' => 'nullable|string',
                'pendidikan_tertinggi' => 'nullable|string',
                'bidang_keahlian' => 'nullable|string|max:255',
                'sertifikat_kompetensi' => 'nullable|string',
                'mk_diampu' => 'nullable|string',
                'bobot_kredit_sks' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $dosenPraktisi = DosenIndustriPraktisi::findOrFail($id);
            $update = $dosenPraktisi->update($validated);
            if ($update) {
                return redirect()->route('admin.data-dosen.dosen-praktisi.index')
                    ->with('toast_success', 'Data dosen praktisi berhasil diupdate');
            }

            throw new \Exception('Data dosen praktisi gagal diupdate');
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
            $dosenPraktisi = DosenIndustriPraktisi::findOrFail($id);
            $delete = $dosenPraktisi->delete();

            if ($delete) {
                return redirect()->route('admin.data-dosen.dosen-praktisi.index')
                    ->with('toast_success', 'Data dosen praktisi berhasil dihapus');
            }

            throw new \Exception('Data dosen praktisi gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
