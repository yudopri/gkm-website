<?php

namespace App\Models;

class Rekap
{
    public $buku_chapter_dosen;
    public $dosen_industri_praktisi;
    public $dosen_pembimbing_ta;
    public $dosen_tetap_pt;
    public $dosen_tidak_tetap;
    public $dtps_penelitian_mahasiswa;
    public $dtps_rujukan_tesis;
    public $eval_kepuasan_pengguna;
    public $eval_kesesuaian_kerja;
    public $eval_tempat_kerja;
    public $eval_waktu_tunggu;
    public $ewmp_dosen;
    public $hki_hakcipta_dosen;
    public $hki_paten_dosen;
    public $integrasi_penelitian;
    public $ipk_lulusan;
    public $jabatan;
    public $jabatan_fungsional;
    public $jurusan;
    public $kepuasan_mahasiswa;
    public $kerjasama_tridharma_pendidikan;
    public $kerjasama_tridharma_penelitian;
    public $kerjasama_tridharma_pengmas;
    public $kurikulum_pembelajaran;
    public $mahasiswa_asing;
    public $masa_studi_lulusan;
    public $penelitian_dtps;
    public $pkm_dtps;
    public $pkm_dtps_mahasiswa;
    public $prestasi_akademik_mhs;
    public $prestasi_nonakademik_mhs;
    public $produk_teradopsi_dosen;
    public $program_studi;
    public $publikasi_ilmiah_dosen;
    public $rekognisi_dosen;
    public $seleksi_mahasiswa_baru;
    public $sitasi_karya_dosen;
    public $tahun_ajaran_semester;
    public $teknologi_karya_dosen;
    public $user;
    public $user_profile;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
