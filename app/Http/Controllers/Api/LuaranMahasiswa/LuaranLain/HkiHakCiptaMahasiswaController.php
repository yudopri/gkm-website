<?php

namespace App\Http\Controllers\Api\LuaranMahasiswa\LuaranLain;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseApiTrait;
use App\Models\HkiHakCiptaMahasiswa;

class HkiHakCiptaMahasiswaController extends Controller
{
     /**
     * Display a listing of the resource.
     */
   use BaseApiTrait;

    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function getModelClass()
    {
        return HkiHakCiptaMahasiswa::class;
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
            'lembaga_mitra' => 'required|string',
            'luaran_penelitian' => 'required|string',
            'tahun' => 'required|string|max:4',
            'keterangan' => 'required|string',
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
            'lembaga_mitra' => 'sometimes|required|string',
            'luaran_penelitian' => 'sometimes|required|string',
            'tahun' => 'sometimes|required|string|max:4',
            'keterangan' => 'sometimes|required|string',
        ];
    }
}
