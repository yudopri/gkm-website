<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtpsRujukanTesis extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dtps_rujukan_tesis';
    protected $fiilable = [
        'user_id',
        'nama_dosen',
        'tema_penelitian',
        'nama_mahasiswa',
        'judul',
    ];
}
