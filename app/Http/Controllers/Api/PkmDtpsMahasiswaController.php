<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PkmDtpsMahasiswa;
use App\Http\Controllers\Api\BaseApiTrait;


class PkmDtpsMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use BaseApiTrait;

    protected function getModelClass()
    {
        return DtpsPenelitianMahasiswa::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'tema' => 'required|string',
            'nama_mhs' => 'required|string',
            'judul' => 'required|string',
            'tahun' => 'required|string',
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'tema' => 'required|string',
            'nama_mhs' => 'required|string',
            'judul' => 'required|string',
            'tahun' => 'required|string',
        ];
    }
   
}
