<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DosenPembimbingTA extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dosen_pembimbing_ta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tahun_ajaran_id',
        'nama_dosen',
        'mhs_bimbingan_ps',
        'mhs_bimbingan_ps_lain',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
