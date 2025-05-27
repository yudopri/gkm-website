<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class AuthControllerApi extends Controller
{
    public function requestToken(Request $request): JsonResponse
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return response()->json([
            'message' => 'User tidak ditemukan atau password salah'
        ], 401);
    }

    $user = User::where('email', $request->email)->firstOrFail();

    // ✅ Cek jika email belum diverifikasi
    if (!$user->hasVerifiedEmail()) {
        // Kirim ulang email verifikasi
        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Email belum diverifikasi. Tautan verifikasi telah dikirim ulang.'
        ], 403);
    }

    // ✅ Email sudah diverifikasi → buat token
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'id' => $user->id,
        'token' => $token,
    ], Response::HTTP_OK);
}
    public function apiregister(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 401);
        }

        // Buat user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Buat profile default
        $user->profile()->create([
            'nama' => $request->name,
        ]);

        // Kirim email verifikasi tanpa login
        event(new Registered($user));

        return response()->json([
            'message' => 'User berhasil didaftarkan. Silakan verifikasi email Anda.',
        ], Response::HTTP_OK);
    }
}
