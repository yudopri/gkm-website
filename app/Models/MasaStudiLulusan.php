<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasaStudiLulusan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'masa_studi_lulusan';
    protected $fiilable = [
        'user_id',
        'tahun',
        'jumlah_mhs_diterima',
        'jumlah_mhs_lulus',
        'jumlah_lulusan',
        'mean_masa_studi',
    ];
}
