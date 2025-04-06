<?php

namespace App\Http\Controllers\Api\KualitasPembelajaran;

use App\Http\Controllers\Controller;
use App\Models\IntegrasiPenelitian;
use App\Http\Controllers\Api\BaseApiTrait;
use Illuminate\Http\Request;

class IntegrasiPenelitianController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return IntegrasiPenelitian::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'judul_penelitian' => 'required|string|max:255',
            'nama_dosen' => 'required|string|max:255',
            'mata_kuliah' => 'required|string|max:255',
            'bentuk_integrasi' => 'required|string|max:255',
            'tahun' => 'required|integer',
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'judul_penelitian' => 'sometimes|string|max:255',
            'nama_dosen' => 'sometimes|string|max:255',
            'mata_kuliah' => 'sometimes|string|max:255',
            'bentuk_integrasi' => 'sometimes|string|max:255',
            'tahun' => 'sometimes|integer',
        ];
    }
}
