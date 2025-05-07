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
            $data = TahunAjaranSemester::all();
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
     * Display the specified resource from.
     *
     * @param string $id The ID of the to retrieve
     * 
     * @return \Illuminate\Http\JsonResponse The record or error message
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     *
     * @response 200 {
     *  "id": "1",
     *  ...other attributes...
     * }
     * @response 404 { "error": "Record not found" }
     * @response 500 { "error": "Server error: [error message]" }
     */
    public function store(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'tahun_ajaran' => 'required|string|max:255',
                'semester' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    ['error' => $validator->errors()->first()],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $validated = $request->all();
            $tahunAjaran = preg_replace('/[\/\s\-]/', '', $validated['tahun_ajaran']); // Remove any slashes, spaces or dashes
            if (strlen($tahunAjaran) == 8) {
                $formattedTahun = substr($tahunAjaran, 0, 4) . '-' . substr($tahunAjaran, 4);
                $validated['slug'] = Str::slug($formattedTahun . '-' . $validated['semester']);
            } else {
                // Fallback if the format is unexpected
                $validated['slug'] = Str::slug($validated['tahun_ajaran'] . '-' . $validated['semester']);
            }
            $create = TahunAjaranSemester::create($validated);

            return response()->json($create, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => 'Failed to create record: ' . $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Update an existing record.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing the updated data
     * @param  string  $id  The ID of the record to update
     * 
     * @return \Illuminate\Http\JsonResponse The record or error message
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     *
     * @response 200 {
     *     "id": 1,
     *    ...other attributes...
     * }
     * @response 404 Record not found
     * @response 422 Data validation error
     * @response 500 Server error
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'tahun_ajaran' => 'sometimes|required|string|max:255',
                'semester' => 'sometimes|required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    ['error' => $validator->errors()->first()],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $record = TahunAjaranSemester::findOrFail($id);
            $validated = $request->all();
            $tahunAjaran = preg_replace('/[\/\s\-]/', '', $validated['tahun_ajaran']); // Remove any slashes, spaces or dashes
            if (strlen($tahunAjaran) == 8) {
                $formattedTahun = substr($tahunAjaran, 0, 4) . '-' . substr($tahunAjaran, 4);
                $validated['slug'] = Str::slug($formattedTahun . '-' . $validated['semester']);
            } else {
                // Fallback if the format is unexpected
                $validated['slug'] = Str::slug($validated['tahun_ajaran'] . '-' . $validated['semester']);
            }
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
     * Delete a record by ID.
     *
     * @param string $id The ID of the to delete
     * @return \Illuminate\Http\JsonResponse The record or error message
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the record does not exist
     * @throws \Exception For any other server errors
     */
    public function destroy($id)
    {
        try {
            $delete = TahunAjaranSemester::findOrFail($id);
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
