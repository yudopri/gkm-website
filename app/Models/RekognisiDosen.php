<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekognisiDosen extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rekognisi_dtps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nama_dosen',
        'bidang_keahlian',
        'nama_rekognisi',
        'bukti_pendukung',
        'tingkat',
        'tahun',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
