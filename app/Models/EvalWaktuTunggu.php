<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalWaktuTunggu extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'eval_waktu_tunggu';
    protected $fiilable = [
        'user_id',
        'tahun',
        'jumlah_lulusan',
        'jumlah_lulusan_terlacak',
        'jumlah_lulusan_terlacak_dipesan',
        'jumlah_lulusan_waktu',
    ];
}
