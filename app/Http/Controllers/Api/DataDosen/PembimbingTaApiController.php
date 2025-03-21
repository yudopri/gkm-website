<?php

namespace App\Http\Controllers\Api\DataDosen;

use App\Http\Controllers\Api\BaseApiTrait;
use App\Models\DosenPembimbingTA;
use App\Http\Controllers\Controller;

/**
 * Controller for managing DosenPembimbingTA endpoints.
 * 
 * @package App\Http\Controllers\Api\DataDosen
 */
class PembimbingTaApiController extends Controller
{
    use BaseApiTrait;

    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function getModelClass()
    {
        return DosenPembimbingTA::class;
    }
    
    /**
     * Get validation rules for storing a new record.
     *
     * @return array
     */
    protected function getStoreValidationRules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran_semester,id',
            'nama_dosen' => 'required|string|max:255',
            'mhs_bimbingan_ps' => 'nullable|numeric',
            'mhs_bimbingan_ps_lain' => 'nullable|numeric',
        ];
    }
    
    /**
     * Get validation rules for updating a record.
     *
     * @return array
     */
    protected function getUpdateValidationRules()
    {
        return [
            'user_id' => 'sometimes|required|exists:users,id',
            'tahun_ajaran_id' => 'sometimes|required|exists:tahun_ajaran_semester,id',
            'nama_dosen' => 'sometimes|required|string|max:255',
            'mhs_bimbingan_ps' => 'nullable|numeric',
            'mhs_bimbingan_ps_lain' => 'nullable|numeric',
        ];
    }
}
