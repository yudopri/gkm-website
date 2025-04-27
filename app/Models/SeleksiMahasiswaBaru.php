<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeleksiMahasiswaBaru extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'seleksi_mahasiswa_baru';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tahun_ajaran_id',
        'tahun_akademik',
        'daya_tampung',
        'pendaftar',
        'lulus_seleksi',
        'maba_reguler',
        'maba_transfer',
        'mhs_aktif_reguler',
        'mhs_aktif_transfer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaranSemester::class, 'tahun_ajaran_id');
    }
}
