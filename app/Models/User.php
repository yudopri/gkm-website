<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's avatar URL.
     *
     * @param  string  $value
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->photo) {
            return Storage::url($this->photo);
        }

        $name = urlencode($this->name);
        return "https://ui-avatars.com/api/?name={$name}&background=random";
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    /* Kerjasama Tridharma */
    public function kerjasama_tridharma_pendidikan()
    {
        return $this->hasMany(KerjasamaTridharmaPendidikan::class, 'user_id');
    }

    public function kerjasama_tridharma_penelitian()
    {
        return $this->hasMany(KerjasamaTridharmaPenelitian::class, 'user_id');
    }

    public function kerjasama_tridharma_pengmas()
    {
        return $this->hasMany(KerjasamaTridharmaPengmas::class, 'user_id');
    }

    /* Data Mahasiswa */
    public function seleksi_maba()
    {
        return $this->hasMany(SeleksiMahasiswaBaru::class, 'user_id');
    }

    public function mahasiswa_asing()
    {
        return $this->hasMany(MahasiswaAsing::class, 'user_id');
    }

    /* Data Dosen */
    public function dosen_tetap()
    {
        return $this->hasMany(DosenTetapPT::class, 'user_id');
    }

    public function dosen_pembimbing_ta()
    {
        return $this->hasMany(DosenPembimbingTA::class, 'user_id');
    }

    public function ewmp_dosen()
    {
        return $this->hasMany(EwmpDosen::class, 'user_id');
    }
    public function rekognisi_dtps()
    {
        return $this->hasMany(RekognisiDosen::class, 'user_id');
    }
    public function penelitian_dtps()
    {
        return $this->hasMany(RekognisiDosen::class, 'user_id');
    }
    public function produk_teradopsi()
    {
        return $this->hasMany(RekognisiDosen::class, 'user_id');
    }
    public function pkm_dtps()
    {
        return $this->hasMany(PkmDtps::class, 'user_id');
    }
    public function hki_paten()
    {
        return $this->hasMany(PkmDtps::class, 'user_id');
    }
    public function hki_cipta()
    {
        return $this->hasMany(PkmDtps::class, 'user_id');
    }
    public function buku_chapter()
    {
        return $this->hasMany(PkmDtps::class, 'user_id');
    }
    public function teknologi_karya()
    {
        return $this->hasMany(PkmDtps::class, 'user_id');
    }
}
