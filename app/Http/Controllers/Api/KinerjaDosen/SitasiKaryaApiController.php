<?php

namespace App\Http\Controllers\Api\KinerjaDosen;

use App\Http\Controllers\Api\BaseApiTrait;
use App\Http\Controllers\Controller;
use App\Models\SitasiKaryaDosen;

/**
 * Controller for managing RekognisiDosen endpoints.
 * 
 * @package App\Http\Controllers\Api\KinerjaDosen
 */
class SitasiKaryaApiController extends Controller
{
    use BaseApiTrait;

    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function getModelClass()
    {
        return SitasiKaryaDosen::class;
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
            'nama_dosen' => 'required|string',
            'judul_sitasi' => 'required|string',
            'tahun' => 'required|string|max:4',
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
            'nama_dosen' => 'sometimes|required|string',
            'judul_sitasi' => 'sometimes|required|string',
            'tahun' => 'sometimes|required|string|max:4',
        ];
    }
}
