<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KurikulumPembelajaran extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kurikulum_pembelajaran';
    protected $fillable = [
        'user_id',
        'nama_mata_kuliah',
        'kode_mata_kuliah',
        'mata_kuliah_kompetensi',
        'sks_kuliah',
        'sks_seminar',
        'sks_praktikum',
        'konversi_sks',
        'semester',
        'metode_pembelajaran',
        'dokumen',
        'unit_penyelenggara',
        'capaian_kuliah_sikap',
        'capaian_kuliah_pengetahuan',
        'capaian_kuliah_keterampilan_umum',
        'capaian_kuliah_keterampilan_khusus',
        'tahun',
    ];

}
