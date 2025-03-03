<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KerjasamaTridharmaPengmas extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kerjasama_tridharma_pengmas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tahun_ajaran_id',
        'lembaga_mitra',
        'tingkat',
        'judul_kegiatan',
        'manfaat',
        'waktu_durasi',
        'bukti_kerjasama',
        'tahun_berakhir',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
