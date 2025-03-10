<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiNonakademikMhs extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prestasi_nonakademik_mhs';
    protected $fillable = [
        'user_id',
        'nama_kegiatan',
        'tingkat',
        'prestasi',
        'tahun',
    ];
}
