<?php

namespace App\Http\Controllers\Api\DataDosen;

use Illuminate\Http\Request;
use App\Models\DosenPembimbingTA;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaranSemester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class PembimbingTaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranId = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

            $dospem = DosenPembimbingTA::with('user')
                ->where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->paginate(8);

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return response()->json($dospem, Response::HTTP_OK);
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
                'mhs_bimbingan_ps' => 'nullable|numeric',
                'mhs_bimbingan_ps_lain' => 'nullable|numeric',
            ]);
            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $create = DosenPembimbingTA::create($validated);

            return response()->json($create, Response::HTTP_CREATED);
            throw new \Exception('Data dosen pembimbing gagal ditambahhkan');
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
                'mhs_bimbingan_ps' => 'nullable|numeric',
                'mhs_bimbingan_ps_lain' => 'nullable|numeric',
            ]);


            $validated = $request->all();

            $dospem = DosenPembimbingTA::findOrFail($id);
            $update = $dospem->update($validated);
            return response()->json($update, Response::HTTP_OK);

            throw new \Exception('Data dosen pembimbing gagal diupdate');
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
            $dospem = DosenPembimbingTA::findOrFail($id);
            $delete = $dospem->delete();

            return response()->json(['message' => 'Dosen Pembimbing deleted'], Response::HTTP_OK);

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
