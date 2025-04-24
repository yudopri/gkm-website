<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SitasiKaryaDosen extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sitasi_karya_dosen';
    protected $fillable = [
        'user_id',
        'nama_dosen',
        'judul_artikel',
        'jumlah_sitasi',
        'tahun',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
