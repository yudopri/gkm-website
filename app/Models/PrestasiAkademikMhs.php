<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiAkademikMhs extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prestasi_akademik_mhs';
    protected $fillable = [
        'user_id',
        'nama_kegiatan',
        'tingkat',
        'prestasi',
        'tahun',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
