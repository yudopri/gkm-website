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
        'masa_studi',
        'jumlah_mhs_diterima',
        'jumlah_mhs_lulus_akhir_ts',
        'jumlah_mhs_lulus_akhir_ts_1',
        'jumlah_mhs_lulus_akhir_ts_2',
        'jumlah_mhs_lulus_akhir_ts_3',
        'jumlah_mhs_lulus_akhir_ts_4',
        'jumlah_mhs_lulus_akhir_ts_5',
        'jumlah_mhs_lulus_akhir_ts_6',
        'jumlah_lulusan',
        'mean_masa_studi',
    ];
}
