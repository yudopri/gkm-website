<?php

namespace App\Http\Controllers\Api\DataDosen;

use App\Http\Controllers\Api\BaseApiTrait;
use App\Models\DosenIndustriPraktisi;
use App\Http\Controllers\Controller;

/**
 * Controller for managing DosenIndustriPraktisi endpoints.
 * 
 * @package App\Http\Controllers\Api\DataDosen
 */
class DosenPraktisiApiController extends Controller
{
    use BaseApiTrait;

    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function getModelClass()
    {
        return DosenIndustriPraktisi::class;
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
            'nidk' => 'nullable|numeric',
            'perusahaan' => 'nullable|string',
            'pendidikan_tertinggi' => 'nullable|string',
            'bidang_keahlian' => 'nullable|string|max:255',
            'sertifikat_kompetensi' => 'nullable|string',
            'mk_diampu' => 'nullable|string',
            'bobot_kredit_sks' => 'nullable|numeric',
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
            'nidk' => 'nullable|numeric',
            'perusahaan' => 'nullable|string',
            'pendidikan_tertinggi' => 'nullable|string',
            'bidang_keahlian' => 'nullable|string|max:255',
            'sertifikat_kompetensi' => 'nullable|string',
            'mk_diampu' => 'nullable|string',
            'bobot_kredit_sks' => 'nullable|numeric',
        ];
    }
}
