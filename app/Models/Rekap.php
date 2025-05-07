<?php

namespace App\Models;

/**
 * Data Transfer Object for Rekapitulasi Dosen.
 *
 * Digunakan sebagai model bukan Eloquent, hanya menyimpan data hasil rekap.
 */
class Rekap
{
    // Properti jumlah dan status
    public int $count;
    public int $min;
    public string $status;
    public ?string $keterangan;

    // Semua field rekap sebagai objek RekapItem
    public RekapItem $buku_chapter_dosen;
    public RekapItem $dosen_industri_praktisi;
    public RekapItem $dosen_pembimbing_ta;
    public RekapItem $dosen_tetap_pt;
    public RekapItem $dosen_tidak_tetap;
    public RekapItem $dtps_penelitian_mahasiswa;
    public RekapItem $dtps_rujukan_tesis;
    public RekapItem $eval_kepuasan_pengguna;
    public RekapItem $eval_kesesuaian_kerja;
    public RekapItem $eval_tempat_kerja;
    public RekapItem $eval_waktu_tunggu;
    public RekapItem $ewmp_dosen;
    public RekapItem $hki_hakcipta_dosen;
    public RekapItem $hki_paten_dosen;
    public RekapItem $integrasi_penelitian;
    public RekapItem $ipk_lulusan;
    public RekapItem $jabatan;
    public RekapItem $jabatan_fungsional;
    public RekapItem $jurusan;
    public RekapItem $kepuasan_mahasiswa;
    public RekapItem $kerjasama_tridharma_pendidikan;
    public RekapItem $kerjasama_tridharma_penelitian;
    public RekapItem $kerjasama_tridharma_pengabdian;
    public RekapItem $kurikulum_pembelajaran;
    public RekapItem $mahasiswa_asing;
    public RekapItem $masa_studi_lulusan;
    public RekapItem $penelitian_dtps;
    public RekapItem $pkm_dtps;
    public RekapItem $pkm_dtps_mahasiswa;
    public RekapItem $prestasi_akademik_mhs;
    public RekapItem $prestasi_nonakademik_mhs;
    public RekapItem $produk_teradopsi_dosen;
    public RekapItem $program_studi;
    public RekapItem $publikasi_ilmiah_dosen;
    public RekapItem $rekognisi_dosen;
    public RekapItem $seleksi_mahasiswa_baru;
    public RekapItem $sitasi_karya_dosen;
    public RekapItem $teknologi_karya_dosen;
    public RekapItem $user_profile;

    /**
     * Constructor menerima array data, setiap key harus RekapItem
     *
     * @param array<string, RekapItem> $items
     */
    public function __construct(array $items)
    {
        foreach ($items as $key => $item) {
            if (property_exists($this, $key) && $item instanceof RekapItem) {
                $this->{$key} = $item;
            }
        }
    }

    /**
     * Ubah model menjadi array untuk keperluan view atau JSON.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $result = [];
        foreach (get_object_vars($this) as $key => $value) {
            if ($value instanceof RekapItem) {
                $result[$key] = $value->toArray();
            }
        }
        return $result;
    }
}

/**
 * Class untuk menyimpan satu entri rekap.
 */
class RekapItem
{
    public int $count;
    public int $min;
    public string $status;
    public ?string $keterangan;

    public function __construct(int $count, int $min = 0, string $status = '', ?string $keterangan = null)
    {
        $this->count       = $count;
        $this->min         = $min;
        $this->status      = $status;
        $this->keterangan  = $keterangan;
    }

    public function toArray(): array
    {
        return [
            'count'      => $this->count,
            'min'        => $this->min,
            'status'     => $this->status,
            'keterangan' => $this->keterangan,
        ];
    }
}
