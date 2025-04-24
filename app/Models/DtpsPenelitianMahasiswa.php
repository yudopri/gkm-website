<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtpsPenelitianMahasiswa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dtps_penelitian_mahasiswa';
    protected $fillable = [
        'user_id',
        'nama_dosen',
        'tema_penelitian',
        'nama_mahasiswa',
        'judul',
        'tahun',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
