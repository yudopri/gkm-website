<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalTempatKerja extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'eval_tempat_kerja';
    protected $fiilable = [
        'user_id',
        'tahun',
        'jumlah_lulusan',
        'jumlah_lulusan_terlacak',
        'jumlah_lulusan_tingkat',
    ];
}
