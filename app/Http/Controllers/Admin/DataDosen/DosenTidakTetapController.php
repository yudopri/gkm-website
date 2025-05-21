<?php

namespace App\Http\Controllers\Admin\DataDosen;

use Illuminate\Http\Request;
use App\Models\DosenTidakTetap;
use App\Models\JabatanFungsional;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaranSemester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class DosenTidakTetapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranId = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

            $dosenTidakTetap = DosenTidakTetap::with('user')
                ->where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->paginate(8);

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.dosen.data-dosen.dosen-tidak-tetap.index', [
                'dosenTidakTetap' => $dosenTidakTetap,
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
            $dosenTidakTetap = new DosenTidakTetap();
            $jabatanAkademik = JabatanFungsional::all()->reverse();
            return view('pages.admin.dosen.data-dosen.dosen-tidak-tetap.form', [
                'dosen' => $dosenTidakTetap,
                'tahun_ajaran' => $tahunAjaran,
                'jabatanAkademik' => $jabatanAkademik,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.dosen.dd.dosen-tidak-tetap.store', $tahunAjaran),
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
                'nidn_nidk' => 'nullable|numeric',
                'pendidikan_pascasarjana' => 'nullable|string',
                'bidang_keahlian' => 'nullable|string|max:255',
                'jabatan_akademik' => 'nullable|string',
                'sertifikat_pendidik' => 'nullable|string',
                'sertifikat_kompetensi' => 'nullable|string',
                'mk_diampu' => 'nullable|string',
                'kesesuaian_keahlian_mk' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $validated['kesesuaian_keahlian_mk'] = $request->has('kesesuaian_keahlian_mk') ? 1 : 0;
            $validated['tahun_ajaran_id'] = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;
            $create = DosenTidakTetap::create($validated);

            if ($create) {
                return redirect()->route('admin.dosen.dd.dosen-tidak-tetap.index',$tahunAjaran)
                    ->with('toast_success', 'Data dosen tidak tetap berhasil ditambahkan');
            }

            throw new \Exception('Data dosen tidak tetap gagal ditambahkan');
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
            $dosen = User::with(['profile', 'dosen_tidak_tetap'=> function ($query) {
        $query->whereNotNull('tahun_ajaran_id');
    }])->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.data-dosen.dosen-tidak-tetap.detail-dosen-tidak-tetap', [
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
            $dosenTidakTetap = DosenTidakTetap::with('user')->whereId($id)->first();
            $jabatanAkademik = JabatanFungsional::all()->reverse();
            return view('pages.admin.dosen.data-dosen.dosen-tidak-tetap.form', [
                'dosen' => $dosenTidakTetap,
                'jabatanAkademik' => $jabatanAkademik,
                'tahun_ajaran' => $tahunAjaran,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.dosen.dd.dosen-tidak-tetap.update', ['tahunAjaran'=> $tahunAjaran, 'dosenTidakTetapId' => $dosenTidakTetap->id]),
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
                'nidn_nidk' => 'nullable|numeric',
                'pendidikan_pascasarjana' => 'nullable|string',
                'bidang_keahlian' => 'nullable|string|max:255',
                'jabatan_akademik' => 'nullable|string',
                'sertifikat_pendidik' => 'nullable|string',
                'sertifikat_kompetensi' => 'nullable|string',
                'mk_diampu' => 'nullable|string',
                'kesesuaian_keahlian_mk' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['kesesuaian_keahlian_mk'] = $request->has('kesesuaian_keahlian_mk') ? 1 : 0;
            $validated['tahun_ajaran_id'] = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

            $dosenTidakTetap = DosenTidakTetap::findOrFail($id);
            $update = $dosenTidakTetap->update($validated);
            if ($update) {
                return redirect()->route('admin.dosen.dd.dosen-tidak-tetap.index',$tahunAjaran)
                    ->with('toast_success', 'Data dosen tidak tetap berhasil diupdate');
            }

            throw new \Exception('Data dosen tidak tetap gagal diupdate');
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
            $dosenTidakTetap = DosenTidakTetap::findOrFail($id);
            $delete = $dosenTidakTetap->delete();

            if ($delete) {
                return redirect()->route('admin.dosen.dd.dosen-tidak-tetap.index',$tahunAjaran)
                    ->with('toast_success', 'Data dosen tidak tetap berhasil dihapus');
            }

            throw new \Exception('Data dosen tidak tetap gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
