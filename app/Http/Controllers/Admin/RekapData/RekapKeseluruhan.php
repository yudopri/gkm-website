<?php

namespace App\Http\Controllers\Admin\RekapData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;

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
use App\Models\UserProfile;

class RekapKeseluruhan extends Controller
{
    public function index(Request $request)
    {
        // Ambil list tahun ajaran untuk dropdown
        $tahunAjaranList = TahunAjaranSemester::select('tahun_ajaran', 'semester', 'slug')
            ->orderByDesc('tahun_ajaran')
            ->orderByDesc('semester')
            ->get();

        // Ambil slug dari query string (?tahun_ajaran=)
        $slug = $request->input('tahun_ajaran');

        // Cari objek tahun ajaran berdasarkan slug, jika tidak ada pilih terbaru
        if ($slug) {
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $slug)->first();
            if (!$tahunAjaranObj) {
                abort(404, 'Tahun ajaran tidak ditemukan.');
            }
        } else {
            $tahunAjaranObj = TahunAjaranSemester::orderByDesc('tahun_ajaran')->orderByDesc('semester')->first();
        }

        $tahun_ajaran = $tahunAjaranObj ? $tahunAjaranObj->tahun_ajaran : null;
        $semester     = $tahunAjaranObj ? $tahunAjaranObj->semester : null;
        $selected_slug = $tahunAjaranObj ? $tahunAjaranObj->slug : null;

        // Kirim tahun_ajaran dan semester ke getRekap
        $rows = $this->getRekap($tahun_ajaran, $semester);

