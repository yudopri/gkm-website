<?php

namespace App\Http\Controllers\Api\DataDosen;

use App\Http\Controllers\Api\BaseApiTrait;
use App\Http\Controllers\Controller;
use App\Models\PublikasiIlmiahDosen;

/**
 * Controller for managing PublikasiIlmiahDosen endpoints.
 * 
 * @package App\Http\Controllers\Api\KinerjaDosen
 */
class PublikasiIlmiahApiController extends Controller
{
    use BaseApiTrait;

    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function getModelClass()
    {
        return PublikasiIlmiahDosen::class;
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
            'judul_artikel' => 'required|string',
            'jenis_artikel' => 'required|string',
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
            'judul_artikel' => 'sometimes|required|string',
            'jenis_artikel' => 'sometimes|required|string',
            'tahun' => 'sometimes|required|string|max:4',
        ];
    }
}
