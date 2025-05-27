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
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;


class AuthControllerApi extends Controller
{
    public function requestToken(Request $request): JsonResponse
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
        ], 422);
    }

    // Cari user
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Email atau password salah'
        ], 401);
    }

    // Cek verifikasi email
    if (!$user->hasVerifiedEmail()) {
        // Kirim ulang email verifikasi secara manual
        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Email belum diverifikasi. Tautan verifikasi telah dikirim ulang.'
        ], 403);
    }

    // Login dan buat token
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
