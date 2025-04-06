<?php

namespace App\Http\Controllers\Api\DataDosen;

use App\Http\Controllers\Api\BaseApiTrait;
use App\Http\Controllers\Controller;
use App\Models\ProdukTeradopsiDosen;

/**
 * Controller for managing ProdukTeradopsiDosen endpoints.
 * 
 * @package App\Http\Controllers\Api\KinerjaDosen
 */
class ProdukTeradopsiApiController extends Controller
{
    use BaseApiTrait;

    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function getModelClass()
    {
        return ProdukTeradopsiDosen::class;
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
            'nama_produk' => 'required|string',
            'deskripsi_produk' => 'required|string',
            'bukti' => 'required|string',
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
            'nama_produk' => 'sometimes|required|string',
            'deskripsi_produk' => 'sometimes|required|string',
            'bukti' => 'sometimes|required|string',
            'tahun' => 'sometimes|required|string|max:4',
        ];
    }
}
