<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublikasiMahasiswa extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'publikasi_mahasiswa';

    // Correct the typo here
    protected $fillable = [
        'user_id',
        'nama_mahasiswa',
        'judul_artikel',
        'jenis_artikel',
        'tahun',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
