<?php

namespace App\Http\Controllers\Admin\KinerjaDosen;

use App\Http\Controllers\Controller;
use App\Models\RekognisiDosen;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RekognisiDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            $rekognisi = RekognisiDosen::with('user')
                ->where('user_id', $userId)
                ->where('tahun', $tahun)
                ->paginate(5);

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.kinerja-dosen.rekognisi-dosen.index', [
                'rekognisi_dosen' => $rekognisi,
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
            $rekognisiDosen = new RekognisiDosen();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.kinerja-dosen.rekognisi-dosen.form', [
                'rekognisi' => $rekognisiDosen,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.kinerja-dosen.rekognisi-dtps.store', $tahunAjaran),
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
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'nama_dosen' => 'required|string|max:255',
                'bidang_keahlian' => 'required|string|max:255',
                'nama_rekognisi' => 'required|string',
                'bukti_pendukung' => 'required|url',
                'tingkat' => 'required|string|in:lokal,nasional,internasional',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            // dd($validated);

            $create = RekognisiDosen::create($validated);
            if ($create) {
                return redirect()->route('admin.kinerja-dosen.rekognisi-dtps.index', $tahunAjaran)
                    ->with('toast_success', 'Data rekognisi dtps berhasil ditambahkan');
            }

            throw new \Exception('Data rekognisi dtps gagal ditambahkan');
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
            $dosen = User::with(['profile', 'rekognisi_dtps'=> function ($query) {
        $query->whereNotNull('tahun');
    }])->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.kinerja-dosen.rekognisi-dosen.detail', [
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
            $rekognisi = RekognisiDosen::with('user')->first();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.kinerja-dosen.rekognisi-dosen.form', [
                'rekognisi' => $rekognisi,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.kinerja-dosen.rekognisi-dtps.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'rekognisiId' => $rekognisi->id,
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
    public function update(Request $request,string $tahunAjaran,string $id)
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

            $dosenPraktisi = RekognisiDosen::findOrFail($id);
            $update = $dosenPraktisi->update($validated);
            if ($update) {
                return redirect()->route('admin.kinerja-dosen.rekognisi-dtps.index', $tahunAjaran)
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
    public function destroy(string $tahunAjaran,string $id)
    {
        try {
            $dosenPraktisi = RekognisiDosen::findOrFail($id);
            $delete = $dosenPraktisi->delete();

            if ($delete) {
                return redirect()->route('admin.kinerja-dosen.rekognisi-dtps.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen praktisi berhasil dihapus');
            }

            throw new \Exception('Data dosen praktisi gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
