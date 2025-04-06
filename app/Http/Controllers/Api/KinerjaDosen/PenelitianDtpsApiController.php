<?php

namespace App\Http\Controllers\Api\DataDosen;

use App\Http\Controllers\Api\BaseApiTrait;
use App\Http\Controllers\Controller;
use App\Models\PenelitianDtps;

/**
 * Controller for managing PenelitianDtps endpoints.
 * 
 * @package App\Http\Controllers\Api\KinerjaDosen
 */
class PenelitianDtpsApiController extends Controller
{
    use BaseApiTrait;

    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function getModelClass()
    {
        return PenelitianDtps::class;
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
            'jumlah_judul' => 'required|integer',
            'sumber_dana' => 'required|string|in:lokal,nasional,internasional',
            'tahun_penelitian' => 'required|string',
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
            'jumlah_judul' => 'sometimes|required|integer',
            'sumber_dana' => 'sometimes|required|string|in:lokal,nasional,internasional',
            'tahun_penelitian' => 'sometimes|required|string',
        ];
    }
}
