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

            return response()->json($ewmp, Response::HTTP_OK);
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

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $validated['tahun_ajaran_id'] = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;
            $validated['is_dtps'] = $request->has('is_dtps') ? 1 : 0;
            $create = EwmpDosen::create($validated);

            return response()->json($create, Response::HTTP_CREATED);

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



            $validated = $request->all();
            $validated['is_dtps'] = $request->has('is_dtps') ? 1 : 0;

            $ewmp = EwmpDosen::findOrFail($id);
            $update = $ewmp->update($validated);
            return response()->json($update, Response::HTTP_OK);
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

            return response()->json(['message' => 'EWMP Dosen deleted'], Response::HTTP_OK);

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
