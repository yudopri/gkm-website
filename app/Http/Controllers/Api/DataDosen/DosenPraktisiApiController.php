<?php

namespace App\Http\Controllers\Api\DataDosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DosenIndustriPraktisi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Controller for managing Dosen Praktisi API endpoints.
 * 
 * This controller handles operations related to practical lecturers (dosen praktisi)
 * in the system, including fetching, creating, updating, and deleting dosen praktisi data
 * through API endpoints.
 * 
 * @package App\Http\Controllers\Api\DataDosen
 */
class DosenPraktisiApiController extends Controller
{
    /**
     * Display a listing of all Dosen Industri/Praktisi.
     *
     * This endpoint retrieves all records from the DosenIndustriPraktisi model.
     *
     * @return \Illuminate\Http\JsonResponse A JSON response containing:
     *                                       - On success: All dosen industri/praktisi records with 200 HTTP status
     *                                       - On failure: Error message with 500 HTTP status
     * @throws \Exception If there's an error during data retrieval
     */
    public function index()
    {
        try {
            $data = DosenIndustriPraktisi::all();
            return response()->json($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created dosen praktisi (industry practitioner) resource in storage.
     *
     * This method validates the incoming request for required fields and data integrity,
     * then creates a new DosenIndustriPraktisi record in the database.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing dosen praktisi data
     * @return \Illuminate\Http\JsonResponse
     *
     * Request parameters:
     * - user_id (required): ID of the associated user, must exist in users table
     * - tahun_ajaran_id (required): ID of the academic year, must exist in tahun_ajaran_semester table
     * - nama_dosen (required): Name of the dosen praktisi, max 255 characters
     * - nidk (optional): Numeric identifier for the dosen
     * - perusahaan (optional): Company/organization name
     * - pendidikan_tertinggi (optional): Highest education level
     * - bidang_keahlian (optional): Area of expertise, max 255 characters
     * - sertifikat_kompetensi (optional): Competency certificate information
     * - mk_diampu (optional): Course taught
     * - bobot_kredit_sks (optional): Credit weight in SKS
     *
     * @throws \Exception When an error occurs during record creation
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'tahun_ajaran_id' => 'required|exists:tahun_ajaran_semester,id',
                'nama_dosen' => 'required|string|max:255',
                'nidk' => 'nullable|numeric',
                'perusahaan' => 'nullable|string',
                'pendidikan_tertinggi' => 'nullable|string',
                'bidang_keahlian' => 'nullable|string|max:255',
                'sertifikat_kompetensi' => 'nullable|string',
                'mk_diampu' => 'nullable|string',
                'bobot_kredit_sks' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()],
                    Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $validated = $request->all();
            $create = DosenIndustriPraktisi::create($validated);

            return response()->json($create, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create record: ' . $e->getMessage()], 
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * Retrieves a single DosenIndustriPraktisi record by ID and returns it as JSON.
     *
     * @param string $id The ID of the DosenIndustriPraktisi to retrieve
     * @return \Illuminate\Http\JsonResponse The DosenIndustriPraktisi record or error message
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     *
     * @response 200 {
     *  "id": "1",
     *  ...other DosenIndustriPraktisi attributes...
     * }
     * @response 404 {
     *  "error": "Record not found"
     * }
     * @response 500 {
     *  "error": "Server error: [error message]"
     * }
     */
    public function show(string $id)
    {
        try {
            $record = DosenIndustriPraktisi::findOrFail($id);
            return response()->json($record, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Record not found'],
                Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update an existing DosenIndustriPraktisi record.
     *
     * This method updates the specified DosenIndustriPraktisi record with the validated data from the request.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing the updated data
     * @param  string  $id  The ID of the DosenIndustriPraktisi record to update
     * @return \Illuminate\Http\JsonResponse  The updated record on success, or an error response on failure
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException  When the record with the given ID is not found
     * @throws \Exception  When a server error occurs during the update process
     *
     * @response 200 {
     *     "id": 1,
     *     "user_id": 123,
     *     "tahun_ajaran_id": 456,
     *     "nama_dosen": "John Doe",
     *     "nidk": "123456",
     *     "perusahaan": "Example Corp",
     *     "pendidikan_tertinggi": "S3",
     *     "bidang_keahlian": "Software Engineering",
     *     "sertifikat_kompetensi": "AWS Certified Developer",
     *     "mk_diampu": "Web Programming",
     *     "bobot_kredit_sks": 3,
     *     "created_at": "2023-01-01T00:00:00.000000Z",
     *     "updated_at": "2023-01-02T00:00:00.000000Z"
     * }
     * @response 404 {"error": "Record not found"}
     * @response 422 {"error": "The user id field is required."}
     * @response 500 {"error": "Server error: Error message"}
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'sometimes|required|exists:users,id',
                'tahun_ajaran_id' => 'sometimes|required|exists:tahun_ajaran_semester,id',
                'nama_dosen' => 'sometimes|required|string|max:255',
                'nidk' => 'nullable|numeric',
                'perusahaan' => 'nullable|string',
                'pendidikan_tertinggi' => 'nullable|string',
                'bidang_keahlian' => 'nullable|string|max:255',
                'sertifikat_kompetensi' => 'nullable|string',
                'mk_diampu' => 'nullable|string',
                'bobot_kredit_sks' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()],
                    Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $record = DosenIndustriPraktisi::findOrFail($id);
            $validated = $request->all();
            $record->update($validated);

            return response()->json($record, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Record not found'],
                Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a dosen praktisi record by ID.
     *
     * This method attempts to find and delete a DosenIndustriPraktisi record
     * with the specified ID. If successful, returns a success message.
     * If the record is not found, returns a 404 error.
     * If any other error occurs, returns a 500 error with the exception message.
     *
     * @param string $id The ID of the dosen praktisi to delete
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the result of the operation
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException When the record is not found
     * @throws \Exception When a server error occurs
     */
    public function destroy(string $id)
    {
        try {
            $delete = DosenIndustriPraktisi::findOrFail($id);
            $delete->delete();

            return response()->json(['message' => 'Record deleted successfully'],
                Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Record not found'],
                Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
