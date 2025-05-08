<?php

namespace App\Http\Controllers\Api\PenelitianDtps;

use App\Http\Controllers\Controller;
use App\Models\PKMDTPSMahasiswa;
use App\Http\Controllers\Api\BaseApiTrait;
use Illuminate\Http\Request;

class PKMDTPSMahasiswaController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return PKMDTPSMahasiswa::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'tema' => 'required|string|max:255',
            'nama_mhs' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'tema' => 'sometimes|string|max:255',
            'nama_mhs' => 'sometimes|string|max:255',
            'judul' => 'sometimes|string|max:255',
            'tahun' => 'sometimes|integer',
        ];
    }
}