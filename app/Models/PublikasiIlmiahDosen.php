<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublikasiIlmiahDosen extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'publikasi_ilmiah_dosen';
    protected $fiilable = [
        'user_id',
        'nama_dosen',
        'judul_artikel',
        'tahun',
    ];
}
