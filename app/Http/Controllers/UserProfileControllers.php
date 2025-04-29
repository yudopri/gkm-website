<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Jurusan;
use App\Models\Jabatan;
use App\Models\JabatanFungsional;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserProfileControllers extends Controller
{
    public function show($id)
{
    try {
        // Mengambil profile berdasarkan ID user yang dikirimkan
        $profile = UserProfile::with('user')->where('user_id', $id)->first();

        // Jika data tidak ditemukan, redirect kembali dengan pesan error
        if (!$profile) {
            return back()->withErrors('Profile tidak ditemukan.');
        }

        return view('pages.admin.profile.show', [
            'profile' => $profile,
            'user_id' => $id,
        ]);
    } catch (\Exception $e) {
        // Menangani error dan mengirimkan pesan error
        return back()->withErrors($e->getMessage());
    }
}
public function edit($id)
{
    try {
        // Mengambil profile berdasarkan ID user yang dikirimkan
        $profile = UserProfile::with('user')->where('user_id', $id)->first();
        // Mengambil daftar jurusan
        $jurusanList = Jurusan::all();
        $jabatanList = Jabatan::all();
        $jabatanFungsionalList = JabatanFungsional::all();

        // Jika data tidak ditemukan, redirect kembali dengan pesan error
        if (!$profile) {
            return back()->withErrors('Profile tidak ditemukan.');
        }

        return view('pages.admin.profile.edit', [
            'profile' => $profile,
            'jurusanList' => $jurusanList,
            'jabatanList' => $jabatanList,
            'id' => $id,
            'jabatanFungsionalList' => $jabatanFungsionalList,
        ]);
    } catch (\Exception $e) {
        // Menangani error dan mengirimkan pesan error
        return back()->withErrors($e->getMessage());
    }
}

public function update(Request $request, $id)
{
    $profile = UserProfile::findOrFail($id);

    // Validasi request
    $validator = Validator::make($request->all(), [
        'nama' => 'required|string|max:255',
        'nip' => 'required|string|max:50',
        'nidn' => 'required|string|max:50',
        'jabatan_fungsional' => 'required|string|max:255',
        'jabatan_id' => 'required|exists:jabatan,id',
        'program_studi_id' => 'required|exists:program_studi,id',
        'avatar' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator->messages()->all()[0])->withInput();
    }

    $validated = $validator->validated();

    // Handle upload avatar
    if ($request->hasFile('avatar')) {
        $directory = public_path('frontend/img');

        if (!\File::exists($directory)) {
            \File::makeDirectory($directory, 0755, true);
        }

        $fileName = time() . '_' . $request->file('avatar')->getClientOriginalName();
        $filePath = 'frontend/img/' . $fileName;

        $request->file('avatar')->move($directory, $fileName);

        $validated['avatar'] = $filePath;

        // Kalau avatar disimpan juga di tabel User
        $profile->user->update([
            'avatar' => $filePath,
        ]);
    }

    // Update profile
    $profile->update($validated);

    // Update roles berdasarkan jabatan_fungsional
    $user = $profile->user;

    $roles = [];

    switch ($validated['jabatan_fungsional']) {
        case 'Lektor Kepala':
            $roles = ['dosen'];
            break;
        case 'Ketua Prodi D4':
            $roles = ['dosen', 'D4'];
            break;
        case 'Ketua Prodi D3':
            $roles = ['dosen', 'D3'];
            break;
        case 'Mahasiswa S2':
            $roles = ['D4', 'S2'];
            break;
        case 'Staff TU':
            $roles = ['staff'];
            break;
        case 'Teknisi Lab':
            $roles = ['teknisi'];
            break;

        default:
            $roles = ['staff'];
            break;
    }



    // Sync roles ke user
    $user->syncRoles($roles);

    return redirect()->route('admin.profile.show', $id)
        ->with('toast_success', 'Profil dan role berhasil diperbarui.');
}

}
