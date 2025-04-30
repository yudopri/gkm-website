<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DosenTetapPT extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dosen_tetap_pt';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tahun_ajaran_id',
        'nama_dosen',
        'nidn_nidk',
        'gelar_magister',
        'gelar_doktor',
        'bidang_keahlian',
        'kesesuaian_kompetensi',
        'jabatan_akademik',
        'sertifikat_pendidik',
        'sertifikat_kompetensi',
        'mk_diampu',
        'kesesuaian_keahlian_mk',
        'mk_ps_lain',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'kesesuaian_kompeten_inti' => 'boolean',
        'kesesuaian_keahlian_mk' => 'boolean',
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
