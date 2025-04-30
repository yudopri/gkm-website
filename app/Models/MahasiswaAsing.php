<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MahasiswaAsing extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mahasiswa_asing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tahun_ajaran_id',
        'mhs_aktif',
        'mhs_asing_fulltime',
        'mhs_asing_parttime',
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
