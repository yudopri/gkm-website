<?php

namespace App\Http\Controllers\Api;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Controller for managing UserProfile endpoints.
 * 
 * @package App\Http\Controllers\Api
 */
class UserProfileController extends Controller
{
    /**
     * Display all UserProfile data.
     *
     * @return \Illuminate\Http\JsonResponse The UserProfile record or error message
     * 
     * @throws \Exception If there's an error during data retrieval
     * 
     * @response 200 {
     * "id": "1",
     * ...other UserProfile attributes...
     * }
     * @response 500 Server error
     */
    public function index()
    {
        try {
            $data = UserProfile::all();
            return response()->json($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created UserProfile resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing UserProfile data
     * 
     * @return \Illuminate\Http\JsonResponse The UserProfile record or error message
     *
     * @throws \Exception When an error occurs during record creation
     * 
     * @response 201 {
     *    "id": 1,
     *   ...other UserProfile attributes...
     * }
     * @response 422 Data validation error
     * @response 500 Server error
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nip' => 'nullable|string',
                'nik' => 'nullable|string',
                'nidn' => 'nullable|string',
                'nama' => 'required|string',
                'jabatan_fungsional' => 'required|string|exists:jabatan_fungsional,nama',
                'jabatan_id' => 'required|exists:jabatan,id',
                'handphone' => 'required|string',
                'user_id' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    ['error' => $validator->errors()->first()],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $validated = $request->all();
            $create = UserProfile::create($validated);

            return response()->json($create, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => 'Failed to create record: ' . $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Display the specified resource from UserProfile.
     *
     * @param string $id The ID of the UserProfile to retrieve
     * 
     * @return \Illuminate\Http\JsonResponse The UserProfile record or error message
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     *
     * @response 200 {
     *  "id": "1",
     *  ...other UserProfile attributes...
     * }
     * @response 404 { "error": "Record not found" }
     * @response 500 { "error": "Server error: [error message]" }
     */
    public function show(string $id)
    {
        try {
            $record = UserProfile::findOrFail($id);
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
     * Update an existing UserProfile record.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing the updated data
     * @param  string  $id  The ID of the UserProfile record to update
     * 
     * @return \Illuminate\Http\JsonResponse The UserProfile record or error message
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     *
     * @response 200 {
     *     "id": 1,
     *    ...other UserProfile attributes...
     * }
     * @response 404 Record not found
     * @response 422 Data validation error
     * @response 500 Server error
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nip' => 'nullable|string',
                'nik' => 'nullable|string',
                'nidn' => 'nullable|string',
                'nama' => 'sometimes|required|string',
                'jabatan_fungsional' => 'sometimes|required|string|exists:jabatan_fungsional,nama',
                'jabatan_id' => 'sometimes|required|exists:jabatan,id',
                'handphone' => 'sometimes|required|string',
                'user_id' => 'sometimes|required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    ['error' => $validator->errors()->first()],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $record = UserProfile::findOrFail($id);
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
     * Delete a UserProfile record by ID.
     *
     * @param string $id The ID of the UserProfile to delete
     * @return \Illuminate\Http\JsonResponse The UserProfile record or error message
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     */
    public function destroy(string $id)
    {
        try {
            $delete = UserProfile::findOrFail($id);
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
