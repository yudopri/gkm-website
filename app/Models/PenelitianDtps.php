<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenelitianDtps extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penelitian_dtps';

    protected $fillable = [
        'user_id',
        'sumber_dana',
        'jumlah_judul',
        'tahun_penelitian',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

