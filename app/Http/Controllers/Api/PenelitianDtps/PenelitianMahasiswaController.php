<?php

namespace App\Http\Controllers\Api\PenelitianDtps;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseApiTrait;
use App\Models\DtpsPenelitianMahasiswa;
use Illuminate\Http\Request;

class PenelitianMahasiswaController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return DtpsPenelitianMahasiswa::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'nama_dosen' => 'required|string',
            'tema_penelitian' => 'required|string',
            'nama_mahasiswa' => 'required|string',
            'judul' => 'required|string',
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'nama_dosen' => 'sometimes|string',
            'tema_penelitian' => 'sometimes|string',
            'nama_mahasiswa' => 'sometimes|string',
            'judul' => 'sometimes|string',
        ];
    }
}
