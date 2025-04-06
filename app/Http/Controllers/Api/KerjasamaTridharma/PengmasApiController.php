<?php

namespace App\Http\Controllers\Api\KerjasamaTridharma;

use App\Http\Controllers\Api\BaseApiTrait;
use App\Http\Controllers\Controller;
use App\Models\KerjasamaTridharmaPengmas;

/**
 * Controller for managing endpoints.
 * 
 * @package App\Http\Controllers\Api\KerjasamaTridharma;
 */
class PengmasApiController extends Controller
{
    use BaseApiTrait;

    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function getModelClass()
    {
        return KerjasamaTridharmaPengmas::class;
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
            'lembaga_mitra' => 'required|string',
            'tingkat' => 'required|string|in:lokal,nasional,internasional',
            'judul_kegiatan' => 'required|string',
            'manfaat' => 'required|string',
            'waktu_durasi' => 'required|string',
            'bukti_kerjasama' => 'required|url',
            'tahun_berakhir' => 'required|string',
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
            'lembaga_mitra' => 'sometimes|required|string',
            'tingkat' => 'sometimes|required|string|in:lokal,nasional,internasional',
            'judul_kegiatan' => 'sometimes|required|string',
            'manfaat' => 'sometimes|required|string',
            'waktu_durasi' => 'sometimes|required|string',
            'bukti_kerjasama' => 'sometimes|required|url',
            'tahun_berakhir' => 'sometimes|required|string',
        ];
    }
}
