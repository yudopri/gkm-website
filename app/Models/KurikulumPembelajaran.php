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
        'sks',
        'semester',
        'metode_pembelajaran',
        'dokumen',
        'unit_penyelengara',
        'sks_kuliah',
        'capaian_kuliah',
    ];

}
