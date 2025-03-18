<?php

namespace App\Http\Controllers\Api\DataDosen;

use Illuminate\Http\Request;
use App\Models\DosenTidakTetap;
use App\Models\JabatanFungsional;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaranSemester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class DosenTidakTetapApiController extends Controller
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

            return response()->json($dosenTidakTetap, Response::HTTP_OK);
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
                'nidn_nidk' => 'nullable|numeric',
                'pendidikan_pascasarjana' => 'nullable|string',
                'bidang_keahlian' => 'nullable|string|max:255',
                'jabatan_akademik' => 'nullable|string',
                'sertifikat_pendidik' => 'nullable|string',
                'sertifikat_kompetensi' => 'nullable|string',
                'mk_diampu' => 'nullable|string',
                'kesesuaian_keahlian_mk' => 'nullable|boolean',
            ]);


            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $validated['kesesuaian_keahlian_mk'] = $request->has('kesesuaian_keahlian_mk') ? 1 : 0;
            $create = DosenTidakTetap::create($validated);

            return response()->json($create, Response::HTTP_CREATED);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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


            $validated = $request->all();
            $validated['kesesuaian_keahlian_mk'] = $request->has('kesesuaian_keahlian_mk') ? 1 : 0;

            $dosenTidakTetap = DosenTidakTetap::findOrFail($id);
            $update = $dosenTidakTetap->update($validated);
            return response()->json($update, Response::HTTP_OK);

            throw new \Exception('Data dosen tidak tetap gagal diupdate');
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
            $dosenTidakTetap = DosenTidakTetap::findOrFail($id);
            $delete = $dosenTidakTetap->delete();

            return response()->json(['message' => 'Dosen Tidak Tetap deleted'], Response::HTTP_OK);

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
