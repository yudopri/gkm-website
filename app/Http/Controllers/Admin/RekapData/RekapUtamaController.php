<?php

namespace App\Http\Controllers\Admin\RekapData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import semua model untuk rekap
use App\Models\BukuChapterDosen;
use App\Models\BukuChapterMahasiswa;
use App\Models\DosenIndustriPraktisi;
use App\Models\DosenPembimbingTA;
use App\Models\DosenTetapPT;
use App\Models\DosenTidakTetap;
use App\Models\DtpsPenelitianMahasiswa;
use App\Models\DtpsRujukanTesis;
use App\Models\EvalKepuasanPengguna;
use App\Models\EvalKesesuaianKerja;
use App\Models\EvalTempatKerja;
use App\Models\EvalWaktuTunggu;
use App\Models\EwmpDosen;
use App\Models\HkiHakciptaDosen;
use App\Models\HkiHakCiptaMahasiswa;
use App\Models\HkiPatenDosen;
use App\Models\HkiPatenMahasiswa;
use App\Models\IntegrasiPenelitian;
use App\Models\IpkLulusan;
use App\Models\Jabatan;
use App\Models\JabatanFungsional;
use App\Models\Jurusan;
use App\Models\KepuasanMahasiswa;
use App\Models\KerjasamaTridharmaPendidikan;
use App\Models\KerjasamaTridharmaPenelitian;
use App\Models\KerjasamaTridharmaPengmas;
use App\Models\KurikulumPembelajaran;
use App\Models\MahasiswaAsing;
use App\Models\MasaStudiLulusan;
use App\Models\PenelitianDtps;
use App\Models\PkmDtps;
use App\Models\PkmDtpsMahasiswa;
use App\Models\PrestasiAkademikMhs;
use App\Models\PrestasiNonakademikMhs;
use App\Models\ProdukJasaMahasiswa;
use App\Models\ProdukTeradopsiDosen;
use App\Models\PublikasiIlmiahDosen;
use App\Models\PublikasiMahasiswa;
use App\Models\RekognisiDosen;
use App\Models\SeleksiMahasiswaBaru;
use App\Models\SitasiKaryaDosen;
use App\Models\SitasiKaryaMahasiswa;
use App\Models\TeknologiKaryaDosen;
use App\Models\TeknologiKaryaMahasiswa;
use App\Models\User;
use App\Models\UserProfile;

