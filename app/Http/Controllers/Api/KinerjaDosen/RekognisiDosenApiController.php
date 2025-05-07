<?php

namespace App\Http\Controllers\Api\KinerjaDosen;

use App\Http\Controllers\Api\BaseApiTrait;
use App\Http\Controllers\Controller;
use App\Models\RekognisiDosen;

/**
 * Controller for managing RekognisiDosen endpoints.
 * 
 * @package App\Http\Controllers\Api\KinerjaDosen
 */
class RekognisiDosenApiController extends Controller
{
    use BaseApiTrait;

    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function getModelClass()
    {
        return RekognisiDosen::class;
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
            'bidang_keahlian' => 'required|string',
            'nama_rekognisi' => 'required|string',
            'bukti_pendukung' => 'required|url',
            'tingkat' => 'required|string|in:lokal,nasional,internasional',
            'tahun' => 'required|string',
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
            'bidang_keahlian' => 'sometimes|required|string',
            'nama_rekognisi' => 'sometimes|required|string',
            'bukti_pendukung' => 'sometimes|required|url',
            'tingkat' => 'sometimes|required|string|in:lokal,nasional,internasional',
            'tahun' => 'sometimes|required|string',
        ];
    }
}
