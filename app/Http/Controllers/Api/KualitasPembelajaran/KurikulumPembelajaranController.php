<?php

namespace App\Http\Controllers\Api\KualitasPembelajaran;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseApiTrait;
use App\Models\KurikulumPembelajaran;
use Illuminate\Http\Request;

class KurikulumPembelajaranController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return KurikulumPembelajaran::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'nama_mata_kuliah' => 'required|string',
            'kode_mata_kuliah' => 'required|string',
            'sks' => 'required|integer',
            'semester' => 'required|integer',
            'metode_pembelajaran' => 'required|string',
            'dokumen' => 'nullable|string',
            'unit_penyelengara' => 'nullable|string',
            'sks_kuliah' => 'nullable|integer',
            'capaian_kuliah' => 'nullable|string',
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'nama_mata_kuliah' => 'sometimes|string',
            'kode_mata_kuliah' => 'sometimes|string',
            'sks' => 'sometimes|integer',
            'semester' => 'sometimes|integer',
            'metode_pembelajaran' => 'sometimes|string',
            'dokumen' => 'sometimes|string|nullable',
            'unit_penyelengara' => 'sometimes|string|nullable',
            'sks_kuliah' => 'sometimes|integer|nullable',
            'capaian_kuliah' => 'sometimes|string|nullable',
        ];
    }
}
