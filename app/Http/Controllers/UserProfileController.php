<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function update(Request $request, $id)
{
    $profile = UserProfile::findOrFail($id);

    // Update profil
    $profile->update([
        'nama' => $request->nama,
        'jabatan_fungsional' => $request->jabatan_fungsional,
        'jabatan_id' => $request->jabatan_id,
        'handphone' => $request->handphone,
    ]);

    // Dapatkan User terkait
    $user = $profile->user;

    // Mapping jabatan ke role
    $roles = [];
    switch ($request->jabatan_fungsional) {
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
            $roles = ['staff']; // Default role kalau jabatan tidak cocok
            break;
    }

    // Pastikan semua role yang dipilih sudah ada
    foreach ($roles as $role) {
        Role::findOrCreate($role);
    }

    // Sync roles ke user
    $user->syncRoles($roles);

    return redirect()->back()->with('success', 'Profil dan role berhasil diperbarui.');
}
}
