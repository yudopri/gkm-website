<?php

namespace App\Http\Controllers\Api\Dosen;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaranSemester;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class TahunAjaranApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(TahunAjaranSemester::all()->reverse(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
        ]);

        $tahunAjaran = TahunAjaranSemester::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
            'slug' => Str::slug($request->tahun_ajaran . '-' . $request->semester),
        ]);

        return response()->json($tahunAjaran, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tahunAjaranSemester = TahunAjaranSemester::find($id);

        if (!$tahunAjaranSemester) {
            return response()->json(['message' => 'Data tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($tahunAjaranSemester, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tahunAjaranSemester = TahunAjaranSemester::find($id);

        if (!$tahunAjaranSemester) {
            return response()->json(['message' => 'Data tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'tahun_ajaran' => 'sometimes|string|max:255',
            'semester' => 'sometimes|string|max:255',
        ]);

        $tahunAjaranSemester->update($request->only(['tahun_ajaran', 'semester']));
        $tahunAjaranSemester->slug = Str::slug($tahunAjaranSemester->tahun_ajaran . '-' . $tahunAjaranSemester->semester);
        $tahunAjaranSemester->save();

        return response()->json($tahunAjaranSemester, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tahunAjaranSemester = TahunAjaranSemester::find($id);

        if (!$tahunAjaranSemester) {
            return response()->json(['message' => 'Data tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }

        $tahunAjaranSemester->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}