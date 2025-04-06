<?php

namespace App\Http\Controllers\Api\KinerjaLulusan\EvaluasiLulusan;

use App\Http\Controllers\Controller;
use App\Models\EvalKepuasanPengguna;
use App\Http\Controllers\Api\BaseApiTrait;
use Illuminate\Http\Request;

class KepuasanPenggunaController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return EvalKepuasanPengguna::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'tahun' => 'required|integer',
            'jumlah_lulusan' => 'required|integer|min:0',
            'jumlah_tanggapan' => 'required|integer|min:0',
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'tahun' => 'sometimes|integer',
            'jumlah_lulusan' => 'sometimes|integer|min:0',
            'jumlah_tanggapan' => 'sometimes|integer|min:0',
        ];
    }
}
