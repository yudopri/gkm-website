<?php

namespace App\Http\Controllers\Admin\DataDosen;

use App\Models\DosenTetapPT;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\JabatanFungsional;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DosenTetapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranId = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

            $dosenTetap = DosenTetapPT::with('user')
                ->where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->paginate(8);

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.dosen.data-dosen.dosen-tetap-pt.index', [
                'dosen_tetap' => $dosenTetap,
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
            $dosenTetap = new DosenTetapPT();
            $jabatanAkademik = JabatanFungsional::all()->reverse();
            return view('pages.admin.dosen.data-dosen.dosen-tetap-pt.form', [
                'dosen' => $dosenTetap,
                'jabatanAkademik' => $jabatanAkademik,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.dosen.dd.dosen-tetap.store', $tahunAjaran),
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
                'nidn_nidk' => 'required|numeric',
                'gelar_magister' => 'required|string',
                'gelar_doktor' => 'nullable|string',
                'bidang_keahlian' => 'nullable|string|max:255',
                'kesesuaian_kompetensi' => 'nullable|boolean',
                'jabatan_akademik' => ['nullable', 'string', Rule::exists(JabatanFungsional::class, 'nama')],
                'sertifikat_pendidik' => 'nullable|string',
                'sertifikat_kompetensi' => 'nullable|string',
                'mk_diampu' => 'nullable|string',
                'kesesuaian_keahlian_mk' => 'nullable|boolean',
                'mk_ps_lain' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $validated['tahun_ajaran_id'] = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;
            $validated['kesesuaian_kompetensi'] = $request->has('kesesuaian_kompetensi') ? 1 : 0;
            $validated['kesesuaian_keahlian_mk'] = $request->has('kesesuaian_keahlian_mk') ? 1 : 0;
            $create = DosenTetapPT::create($validated);

            if ($create) {
                return redirect()->route('admin.dosen.dd.dosen-tetap.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen tetap berhasil ditambahkan');
            }

            throw new \Exception('Data dosen tetap gagal ditambahhkan');
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
            $dosen = User::with('profile', 'dosen_tetap')->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.data-dosen.dosen-tetap-pt.detail-dosen-tetap', [
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
            $dosenTetap = DosenTetapPT::with('user')->whereId($id)->first();
            $jabatanAkademik = JabatanFungsional::all()->reverse();
            return view('pages.admin.dosen.data-dosen.dosen-tetap-pt.form', [
                'dosen' => $dosenTetap,
                'jabatanAkademik' => $jabatanAkademik,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.dosen.dd.dosen-tetap.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'dosenTetapId' => $dosenTetap->id
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
                'nama_dosen' => 'required|string|max:255',
                'nidn_nidk' => 'required|numeric',
                'gelar_magister' => 'required|string',
                'gelar_doktor' => 'nullable|string',
                'bidang_keahlian' => 'nullable|string|max:255',
                'kesesuaian_kompetensi' => 'nullable|boolean',
                'jabatan_akademik' => ['nullable', 'string', Rule::exists(JabatanFungsional::class, 'nama')],
                'sertifikat_pendidik' => 'nullable|string',
                'sertifikat_kompetensi' => 'nullable|string',
                'mk_diampu' => 'nullable|string',
                'kesesuaian_keahlian_mk' => 'nullable|boolean',
                'mk_ps_lain' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['kesesuaian_kompetensi'] = $request->has('kesesuaian_kompetensi') ? 1 : 0;
            $validated['kesesuaian_keahlian_mk'] = $request->has('kesesuaian_keahlian_mk') ? 1 : 0;

            $dosenTetap = DosenTetapPT::findOrFail($id);
            $update = $dosenTetap->update($validated);
            if ($update) {
                return redirect()->route('admin.dosen.dd.dosen-tetap.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen tetap berhasil diupdate');
            }

            throw new \Exception('Data dosen tetap gagal diupdate');
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
            $dosenTetap = DosenTetapPT::findOrFail($id);
            $delete = $dosenTetap->delete();

            if ($delete) {
                return redirect()->route('admin.dosen.dd.dosen-tetap.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen tetap berhasil dihapus');
            }

            throw new \Exception('Data dosen tetap gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
