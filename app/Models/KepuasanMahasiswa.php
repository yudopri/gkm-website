<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KepuasanMahasiswa extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kepuasan_mahasiswa';

protected $fillable = [
        'user_id',
        'aspek_penilaian',
        'tingkat_kepuasan_sangat_baik',
        'tingkat_kepuasan_baik',
        'tingkat_kepuasan_cukup',
        'tingkat_kepuasan_kurang',
        'rencana_tindakan',
        'tahun',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
