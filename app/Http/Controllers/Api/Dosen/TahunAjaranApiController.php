<?php

namespace App\Http\Controllers\Api\Dosen;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaranSemester;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

/**
 * Controller for managing TahunAjaranSemester endpoints.
 * 
 * @package App\Http\Controllers\Api\Dosen
 */
class TahunAjaranApiController extends Controller
{
    /**
     * Display all TahunAjaranSemester data.
     *
     * @return \Illuminate\Http\JsonResponse The TahunAjaranSemester record or error message
     * 
     * @throws \Exception If there's an error during data retrieval
     * 
     * @response 200 {
     * "id": "1",
     * ...other TahunAjaranSemester attributes...
     * }
     * @response 500 Server error
     */
    public function index()
    {
        try {
            $data = TahunAjaranSemester::all()->reverse();
            return response()->json($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource from TahunAjaranSemester.
     *
     * @param string $id The ID of the TahunAjaranSemester to retrieve
     * 
     * @return \Illuminate\Http\JsonResponse The TahunAjaranSemester record or error message
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     *
     * @response 200 {
     *  "id": "1",
     *  ...other TahunAjaranSemester attributes...
     * }
     * @response 404 { "error": "Record not found" }
     * @response 500 { "error": "Server error: [error message]" }
     */
    public function show(string $id)
    {
        try {
            $record = TahunAjaranSemester::findOrFail($id);
            return response()->json($record, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ['error' => 'Record not found'],
                Response::HTTP_NOT_FOUND
            );
        } catch (\Exception $e) {
            return response()->json(
                ['error' => 'Server error: ' . $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
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