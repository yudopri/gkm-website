<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PkmDtpsMahasiswa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pkm_dtps_mahasiswa';
    protected $fillable = [
        'user_id',
        'tema',
        'nama_mhs',
        'judul',
        'tahun',
    ];
}
