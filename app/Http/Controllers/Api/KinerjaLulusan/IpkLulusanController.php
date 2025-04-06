<?php

namespace App\Http\Controllers\Api\KinerjaLulusan;

use App\Http\Controllers\Controller;
use App\Models\IpkLulusan;
use App\Http\Controllers\Api\BaseApiTrait;
use Illuminate\Http\Request;

class IpkLulusanController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return IpkLulusan::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'tahun' => 'required|integer',
            'jumlah_lulusan' => 'required|integer',
            'ipk' => 'required|numeric|between:0,4.00',
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'tahun' => 'sometimes|integer',
            'jumlah_lulusan' => 'sometimes|integer',
            'ipk' => 'sometimes|numeric|between:0,4.00',
        ];
    }
}
