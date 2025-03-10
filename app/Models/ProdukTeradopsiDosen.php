<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukTeradopsiDosen extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'produk_teradopsi_dosen';
    protected $fiilable = [
        'user_id',
        'nama_dosen',
        'nama_produk',
        'deskripsi_produk',
        'bukti',
        'tahun',
    ];
}
