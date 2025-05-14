<?php

namespace App\Http\Controllers\Api\RekapData;

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
            'Tabel 1.1 Kerjasama Tridharma - Pendidikan' => KerjasamaTridharmaPendidikan::class,
            'Tabel 1.2 Kerjasama Tridharma - Penelitian' => KerjasamaTridharmaPenelitian::class,
            'Tabel 1.3 Kerjasama Tridharma - Pengabdian kepada Masyarakat'    => KerjasamaTridharmaPengmas::class,
            'Tabel 2.a Seleksi Mahasiswa'         => SeleksiMahasiswaBaru::class,
            'Tabel 2.b Mahasiswa Asing		'                => MahasiswaAsing::class,
            'Tabel 3.a.1) Dosen Tetap Perguruan Tinggi'                 => DosenTetapPT::class,
            'Tabel 3.a.2) Dosen Pembimbing Utama Tugas Akhir'            => DosenPembimbingTA::class,
            'Tabel 3.a.3) Ekuivalen Waktu Mengajar Penuh (EWMP) Dosen Tetap Perguruan Tinggi'                     => EwmpDosen::class,
            'Tabel 3.a.4) Dosen Tidak Tetap'              => DosenTidakTetap::class,
            'Tabel 3.a.5) Dosen Industri/Praktisi'        => DosenIndustriPraktisi::class,
            'Tabel 3.b.1) Pengakuan/Rekognisi Dosen'                => RekognisiDosen::class,
            'Tabel 3.b.2) Penelitian DTPS'                => PenelitianDtps::class,
            'Tabel 3.b.3) PkM DTPS'                       => PkmDtps::class,
            'Tabel 3.b.4) Pagelaran/Pameran/Presentasi/Publikasi Ilmiah DTPS'        => PublikasiIlmiahDosen::class,
            'Tabel 3.b.5) Karya Ilmiah DTPS yang Disitasi'             => SitasiKaryaDosen::class,
            'Tabel 3.b.6) Produk/Jasa DTPS yang Diadopsi oleh Industri/Masyarakat'         => ProdukTeradopsiDosen::class,
            'Tabel 3.b.7) Luaran Penelitian/PkM Lainnya - HKI (Paten, Paten Sederhana)'                => HkiPatenDosen::class,
            'Tabel 3.b.8) Luaran Penelitian/PkM Lainnya - HKI (Hak Cipta, Desain Produk Industri, dll.)'             => HkiHakciptaDosen::class,
            'Tabel 3.b.9) Luaran Penelitian/PkM Lainnya - Teknologi Tepat Guna, Produk, Karya Seni, Rekayasa Sosial'          => TeknologiKaryaDosen::class,
            'Tabel 3.b.10) Luaran Penelitian/PkM Lainnya - Buku ber-ISBN, Book Chapter'             => BukuChapterDosen::class,
            'Tabel 5.a Kurikulum, Capaian Pembelajaran, dan Rencana Pembelajaran'         => KurikulumPembelajaran::class,
            'Tabel 5.b Integrasi Kegiatan Penelitian/PkM dalam Pembelajaran'           => IntegrasiPenelitian::class,
            'Tabel 5.c Kepuasan Mahasiswa'             => KepuasanMahasiswa::class,
            'Tabel 6.a Penelitian DTPS yang Melibatkan Mahasiswa'      => DtpsPenelitianMahasiswa::class,
            'Tabel 6.b Penelitian DTPS yang Menjadi Rujukan Tema Tesis/Disertasi'             => DtpsRujukanTesis::class,
            'Tabel 7 PkM DTPS yang Melibatkan Mahasiswa'             => PkmDtpsMahasiswa::class,
            'Tabel 8.a IPK Lulusan'                    => IpkLulusan::class,
            'Tabel 8.b.1) Prestasi Akademik Mahasiswa'          => PrestasiAkademikMhs::class,
            'Tabel 8.b.2) Prestasi Non-akademik Mahasiswa'       => PrestasiNonakademikMhs::class,
            'Tabel 8.c Masa Studi Lulusan'             => MasaStudiLulusan::class,
            'Tabel 8.d.1) Waktu Tunggu Lulusan'              => EvalWaktuTunggu::class,
            'Tabel 8.d.2) Kesesuaian Bidang Kerja Lulusan'          => EvalKesesuaianKerja::class,
            'Tabel 8.e.1) Tempat Kerja Lulusan'              => EvalTempatKerja::class,
            'Tabel 8.e.2) Kepuasan Pengguna Lulusan'         => EvalKepuasanPengguna::class,
            'Tabel 8.f.1) Pagelaran/Pameran/Presentasi/Publikasi Ilmiah Mahasiswa'            => PublikasiMahasiswa::class,
            'Tabel 8.f.2) Karya Ilmiah Mahasiswa yang Disitasi'         => SitasiKaryaMahasiswa::class,
            'Tabel 8.f.3) Produk/Jasa Mahasiswa yang Diadopsi oleh Industri/Masyarakat'          => ProdukJasaMahasiswa::class,
            'Tabel 8.f.4) Luaran Penelitian yang Dihasilkan Mahasiswa - HKI (Paten, Paten Sederhana)'            => HkiPatenMahasiswa::class,
            'Tabel 8.f.5) Luaran Penelitian yang Dihasilkan Mahasiswa - HKI (Hak Cipta, Desain Produk Industri, dll.)'         => HkiHakCiptaMahasiswa::class,
            'Tabel 8.f.6) Luaran Penelitian yang Dihasilkan Mahasiswa - Teknologi Tepat Guna, Produk, Karya Seni, Rekayasa Sosial'      => TeknologiKaryaMahasiswa::class,
            'Tabel 8.f.7) Luaran Penelitian yang Dihasilkan Mahasiswa - Buku ber-ISBN, Book Chapter'         => BukuChapterMahasiswa::class,
            'user_profile'                   => UserProfile::class,
        ];

        $minThresholds = [
            'Tabel 3.b.10) Luaran Penelitian/PkM Lainnya - Buku ber-ISBN, Book Chapter'             => 1,
            'Tabel 8.f.7) Luaran Penelitian yang Dihasilkan Mahasiswa - Buku ber-ISBN, Book Chapter'         => 1,
            'Tabel 3.a.5) Dosen Industri/Praktisi'        => 1,
            'Tabel 3.a.2) Dosen Pembimbing Utama Tugas Akhir'            => 1,
            'Tabel 3.a.1) Dosen Tetap Perguruan Tinggi'                 => 1,
            'Tabel 1.1 Kerjasama Tridharma - Pendidikan' => 1,
            'Tabel 1.2 Kerjasama Tridharma - Penelitian' => 1,
            'Tabel 1.3 Kerjasama Tridharma - Pengabdian kepada Masyarakat'    => 1,
            'Tabel 2.a Seleksi Mahasiswa' => 90,
            'Tabel 2.b Mahasiswa Asing' => 1,
            'Tabel 3.a.3) Ekuivalen Waktu Mengajar Penuh (EWMP) Dosen Tetap Perguruan Tinggi' => 12,
            'Tabel 3.a.5) Dosen Industri/Praktisi' => 1,
            'Tabel 3.b.1) Pengakuan/Rekognisi Dosen' => 1,
        ];

        $data = [];
        foreach ($models as $key => $modelClass) {
            $count = $modelClass::where('user_id', $userId)->count();
            $min   = $minThresholds[$key] ?? 0;
            $status = $count >= $min
                        ? 'memenuhi'
                        : ($count === 0 ? 'belum diisi' : 'kurang');
            $data[$key] = ['count' => $count, 'min' => $min, 'status' => $status];
        }

        // Tambahan rasio dan keterangan khusus
        $dosenTetap = $data['Tabel 3.a.1) Dosen Tetap Perguruan Tinggi']['count'] ?? 0;
        $tidakTetap = $data['Tabel 3.a.4) Dosen Tidak Tetap']['count'] ?? 0;
        if ($dosenTetap > 0) {
            // Rasio
            $data['dosen_tetap_pt_ratio'] = $this->ratio($dosenTetap, SeleksiMahasiswaBaru::sum('mhs_aktif_reguler'));
            // Cek 30%
            if (($tidakTetap / $dosenTetap) > 0.3) {
                $data['Tabel 3.a.4) Dosen Tidak Tetap']['keterangan'] =
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