class RekapUtamaController extends Controller
{
    /**
     * Mengembalikan array rekap data:
     * key => [count, min, status, (optional) keterangan]
     *
     * @param int $userId
     * @return array<string, array>
     */
    public function getRekap(int $userId): array
    {
        // Pastikan user ada
        if (! User::find($userId)) {
            return [];
        }

        // Daftar model dan threshold minimal
        $models = [
            'buku_chapter_dosen'             => BukuChapterDosen::class,
            'buku_chapter_mahasiswa'         => BukuChapterMahasiswa::class,
            'dosen_industri_praktisi'        => DosenIndustriPraktisi::class,
            'dosen_pembimbing_ta'            => DosenPembimbingTA::class,
            'dosen_tetap_pt'                 => DosenTetapPT::class,
            'dosen_tidak_tetap'              => DosenTidakTetap::class,
            'dtps_penelitian_mahasiswa'      => DtpsPenelitianMahasiswa::class,
            'dtps_rujukan_tesis'             => DtpsRujukanTesis::class,
            'eval_kepuasan_pengguna'         => EvalKepuasanPengguna::class,
            'eval_kesesuaian_kerja'          => EvalKesesuaianKerja::class,
            'eval_tempat_kerja'              => EvalTempatKerja::class,
            'eval_waktu_tunggu'              => EvalWaktuTunggu::class,
            'ewmp_dosen'                     => EwmpDosen::class,
            'hki_hakcipta_dosen'             => HkiHakciptaDosen::class,
            'hki_hakcipta_mahasiswa'         => HkiHakCiptaMahasiswa::class,
            'hki_paten_dosen'                => HkiPatenDosen::class,
            'hki_paten_mahasiswa'            => HkiPatenMahasiswa::class,
            'integrasi_penelitian'           => IntegrasiPenelitian::class,
            'ipk_lulusan'                    => IpkLulusan::class,
            'kepuasan_mahasiswa'             => KepuasanMahasiswa::class,
            'kerjasama_tridharma_pendidikan' => KerjasamaTridharmaPendidikan::class,
            'kerjasama_tridharma_penelitian' => KerjasamaTridharmaPenelitian::class,
            'kerjasama_tridharma_pengmas'    => KerjasamaTridharmaPengmas::class,
            'kurikulum_pembelajaran'         => KurikulumPembelajaran::class,
            'mahasiswa_asing'                => MahasiswaAsing::class,
            'masa_studi_lulusan'             => MasaStudiLulusan::class,
            'penelitian_dtps'                => PenelitianDtps::class,
            'pkm_dtps'                       => PkmDtps::class,
            'pkm_dtps_mahasiswa'             => PkmDtpsMahasiswa::class,
            'prestasi_akademik_mhs'          => PrestasiAkademikMhs::class,
            'prestasi_nonakademik_mhs'       => PrestasiNonakademikMhs::class,
            'produk_jasa_mahasiswa'          => ProdukJasaMahasiswa::class,
            'produk_teradopsi_dosen'         => ProdukTeradopsiDosen::class,
            'publikasi_ilmiah_dosen'        => PublikasiIlmiahDosen::class,
            'publikasi_mahasiswa'            => PublikasiMahasiswa::class,
            'rekognisi_dosen'                => RekognisiDosen::class,
            'seleksi_mahasiswa_baru'         => SeleksiMahasiswaBaru::class,
            'sitasi_karya_dosen'             => SitasiKaryaDosen::class,
            'sitasi_karya_mahasiswa'         => SitasiKaryaMahasiswa::class,
            'teknologi_karya_dosen'          => TeknologiKaryaDosen::class,
            'teknologi_karya_mahasiswa'      => TeknologiKaryaMahasiswa::class,
            'user_profile'                   => UserProfile::class,
        ];

        $minThresholds = [
            'buku_chapter_dosen'             => 1,
            'buku_chapter_mahasiswa'         => 1,
            'dosen_industri_praktisi'        => 1,
            'dosen_pembimbing_ta'            => 1,
            'dosen_tetap_pt'                 => 1,
            'kerjasama_tridharma_pendidikan' => 1,
            'kerjasama_tridharma_penelitian' => 1,
            'kerjasama_tridharma_pengamas'    => 1,
            'seleksi_mahasiswa_baru' => 90,
            'mahasiswa_asing' => 1,
            'ewmp_dosen' => 12,
            'dosen_industri_praktisi' => 1,
            'rekognisi_dosen' => 1,
        ];

        $data = [];
        foreach ($models as $key => $modelClass) {
            $count = $modelClass::where('user_id', $userId)->count();
            $min   = $minThresholds[$key] ?? 1;
            $status = $count >= $min
                        ? 'memenuhi'
                        : ($count === 0 ? 'belum diisi' : 'kurang');
            $data[$key] = ['count' => $count, 'min' => $min, 'status' => $status];
        }

        // Tambahan rasio dan keterangan khusus
        $dosenTetap = $data['dosen_tetap_pt']['count'] ?? 0;
        $tidakTetap = $data['dosen_tidak_tetap']['count'] ?? 0;
        if ($dosenTetap > 0) {
            // Rasio
            $data['dosen_tetap_pt_ratio'] = $this->ratio($dosenTetap, SeleksiMahasiswaBaru::sum('mhs_aktif_reguler'));
            // Cek 30%
            if (($tidakTetap / $dosenTetap) > 0.3) {
                $data['dosen_tidak_tetap']['keterangan'] =
                    'jumlah tidak tetap melebihi persentase';
            }
        }

        return $data;
    }

    /**
     * API endpoint untuk rekap data
     */
    public function index(Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        $userId = $request->input('user_id');
        $rekap  = $this->getRekap($userId);

        return response()->json([
            'status'  => 'success',
            'message' => 'Rekap data',
            'data'    => $rekap,
        ]);
    }

    /**
     * Hitung GCD untuk rasio
     */
    private function gcd(int $a, int $b): int
    {
        return $b === 0 ? $a : $this->gcd($b, $a % $b);
    }

    /**
     * Buat string rasio a:b
     */
    private function ratio(int $a, int $b): string
    {
        if ($b === 0) {
            return 'n/a';
        }
        $g = $this->gcd($a, $b);
        return ($a / $g) . ':' . ($b / $g);
    }
}
