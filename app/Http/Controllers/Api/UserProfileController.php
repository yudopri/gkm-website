<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserProfileController extends Controller
{
    public function index()
    {
        return response()->json(UserProfile::all(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
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
    }

    public function show($id)
    {
        $profile = UserProfile::find($id);
        if (!$profile) {
            return response()->json(['message' => 'User profile not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($profile, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $profile = UserProfile::find($id);
        if (!$profile) {
            return response()->json(['message' => 'User profile not found'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'nip' => 'nullable|unique:user_profiles,nip,' . $id,
            'nik' => 'nullable|unique:user_profiles,nik,' . $id,
            'nidn' => 'nullable|unique:user_profiles,nidn,' . $id,
            'nama' => 'required|string',
            'jabatan_fungsional' => 'required|string',
            'jabatan_id' => 'required|exists:jabatan,id',
            'handphone' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

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
