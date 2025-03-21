<?php

namespace App\Http\Controllers\Api\DataMahasiswa;

use App\Http\Controllers\Api\BaseApiTrait;
use App\Models\SeleksiMahasiswaBaru;
use App\Http\Controllers\Controller;

/**
 * Controller for managing SeleksiMahasiswaBaru endpoints.
 * 
 * @package App\Http\Controllers\Api\DataMahasiswa
 */
class SeleksiMabaApiController extends Controller
{
    use BaseApiTrait;

    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function getModelClass()
    {
        return SeleksiMahasiswaBaru::class;
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
            'tahun_akademik' => 'required|string',
            'daya_tampung' => 'required|numeric',
            'pendaftar' => 'nullable|numeric',
            'lulus_seleksi' => 'nullable|numeric',
            'maba_reguler' => 'nullable|numeric',
            'maba_transfer' => 'nullable|numeric',
            'mhs_aktif_reguler' => 'nullable|numeric',
            'mhs_aktif_transfer' => 'nullable|numeric',
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
            'tahun_akademik' => 'sometimes|required|string',
            'daya_tampung' => 'sometimes|required|numeric',
            'pendaftar' => 'nullable|numeric',
            'lulus_seleksi' => 'nullable|numeric',
            'maba_reguler' => 'nullable|numeric',
            'maba_transfer' => 'nullable|numeric',
            'mhs_aktif_reguler' => 'nullable|numeric',
            'mhs_aktif_transfer' => 'nullable|numeric',
        ];
    }
}
