<?php

namespace App\Http\Controllers\Api\DataDosen;

use App\Models\EwmpDosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaranSemester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class EwmpDosenApiController extends Controller
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
    public function store(Request $request, string $tahunAjaran)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_dosen' => 'required|string|max:255',
                'is_dtps' => 'required|boolean',
                'ps_diakreditasi' => 'required|numeric|min:0',
                'ps_lain_dalam_pt' => 'required|numeric|min:0',
                'ps_lain_luar_pt' => 'required|numeric|min:0',
                'penelitian' => 'required|numeric|min:0',
                'pkm' => 'required|numeric|min:0',
                'tugas_tambahan' => 'required|numeric|min:0',
                'jumlah_sks' => 'required|numeric|min:0',
                'avg_per_semester' => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $tahunAjaranData = TahunAjaranSemester::where('slug', $tahunAjaran)->first();
            if (!$tahunAjaranData) {
                return response()->json(['error' => 'Tahun Ajaran tidak ditemukan'], Response::HTTP_NOT_FOUND);
            }

            $validated = $validator->validated();
            $validated['user_id'] = Auth::id();
            $validated['tahun_ajaran_id'] = $tahunAjaranData->id;

            $ewmp = EwmpDosen::create($validated);

            return response()->json($ewmp, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menambahkan EWMP Dosen'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $ewmp = EwmpDosen::findOrFail($id);
            return response()->json($ewmp, Response::HTTP_OK);
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
            $ewmp = EwmpDosen::findOrFail($id);

            // Pastikan hanya user yang memiliki data yang bisa mengedit
            if ($ewmp->user_id !== Auth::id()) {
                return response()->json(['error' => 'Anda tidak memiliki izin untuk mengubah data ini'], Response::HTTP_FORBIDDEN);
            }

            $validator = Validator::make($request->all(), [
                'nama_dosen' => 'required|string|max:255',
                'is_dtps' => 'required|boolean',
                'ps_diakreditasi' => 'required|numeric|min:0',
                'ps_lain_dalam_pt' => 'required|numeric|min:0',
                'ps_lain_luar_pt' => 'required|numeric|min:0',
                'penelitian' => 'required|numeric|min:0',
                'pkm' => 'required|numeric|min:0',
                'tugas_tambahan' => 'required|numeric|min:0',
                'jumlah_sks' => 'required|numeric|min:0',
                'avg_per_semester' => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $validated = $validator->validated();
            $ewmp->update($validated);

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
            $ewmp = EwmpDosen::findOrFail($id);

            // Pastikan hanya user yang memiliki data yang bisa menghapus
            if ($ewmp->user_id !== Auth::id()) {
                return response()->json(['error' => 'Anda tidak memiliki izin untuk menghapus data ini'], Response::HTTP_FORBIDDEN);
            }

            $ewmp->delete();

            return response()->json(['message' => 'Data berhasil dihapus'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
