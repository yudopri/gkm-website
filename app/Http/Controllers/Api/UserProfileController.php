<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    public function index()
    {
        return response()->json(UserProfile::all(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nip' => 'nullable|unique:user_profiles',
                'nik' => 'nullable|unique:user_profiles',
                'nidn' => 'nullable|unique:user_profiles',
                'nama' => 'required|string',
                'jabatan_fungsional' => 'required|string',
                'jabatan_id' => 'required|exists:jabatan,id',
                'handphone' => 'required|string',
                'user_id' => 'required|exists:users,id',
            ]);
    
            $profile = UserProfile::create($request->all());
    
            return response()->json($profile, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $profile = UserProfile::findOrFail($id);
            return response()->json($profile, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $profile = UserProfile::find($id);
        if (!$profile) {
            return response()->json(['message' => 'User profile not found'], Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'nip' => 'nullable|string',
            'nik' => 'nullable|string',
            'nidn' => 'nullable|string',
            'nama' => 'required|string',
            'jabatan_fungsional' => 'required|string',
            'jabatan_id' => 'required|exists:jabatan,id',
            'handphone' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message'=> $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $profile->update($request->all());

        return response()->json($profile, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $profile = UserProfile::find($id);
        if (!$profile) {
            return response()->json(['message' => 'User profile not found'], Response::HTTP_NOT_FOUND);
        }

        $profile->delete();
        return response()->json(['message' => 'User profile deleted'], Response::HTTP_OK);
    }
}
