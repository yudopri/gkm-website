<?php

namespace App\Http\Controllers\Api\DataDosen;

use App\Http\Controllers\Api\BaseApiTrait;
use App\Models\EwmpDosen;
use App\Http\Controllers\Controller;

/**
 * Controller for managing EwmpDosen endpoints.
 * 
 * @package App\Http\Controllers\Api\DataDosen
 */
class EwmpDosenApiController extends Controller
{
    use BaseApiTrait;

    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function getModelClass()
    {
        return EwmpDosen::class;
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
            'is_dtps' => 'nullable|boolean',
            'ps_diakreditasi' => 'nullable|numeric',
            'ps_lain_dalam_pt' => 'nullable|numeric',
            'ps_lain_luar_pt' => 'nullable|numeric',
            'penelitian' => 'nullable|numeric',
            'pkm' => 'nullable|numeric',
            'tugas_tambahan' => 'nullable|numeric',
            'jumlah_sks' => 'nullable|numeric',
            'avg_per_semester' => 'nullable|numeric',
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
            'is_dtps' => 'nullable|boolean',
            'ps_diakreditasi' => 'nullable|numeric',
            'ps_lain_dalam_pt' => 'nullable|numeric',
            'ps_lain_luar_pt' => 'nullable|numeric',
            'penelitian' => 'nullable|numeric',
            'pkm' => 'nullable|numeric',
            'tugas_tambahan' => 'nullable|numeric',
            'jumlah_sks' => 'nullable|numeric',
            'avg_per_semester' => 'nullable|numeric',
        ];
    }
}
