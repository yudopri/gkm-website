<?php

namespace App\Http\Controllers\Api\DataDosen;

use App\Models\DosenTidakTetap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Controller for managing DosenTidakTetap endpoints.
 * 
 * @package App\Http\Controllers\Api\DataDosen
 */
class DosenTidakTetapApiController extends Controller
{
    /**
     * Display all DosenTidakTetap data.
     *
     * @return \Illuminate\Http\JsonResponse The DosenTidakTetap record or error message
     * 
     * @throws \Exception If there's an error during data retrieval
     * 
     * @response 200 {
     * "id": "1",
     * ...other DosenTidakTetap attributes...
     * }
     * @response 500 Server error
     */
    public function index()
    {
        try {
            $data = DosenTidakTetap::all();
            return response()->json($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created DosenTidakTetap resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing DosenTidakTetap data
     * 
     * @return \Illuminate\Http\JsonResponse The DosenTidakTetap record or error message
     *
     * @throws \Exception When an error occurs during record creation
     * 
     * @response 201 {
     *    "id": 1,
     *   ...other DosenTidakTetap attributes...
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
                'nidn_nidk' => 'nullable|string',
                'pendidikan_pascasarjana' => 'nullable|string',
                'bidang_keahlian' => 'nullable|string|max:255',
                'jabatan_akademik' => 'nullable|string|exists:jabatan_fungsional,nama',
                'sertifikat_pendidik' => 'nullable|string',
                'sertifikat_kompetensi' => 'nullable|string',
                'mk_diampu' => 'nullable|string',
                'kesesuaian_keahlian_mk' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    ['error' => $validator->errors()->first()],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $validated = $request->all();
            $create = DosenTidakTetap::create($validated);

            return response()->json($create, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => 'Failed to create record: ' . $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Display the specified resource from DosenTidakTetap.
     *
     * @param string $id The ID of the DosenTidakTetap to retrieve
     * 
     * @return \Illuminate\Http\JsonResponse The DosenTidakTetap record or error message
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     *
     * @response 200 {
     *  "id": "1",
     *  ...other DosenTidakTetap attributes...
     * }
     * @response 404 { "error": "Record not found" }
     * @response 500 { "error": "Server error: [error message]" }
     */
    public function show(string $id)
    {
        try {
            $record = DosenTidakTetap::findOrFail($id);
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
     * Update an existing DosenTidakTetap record.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing the updated data
     * @param  string  $id  The ID of the DosenTidakTetap record to update
     * 
     * @return \Illuminate\Http\JsonResponse The DosenTidakTetap record or error message
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     *
     * @response 200 {
     *     "id": 1,
     *    ...other DosenTidakTetap attributes...
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
                'nidn_nidk' => 'nullable|string',
                'pendidikan_pascasarjana' => 'nullable|string',
                'bidang_keahlian' => 'nullable|string|max:255',
                'jabatan_akademik' => 'nullable|string|exists:jabatan_fungsional,nama',
                'sertifikat_pendidik' => 'nullable|string',
                'sertifikat_kompetensi' => 'nullable|string',
                'mk_diampu' => 'nullable|string',
                'kesesuaian_keahlian_mk' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    ['error' => $validator->errors()->first()],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $record = DosenTidakTetap::findOrFail($id);
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
     * Delete a DosenTidakTetap record by ID.
     *
     * @param string $id The ID of the DosenTidakTetap to delete
     * @return \Illuminate\Http\JsonResponse The DosenTidakTetap record or error message
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     */
    public function destroy(string $id)
    {
        try {
            $delete = DosenTidakTetap::findOrFail($id);
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
