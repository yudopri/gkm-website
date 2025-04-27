<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DosenIndustriPraktisi extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dosen_industri_praktisi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tahun_ajaran_id',
        'nama_dosen',
        'nidk',
        'perusahaan',
        'pendidikan_tertinggi',
        'bidang_keahlian',
        'sertifikat_kompetensi',
        'mk_diampu',
        'bobot_kredit_sks',
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
