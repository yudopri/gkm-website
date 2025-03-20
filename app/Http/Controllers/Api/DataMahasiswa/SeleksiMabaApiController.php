<?php

namespace App\Http\Controllers\Api\DataMahasiswa;

use App\Models\SeleksiMahasiswaBaru;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Controller for managing SeleksiMahasiswaBaru endpoints.
 * 
 * @package App\Http\Controllers\Api\DataMahasiswa
 */
class SeleksiMabaApiController extends Controller
{
    /**
     * Display all SeleksiMahasiswaBaru data.
     *
     * @return \Illuminate\Http\JsonResponse The SeleksiMahasiswaBaru record or error message
     * 
     * @throws \Exception If there's an error during data retrieval
     * 
     * @response 200 {
     * "id": "1",
     * ...other SeleksiMahasiswaBaru attributes...
     * }
     * @response 500 Server error
     */
    public function index()
    {
        try {
            $data = SeleksiMahasiswaBaru::all();
            return response()->json($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created SeleksiMahasiswaBaru resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing SeleksiMahasiswaBaru data
     * 
     * @return \Illuminate\Http\JsonResponse The SeleksiMahasiswaBaru record or error message
     *
     * @throws \Exception When an error occurs during record creation
     * 
     * @response 201 {
     *    "id": 1,
     *   ...other SeleksiMahasiswaBaru attributes...
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
                'tahun_akademik' => 'required|string',
                'daya_tampung' => 'required|numeric',
                'pendaftar' => 'nullable|numeric',
                'lulus_seleksi' => 'nullable|numeric',
                'maba_reguler' => 'nullable|numeric',
                'maba_transfer' => 'nullable|numeric',
                'mhs_aktif_reguler' => 'nullable|numeric',
                'mhs_aktif_transfer' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    ['error' => $validator->errors()->first()],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $validated = $request->all();
            $create = SeleksiMahasiswaBaru::create($validated);

            return response()->json($create, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => 'Failed to create record: ' . $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Display the specified resource from SeleksiMahasiswaBaru.
     *
     * @param string $id The ID of the SeleksiMahasiswaBaru to retrieve
     * 
     * @return \Illuminate\Http\JsonResponse The SeleksiMahasiswaBaru record or error message
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     *
     * @response 200 {
     *  "id": "1",
     *  ...other SeleksiMahasiswaBaru attributes...
     * }
     * @response 404 { "error": "Record not found" }
     * @response 500 { "error": "Server error: [error message]" }
     */
    public function show(string $id)
    {
        try {
            $record = SeleksiMahasiswaBaru::findOrFail($id);
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
     * Update an existing SeleksiMahasiswaBaru record.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing the updated data
     * @param  string  $id  The ID of the SeleksiMahasiswaBaru record to update
     * 
     * @return \Illuminate\Http\JsonResponse The SeleksiMahasiswaBaru record or error message
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     *
     * @response 200 {
     *     "id": 1,
     *    ...other SeleksiMahasiswaBaru attributes...
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
                'tahun_akademik' => 'sometimes|required|string',
                'daya_tampung' => 'sometimes|required|numeric',
                'pendaftar' => 'nullable|numeric',
                'lulus_seleksi' => 'nullable|numeric',
                'maba_reguler' => 'nullable|numeric',
                'maba_transfer' => 'nullable|numeric',
                'mhs_aktif_reguler' => 'nullable|numeric',
                'mhs_aktif_transfer' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    ['error' => $validator->errors()->first()],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $record = SeleksiMahasiswaBaru::findOrFail($id);
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
     * Delete a SeleksiMahasiswaBaru record by ID.
     *
     * @param string $id The ID of the SeleksiMahasiswaBaru to delete
     * @return \Illuminate\Http\JsonResponse The SeleksiMahasiswaBaru record or error message
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     */
    public function destroy(string $id)
    {
        try {
            $delete = SeleksiMahasiswaBaru::findOrFail($id);
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
