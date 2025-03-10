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
    protected $fiilable = [
        'user_id',
        'sumber_dana',
        'judul_penelitian',
        'tahun_penelitian',
    ];
}
