<?php

namespace App\Http\Controllers\Api\KinerjaLulusan\EvaluasiLulusan;

use App\Http\Controllers\Controller;
use App\Models\EvalTempatKerja;
use App\Http\Controllers\Api\BaseApiTrait;
use Illuminate\Http\Request;

class TempatKerjaController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return EvalTempatKerja::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'tahun' => 'required|integer',
            'jumlah_lulusan' => 'required|integer|min:0',
            'jumlah_lulusan_terlacak' => 'required|integer|min:0',
            'jumlah_lulusan_tingkat' => 'required|integer|min:0',
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'tahun' => 'sometimes|integer',
            'jumlah_lulusan' => 'sometimes|integer|min:0',
            'jumlah_lulusan_terlacak' => 'sometimes|integer|min:0',
            'jumlah_lulusan_tingkat' => 'sometimes|integer|min:0',
        ];
    }
}
