<?php

namespace App\Http\Controllers\Api\KinerjaLulusan\PrestasiMahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PrestasiNonakademikMhs;
use App\Http\Controllers\Api\BaseApiTrait;
use Illuminate\Http\Request;

class NonAkademikController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return PrestasiNonakademikMhs::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'nama_kegiatan' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'prestasi' => 'required|string|max:255',
            'tahun' => 'required|integer',
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'nama_kegiatan' => 'sometimes|string|max:255',
            'tingkat' => 'sometimes|string|max:100',
            'prestasi' => 'sometimes|string|max:255',
            'tahun' => 'sometimes|integer',
        ];
    }
}
