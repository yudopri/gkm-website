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
    public function index(Request $request, string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranData = TahunAjaranSemester::where('slug', $tahunAjaran)->first();

            if (!$tahunAjaranData) {
                return response()->json(['error' => 'Tahun Ajaran tidak ditemukan'], Response::HTTP_NOT_FOUND);
            }

            $dosenTidakTetap = DosenTidakTetap::with('user')
                ->where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranData->id)
                ->paginate(8);

            return response()->json($dosenTidakTetap, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
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

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $validated = $validator->validated();
            $validated['user_id'] = Auth::id();
            $validated['kesesuaian_keahlian_mk'] = $request->has('kesesuaian_keahlian_mk') ? 1 : 0;

            $create = DosenTidakTetap::create($validated);

            return response()->json($create, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $dosenTidakTetap = DosenTidakTetap::findOrFail($id);
            return response()->json($dosenTidakTetap, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan'], Response::HTTP_NOT_FOUND);
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
                return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $validated = $validator->validated();
            $validated['kesesuaian_keahlian_mk'] = $request->has('kesesuaian_keahlian_mk') ? 1 : 0;

            $dosenTidakTetap = DosenTidakTetap::findOrFail($id);
            $dosenTidakTetap->update($validated);

            return response()->json(['message' => 'Data berhasil diperbarui'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memperbarui data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $dosenTidakTetap = DosenTidakTetap::findOrFail($id);
            $dosenTidakTetap->delete();

            return response()->json(['message' => 'Data berhasil dihapus'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
