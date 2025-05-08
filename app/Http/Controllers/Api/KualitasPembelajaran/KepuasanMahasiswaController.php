<?php

namespace App\Http\Controllers\Api\KualitasPembelajaran;

use App\Http\Controllers\Controller;
use App\Models\KepuasanMahasiswa;
use App\Http\Controllers\Api\BaseApiTrait;
use Illuminate\Http\Request;

class KepuasanMahasiswaController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return KepuasanMahasiswa::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'aspek_penilaian' => 'required|string|max:255',
            'tingkat_kepuasan_sangat_baik' => 'required|integer|min:0',
            'tingkat_kepuasan_baik' => 'required|integer|min:0',
            'tingkat_kepuasan_cukup' => 'required|integer|min:0',
            'tingkat_kepuasan_kurang' => 'required|integer|min:0',
            'rencana_tindakan' => 'required|string|max:255',
            'tahun' => 'required|integer',
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'aspek_penilaian' => 'sometimes|string|max:255',
            'tingkat_kepuasan_sangat_baik' => 'sometimes|integer|min:0',
            'tingkat_kepuasan_baik' => 'sometimes|integer|min:0',
            'tingkat_kepuasan_cukup' => 'sometimes|integer|min:0',
            'tingkat_kepuasan_kurang' => 'sometimes|integer|min:0',
            'rencana_tindakan' => 'sometimes|string|max:255',
            'tahun' => 'sometimes|integer',
        ];
    }
}