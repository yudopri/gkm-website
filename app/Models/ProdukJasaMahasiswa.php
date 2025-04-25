<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukJasaMahasiswa extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'produk_jasa_mahasiswa';

    // Correct the typo here
    protected $fillable = [
        'user_id',
        'nama_mahasiswa',
        'nama_produk',
        'deskripsi_produk',
        'bukti',
        'tahun',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