        return view('pages.admin.rekap-data.rekap-keseluruhan.index', [
            'tahun_ajaran'    => $tahun_ajaran,
            'semester'        => $semester,
            'tahunAjaranList' => $tahunAjaranList,
            'rows'            => $rows,
            'selected_slug'   => $selected_slug,
        ]);
    }

    public function getRekap($tahun = null, $semester = null): array
    {
        $models = [
            'Tabel 1.1 Kerjasama Tridharma - Pendidikan' => KerjasamaTridharmaPendidikan::class,
            'Tabel 1.2 Kerjasama Tridharma - Penelitian' => KerjasamaTridharmaPenelitian::class,
            'Tabel 1.3 Kerjasama Tridharma - Pengabdian kepada Masyarakat' => KerjasamaTridharmaPengmas::class,
            'Tabel 2.a Seleksi Mahasiswa' => SeleksiMahasiswaBaru::class,
            'Tabel 2.b Mahasiswa Asing' => MahasiswaAsing::class,
            'Tabel 3.a.1) Dosen Tetap Perguruan Tinggi' => DosenTetapPT::class,
            'Tabel 3.a.2) Dosen Pembimbing Utama Tugas Akhir' => DosenPembimbingTA::class,
            'Tabel 3.a.3) Ekuivalen Waktu Mengajar Penuh (EWMP) Dosen Tetap Perguruan Tinggi' => EwmpDosen::class,
            'Tabel 3.a.4) Dosen Tidak Tetap' => DosenTidakTetap::class,
            'Tabel 3.a.5) Dosen Industri/Praktisi' => DosenIndustriPraktisi::class,
            'Tabel 3.b.1) Pengakuan/Rekognisi Dosen' => RekognisiDosen::class,
            'Tabel 3.b.2) Penelitian DTPS' => PenelitianDtps::class,
            'Tabel 3.b.3) PkM DTPS' => PkmDtps::class,
            'Tabel 3.b.4) Pagelaran/Pameran/Publikasi Ilmiah DTPS' => PublikasiIlmiahDosen::class,
            'Tabel 3.b.5) Karya Ilmiah DTPS yang Disitasi' => SitasiKaryaDosen::class,
            'Tabel 3.b.6) Produk/Jasa DTPS yang Diadopsi' => ProdukTeradopsiDosen::class,
            'Tabel 3.b.7) Luaran HKI - Paten' => HkiPatenDosen::class,
            'Tabel 3.b.8) Luaran HKI - Hak Cipta' => HkiHakciptaDosen::class,
            'Tabel 3.b.9) Teknologi Tepat Guna DTPS' => TeknologiKaryaDosen::class,
            'Tabel 3.b.10) Buku/Book Chapter DTPS' => BukuChapterDosen::class,
            'Tabel 5.a Kurikulum & Rencana Pembelajaran' => KurikulumPembelajaran::class,
            'Tabel 5.b Integrasi Penelitian/PkM' => IntegrasiPenelitian::class,
            'Tabel 5.c Kepuasan Mahasiswa' => KepuasanMahasiswa::class,
            'Tabel 6.a Penelitian DTPS + Mahasiswa' => DtpsPenelitianMahasiswa::class,
            'Tabel 6.b Penelitian Rujukan Tesis' => DtpsRujukanTesis::class,
            'Tabel 7 PkM DTPS + Mahasiswa' => PkmDtpsMahasiswa::class,
            'Tabel 8.a IPK Lulusan' => IpkLulusan::class,
            'Tabel 8.b.1) Prestasi Akademik' => PrestasiAkademikMhs::class,
            'Tabel 8.b.2) Prestasi Non-akademik' => PrestasiNonakademikMhs::class,
            'Tabel 8.c Masa Studi Lulusan' => MasaStudiLulusan::class,
            'Tabel 8.d.1) Waktu Tunggu' => EvalWaktuTunggu::class,
            'Tabel 8.d.2) Kesesuaian Kerja' => EvalKesesuaianKerja::class,
            'Tabel 8.e.1) Tempat Kerja' => EvalTempatKerja::class,
            'Tabel 8.e.2) Kepuasan Pengguna' => EvalKepuasanPengguna::class,
            'Tabel 8.f.1) Publikasi Mahasiswa' => PublikasiMahasiswa::class,
            'Tabel 8.f.2) Sitasi Mahasiswa' => SitasiKaryaMahasiswa::class,
            'Tabel 8.f.3) Produk Mahasiswa' => ProdukJasaMahasiswa::class,
            'Tabel 8.f.4) HKI Mahasiswa - Paten' => HkiPatenMahasiswa::class,
            'Tabel 8.f.5) HKI Mahasiswa - Hak Cipta' => HkiHakCiptaMahasiswa::class,
            'Tabel 8.f.6) Teknologi Mahasiswa' => TeknologiKaryaMahasiswa::class,
            'Tabel 8.f.7) Buku Mahasiswa' => BukuChapterMahasiswa::class,
        ];

        $minThresholds = [
            'Tabel 3.a.5) Dosen Industri/Praktisi' => 1,
            'Tabel 3.a.2) Dosen Pembimbing Utama Tugas Akhir' => 1,
            'Tabel 3.a.1) Dosen Tetap Perguruan Tinggi' => 1,
            'Tabel 1.1 Kerjasama Tridharma - Pendidikan' => 1,
            'Tabel 1.2 Kerjasama Tridharma - Penelitian' => 1,
            'Tabel 1.3 Kerjasama Tridharma - Pengabdian kepada Masyarakat' => 1,
            'Tabel 2.a Seleksi Mahasiswa' => 90,
            'Tabel 2.b Mahasiswa Asing' => 1,
            'Tabel 3.a.3) Ekuivalen Waktu Mengajar Penuh (EWMP) Dosen Tetap Perguruan Tinggi' => 12,
            'Tabel 3.b.1) Pengakuan/Rekognisi Dosen' => 1,
        ];

        $customTahunColumns = [
            PenelitianDtps::class => 'tahun_penelitian',
        ];

        $usesTahunAjaranId = [
            DosenIndustriPraktisi::class,
            DosenPembimbingTA::class,
            DosenTetapPT::class,
            DosenTidakTetap::class,
            EwmpDosen::class,
            KerjasamaTridharmaPendidikan::class,
            KerjasamaTridharmaPenelitian::class,
            KerjasamaTridharmaPengmas::class,
            MahasiswaAsing::class,
            SeleksiMahasiswaBaru::class,
        ];

        $data = [];
        $dosenTetap = null;
        $tidakTetap = null;

        foreach ($models as $label => $modelClass) {
            $query = $modelClass::query();
            $query = $this->selectTahun($query, $tahun, $semester, $modelClass, $usesTahunAjaranId, $customTahunColumns);

            $count = $query->count();
            $min = $minThresholds[$label] ?? 1;
            $status = $count >= $min ? 'memenuhi' : ($count === 0 ? 'belum diisi' : 'kurang');
            $keterangan = $status;

            if ($label === 'Tabel 3.a.1) Dosen Tetap Perguruan Tinggi') {
                $dosenTetap = $count;
            }
            if ($label === 'Tabel 3.a.4) Dosen Tidak Tetap') {
                $tidakTetap = $count;
            }

            $data[] = [
                'label'      => $label,
                'count'      => $count,
                'min'        => $min,
                'status'     => $status,
                'keterangan' => $keterangan,
                'tipe'       => 'utama',
            ];
        }

        // Tambah baris khusus rasio jika perlu
        if ($dosenTetap > 0) {
            $rasio = $this->ratio($dosenTetap, SeleksiMahasiswaBaru::sum('mhs_aktif_reguler'));
            $data[] = [
                'label'      => 'Rasio Dosen Tetap PT : Mahasiswa Aktif Reguler',
                'count'      => $rasio,
                'min'        => '-',
                'status'     => '-',
                'keterangan' => '-',
                'tipe'       => 'rasio',
            ];

            if ($tidakTetap !== null && ($tidakTetap / $dosenTetap) > 0.3) {
                foreach ($data as &$row) {
                    if ($row['label'] === 'Tabel 3.a.4) Dosen Tidak Tetap') {
                        $row['keterangan'] = 'jumlah tidak tetap melebihi persentase';
                    }
                }
                unset($row);
            }
        }

        return $data;
    }

    private function selectTahun($query, $tahunInput, $semesterInput, $modelClass, $usesTahunAjaranId, $customTahunColumns)
    {
        if (!$tahunInput) return $query;

        if (in_array($modelClass, $usesTahunAjaranId)) {
            $semester = $semesterInput ?: 'ganjil';
            $ta = TahunAjaranSemester::where('tahun_ajaran', $tahunInput)
                ->whereRaw('LOWER(semester) = ?', [strtolower($semester)])
                ->first();

            return $ta ? $query->where('tahun_ajaran_id', $ta->id) : $query->whereRaw('0 = 1');
        }

        $column = $customTahunColumns[$modelClass] ?? null;
        if ($column) {
            return $query->where($column, $tahunInput);
        }
        return $query;
    }

    private function gcd(int $a, int $b): int
    {
        return $b === 0 ? $a : $this->gcd($b, $a % $b);
    }

    private function ratio(int $a, int $b): string
    {
        if ($b === 0) return 'n/a';
        $g = $this->gcd($a, $b);
        return ($a / $g) . ':' . ($b / $g);
    }
}