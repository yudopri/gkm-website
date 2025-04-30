<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalKepuasanPengguna extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'eval_kepuasan_pengguna';
    protected $fillable = [
        'user_id',
        'jenis_kemampuan',
        'tingkat_kepuasan_sangat_baik',
        'tingkat_kepuasan_baik',
        'tingkat_kepuasan_cukup',
        'tingkat_kepuasan_kurang',
        'rencana_tindakan',
        'jumlah_lulusan',
        'jumlah_responden',
        'tahun',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
