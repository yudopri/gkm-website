<?php

namespace App\Http\Controllers\Api\DataMahasiswa;

use App\Http\Controllers\Api\BaseApiTrait;
use App\Models\MahasiswaAsing;
use App\Http\Controllers\Controller;

/**
 * Controller for managing MahasiswaAsing endpoints.
 * 
 * @package App\Http\Controllers\Api\DataMahasiswa
 */
class MahasiswaAsingApiController extends Controller
{
    use BaseApiTrait;

    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function getModelClass()
    {
        return MahasiswaAsing::class;
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
            'mhs_aktif' => 'nullable|numeric',
            'mhs_asing_fulltime' => 'nullable|numeric',
            'mhs_asing_parttime' => 'nullable|numeric',
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
            'mhs_aktif' => 'nullable|numeric',
            'mhs_asing_fulltime' => 'nullable|numeric',
            'mhs_asing_parttime' => 'nullable|numeric',
        ];
    }
}
