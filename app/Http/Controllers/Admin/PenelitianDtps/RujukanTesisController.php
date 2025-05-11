<?php

namespace App\Http\Controllers\Admin\PenelitianDtps;

use App\Http\Controllers\Controller;
use App\Models\DtpsRujukanTesis;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RujukanTesisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
        $tahunAjaranId = $tahunAjaranObj->id;
        $tahun = $tahunAjaranObj->tahun_ajaran;
            $rujukanTesis = DtpsRujukanTesis::with('user')->where('tahun', $tahun)->get();

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.penelitian-dtps.rujukan-tesis.index', [
                'rujukan_tesis' => $rujukanTesis,
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
            $rujukanTesis = new DtpsRujukanTesis();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.penelitian-dtps.rujukan-tesis.form', [
                'rujukanTesis' => $rujukanTesis,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.penelitian-dtps.rujukan-tesis.store', $tahunAjaran),
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
                'nama_dosen' => 'required|string',
                'tema_penelitian' => 'required|string',
                'nama_mahasiswa' => 'required|string',
                'judul' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            // dd($validated);

            $create = DtpsRujukanTesis::create($validated);
            if ($create) {
                return redirect()->route('admin.penelitian-dtps.rujukan-tesis.index', $tahunAjaran)
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
            $dosen = User::with('profile', 'rujukan_tesis_mahasiswa')->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.penelitian-dtps.rujukan-tesis.detail', [
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
            $rujukanTesis = DtpsRujukanTesis::with('user')->first();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;

            return view('pages.admin.penelitian-dtps.rujukan-tesis.form', [
                'rujukanTesis' => $rujukanTesis,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.penelitian-dtps.rujukan-tesis.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'rujukanId' => $rujukanTesis->id,
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
                'nama_dosen' => 'required|string',
                'tema_penelitian' => 'required|string',
                'nama_mahasiswa' => 'required|string',
                'judul' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $dosenPraktisi = DtpsRujukanTesis::findOrFail($id);
            $update = $dosenPraktisi->update($validated);
            if ($update) {
                return redirect()->route('admin.penelitian-dtps.rujukan-tesis.index', $tahunAjaran)
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
    // public function destroy(string $tahunAjaran,string $id)
    // {
    //     try {
    //         $penelitian = DtpsRujukanTesis::findOrFail($id);
    //        $delete = $dosenPraktisi->delete();

    //         if ($delete) {
    //             return redirect()->route('admin.penelitian-dtps.rujukan-tesis.index', $tahunAjaran)
    //                 ->with('toast_success', 'Data dosen praktisi berhasil dihapus');
    //         }

    //         throw new \Exception('Data dosen praktisi gagal dihapus');
    //     } catch (\Exception $e) {
    //         return back()->withErrors($e->getMessage());
    //     }
    // }
}
