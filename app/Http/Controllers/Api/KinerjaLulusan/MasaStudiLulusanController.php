<?php

namespace App\Http\Controllers\Api\KinerjaLulusan;

use App\Http\Controllers\Controller;
use App\Models\MasaStudiLulusan;
use App\Http\Controllers\Api\BaseApiTrait;
use Illuminate\Http\Request;

class MasaStudiLulusanController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return MasaStudiLulusan::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'tahun' => 'required|integer',
            'jumlah_mhs_diterima' => 'required|integer',
            'jumlah_mhs_lulus' => 'required|integer',
            'jumlah_lulusan' => 'required|integer',
            'mean_masa_studi' => 'required|numeric|min:0',
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'tahun' => 'sometimes|integer',
            'jumlah_mhs_diterima' => 'sometimes|integer',
            'jumlah_mhs_lulus' => 'sometimes|integer',
            'jumlah_lulusan' => 'sometimes|integer',
            'mean_masa_studi' => 'sometimes|numeric|min:0',
        ];
    }
}
