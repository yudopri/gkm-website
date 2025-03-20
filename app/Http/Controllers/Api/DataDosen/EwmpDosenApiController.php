<?php

namespace App\Http\Controllers\Api\DataDosen;

use App\Models\EwmpDosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Controller for managing EwmpDosen endpoints.
 * 
 * @package App\Http\Controllers\Api\DataDosen
 */
class EwmpDosenApiController extends Controller
{
    /**
     * Display all EwmpDosen data.
     *
     * @return \Illuminate\Http\JsonResponse The EwmpDosen record or error message
     * 
     * @throws \Exception If there's an error during data retrieval
     * 
     * @response 200 {
     * "id": "1",
     * ...other EwmpDosen attributes...
     * }
     * @response 500 Server error
     */
    public function index()
    {
        try {
            $data = EwmpDosen::all();
            return response()->json($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created EwmpDosen resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing EwmpDosen data
     * 
     * @return \Illuminate\Http\JsonResponse The EwmpDosen record or error message
     *
     * @throws \Exception When an error occurs during record creation
     * 
     * @response 201 {
     *    "id": 1,
     *   ...other EwmpDosen attributes...
     * }
     * @response 422 Data validation error
     * @response 500 Server error
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'tahun_ajaran_id' => 'required|exists:tahun_ajaran_semester,id',
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

            if ($validator->fails()) {
                return response()->json(
                    ['error' => $validator->errors()->first()],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $validated = $request->all();
            $create = EwmpDosen::create($validated);

            return response()->json($create, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => 'Failed to create record: ' . $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Display the specified resource from EwmpDosen.
     *
     * @param string $id The ID of the EwmpDosen to retrieve
     * 
     * @return \Illuminate\Http\JsonResponse The EwmpDosen record or error message
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     *
     * @response 200 {
     *  "id": "1",
     *  ...other EwmpDosen attributes...
     * }
     * @response 404 { "error": "Record not found" }
     * @response 500 { "error": "Server error: [error message]" }
     */
    public function show(string $id)
    {
        try {
            $record = EwmpDosen::findOrFail($id);
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
     * Update an existing EwmpDosen record.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing the updated data
     * @param  string  $id  The ID of the EwmpDosen record to update
     * 
     * @return \Illuminate\Http\JsonResponse The EwmpDosen record or error message
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     *
     * @response 200 {
     *     "id": 1,
     *    ...other EwmpDosen attributes...
     * }
     * @response 404 Record not found
     * @response 422 Data validation error
     * @response 500 Server error
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'sometimes|required|exists:users,id',
                'tahun_ajaran_id' => 'sometimes|required|exists:tahun_ajaran_semester,id',
                'nama_dosen' => 'sometimes|required|string|max:255',
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

            if ($validator->fails()) {
                return response()->json(
                    ['error' => $validator->errors()->first()],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $record = EwmpDosen::findOrFail($id);
            $validated = $request->all();
            $record->update($validated);

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
     * Delete a EwmpDosen record by ID.
     *
     * @param string $id The ID of the EwmpDosen to delete
     * @return \Illuminate\Http\JsonResponse The EwmpDosen record or error message
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     */
    public function destroy(string $id)
    {
        try {
            $delete = EwmpDosen::findOrFail($id);
            $delete->delete();

            return response()->json(
                ['message' => 'Record deleted successfully'],
                Response::HTTP_OK
            );
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
}
