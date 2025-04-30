<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalKesesuaianKerja extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'eval_kesesuaian_kerja';
    protected $fillable = [
        'user_id',
        'tahun',
        'jumlah_lulusan',
        'jumlah_lulusan_terlacak',
        'jumlah_lulusan_bekerja',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
