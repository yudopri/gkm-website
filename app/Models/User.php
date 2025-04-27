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

    public function dosen_tidak_tetap()
    {
        return $this->hasMany(DosenTidakTetap::class, 'user_id');
    }
    public function dosen_pembimbing_ta()
    {
        return $this->hasMany(DosenPembimbingTA::class, 'user_id');
    }

    public function ewmp_dosen()
    {
        return $this->hasMany(EwmpDosen::class, 'user_id');
    }
    public function dosen_praktisi()
    {
        return $this->hasMany(DosenIndustriPraktisi::class, 'user_id');
    }

    public function rekognisi_dtps()
    {
        return $this->hasMany(RekognisiDosen::class, 'user_id');
    }
    public function pkm_dtps()
    {
        return $this->hasMany(PkmDtps::class, 'user_id');
    }
    public function penelitian_dtps()
    {
        return $this->hasMany(PenelitianDtps::class, 'user_id');
    }
    public function publikasi_ilmiah()
    {
        return $this->hasMany(PublikasiIlmiahDosen::class, 'user_id');
    }
    public function sitasi_karya_dosen()
    {
        return $this->hasMany(SitasiKaryaDosen::class, 'user_id');
    }
    public function produk_teradopsi()
    {
        return $this->hasMany(ProdukTeradopsiDosen::class, 'user_id');
    }
    public function hki_paten_dosen()
    {
        return $this->hasMany(HkiPatenDosen::class, 'user_id');
    }
    public function hki_cipta_dosen()
    {
        return $this->hasMany(HkiHakciptaDosen::class, 'user_id');
    }
    public function buku_chapter_dosen()
    {
        return $this->hasMany(BukuChapterDosen::class, 'user_id');
    }
    public function teknologi_karya_dosen()
    {
        return $this->hasMany(TeknologiKaryaDosen::class, 'user_id');
    }
    public function ipk_lulusan()
    {
        return $this->hasMany(IpkLulusan::class, 'user_id');
    }
    public function masa_studi_lulusan()
    {
        return $this->hasMany(MasaStudiLulusan::class, 'user_id');
    }
    public function eval_kepuasan_pengguna()
    {
        return $this->hasMany(EvalKepuasanPengguna::class, 'user_id');
    }
    public function eval_kesesuaian_kerja()
    {
        return $this->hasMany(EvalKesesuaianKerja::class, 'user_id');
    }
    public function eval_tempat_kerja()
    {
        return $this->hasMany(EvalTempatKerja::class, 'user_id');
    }
    public function eval_waktu_tunggu()
    {
        return $this->hasMany(EvalWaktuTunggu::class, 'user_id');
    }
    public function prestasi_akademik()
    {
        return $this->hasMany(PrestasiAkademikMhs::class, 'user_id');
    }
    public function prestasi_nonakademik()
    {
        return $this->hasMany(PrestasiNonakademikMhs::class, 'user_id');
    }
    public function integrasi_penelitian()
    {
        return $this->hasMany(IntegrasiPenelitian::class, 'user_id');
    }
    public function kepuasan_mahasiswa()
    {
        return $this->hasMany(KepuasanMahasiswa::class, 'user_id');
    }
    public function kurikulum_pembelajaran()
    {
        return $this->hasMany(KurikulumPembelajaran::class, 'user_id');
    }
    public function penelitian_mahasiswa()
    {
        return $this->hasMany(DtpsPenelitianMahasiswa::class, 'user_id');
    }
    public function rujukan_tesis_mahasiswa()
    {
        return $this->hasMany(DtpsRujukanTesis::class, 'user_id');
    }
    public function pkm_dtps_mahasiswa()
    {
        return $this->hasMany(PkmDtpsMahasiswa::class, 'user_id');
    }
    public function publikasi_mahasiswa()
    {
        return $this->hasMany(PublikasiMahasiswa::class, 'user_id');
    }
    public function sitasi_karya_mahasiswa()
    {
        return $this->hasMany(SitasiKaryaDosen::class, 'user_id');
    }
    public function produk_jasa_mahasiswa()
    {
        return $this->hasMany(ProdukJasaMahasiswa::class, 'user_id');
    }
    public function hki_paten_mahasiswa()
    {
        return $this->hasMany(HkiPatenMahasiswa::class, 'user_id');
    }
    public function hki_cipta_mahasiswa()
    {
        return $this->hasMany(HkiHakCiptaMahasiswa::class, 'user_id');
    }
    public function buku_chapter_mahasiswa()
    {
        return $this->hasMany(BukuChapterMahasiswa::class, 'user_id');
    }
    public function teknologi_karya_mahasiswa()
    {
        return $this->hasMany(TeknologiKaryaMahasiswa::class, 'user_id');
    }
}
