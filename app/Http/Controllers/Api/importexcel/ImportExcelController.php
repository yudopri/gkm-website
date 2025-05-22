<?php

namespace App\Http\Controllers\Api\importexcel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- Tambahkan ini
use PhpOffice\PhpSpreadsheet\IOFactory; // buat baca Excel (kalau kamu pakai PhpSpreadsheet)
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SeleksiMahasiswaBaru;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ImportExcelController extends Controller
{
    public function importExcel(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv',
    ]);
 $namaDosen = $request->input('nama_dosen');

$user = \App\Models\User::whereHas('profile', function($query) use ($namaDosen) {
    $query->where('nama', $namaDosen);
})->first();

if (!$user) {
    return back()->withErrors(['error' => "User dengan nama dosen '$namaDosen' tidak ditemukan."]);
}

$userId = $user->id;

   
     \App\Models\KerjasamaTridharmaPendidikan::where('user_id', $userId)->delete();
    \App\Models\KerjasamaTridharmaPenelitian::where('user_id', $userId)->delete();
    \App\Models\KerjasamaTridharmaPengmas::where('user_id', $userId)->delete();
    \App\Models\SeleksiMahasiswaBaru::where('user_id', $userId)->delete();
    \App\Models\MahasiswaAsing::where('user_id', $userId)->delete();
    \App\Models\DosenTetapPT::where('user_id', $userId)->delete();
    \App\Models\DosenTidakTetap::where('user_id', $userId)->delete();
    \App\Models\DosenPembimbingTA::where('user_id', $userId)->delete();
    \App\Models\EwmpDosen::where('user_id', $userId)->delete();
    \App\Models\DosenIndustriPraktisi::where('user_id', $userId)->delete();
    \App\Models\RekognisiDosen::where('user_id', $userId)->delete();
    \App\Models\PenelitianDtps::where('user_id', $userId)->delete();
    \App\Models\PkmDtps::where('user_id', $userId)->delete();
    \App\Models\ProdukTeradopsiDosen::where('user_id', $userId)->delete();
    \App\Models\PublikasiIlmiahDosen::where('user_id', $userId)->delete();
    \App\Models\SitasiKaryaDosen::where('user_id', $userId)->delete();
    \App\Models\HkiPatenDosen::where('user_id', $userId)->delete();
    \App\Models\HkiHakciptaDosen::where('user_id', $userId)->delete();
    \App\Models\TeknologiKaryaDosen::where('user_id', $userId)->delete();
    \App\Models\BukuChapterDosen::where('user_id', $userId)->delete();
    \App\Models\IpkLulusan::where('user_id', $userId)->delete();
    \App\Models\MasaStudiLulusan::where('user_id', $userId)->delete();
    \App\Models\PrestasiAkademikMhs::where('user_id', $userId)->delete();
    \App\Models\PrestasiNonakademikMhs::where('user_id', $userId)->delete();
    \App\Models\EvalKepuasanPengguna::where('user_id', $userId)->delete();
    \App\Models\EvalKesesuaianKerja::where('user_id', $userId)->delete();
    \App\Models\EvalTempatKerja::where('user_id', $userId)->delete();
    \App\Models\EvalWaktuTunggu::where('user_id', $userId)->delete();
    \App\Models\IntegrasiPenelitian::where('user_id', $userId)->delete();
    \App\Models\KepuasanMahasiswa::where('user_id', $userId)->delete();
    \App\Models\KurikulumPembelajaran::where('user_id', $userId)->delete();
    \App\Models\DtpsPenelitianMahasiswa::where('user_id', $userId)->delete();
    \App\Models\DtpsRujukanTesis::where('user_id', $userId)->delete();
    \App\Models\PkmDtpsMahasiswa::where('user_id', $userId)->delete();
    \App\Models\ProdukJasaMahasiswa::where('user_id', $userId)->delete();
    \App\Models\PublikasiMahasiswa::where('user_id', $userId)->delete();
    \App\Models\ProdukJasaMahasiswa::where('user_id', $userId)->delete();
    \App\Models\SitasiKaryaMahasiswa::where('user_id', $userId)->delete();
    \App\Models\HkiPatenMahasiswa::where('user_id', $userId)->delete();
    \App\Models\HkiHakCiptaMahasiswa::where('user_id', $userId)->delete();
    \App\Models\TeknologiKaryaMahasiswa::where('user_id', $userId)->delete();
    \App\Models\BukuChapterMahasiswa::where('user_id', $userId)->delete();
    
  $filePath = $request->file('file')->store('temp');
$fullPath = Storage::path($filePath);
$spreadsheet = IOFactory::load($fullPath);
    foreach ($spreadsheet->getSheetNames() as $sheetIndex => $sheetName) {
        $sheet = $spreadsheet->getSheet($sheetIndex);
       // Ambil seluruh data dari sheet
$data = $sheet->toArray(null, true, true, true);

if (empty($data)) continue; // Lewati sheet kosong

$startIndex = null;
$maxHeaderColumns = 0;

foreach ($data as $index => $row) {
    // Ambil kolom tidak kosong
    $nonEmptyKeys = array_keys(array_filter($row, fn($val) => trim((string) $val) !== ''));

    // Hitung kolom teks
    $textColumnCount = 0;
    foreach ($nonEmptyKeys as $key) {
        if (!is_numeric($row[$key])) {
            $textColumnCount++;
        }
    }

    if ($textColumnCount > 0) {
        // Ambil nilai kolom yang tidak kosong
        $headerCandidate = array_values(array_filter($row, fn($val) => trim((string) $val) !== ''));
        
        // Pastikan semua kolom bukan angka
        $allText = true;
        foreach ($headerCandidate as $val) {
            if (is_numeric($val)) {
                $allText = false;
                break;
            }
        }

        // Validasi: minimal 2 kolom teks dan jumlah kolomnya lebih dari sebelumnya (opsional)
        if ($allText && count($headerCandidate) > $maxHeaderColumns && count($headerCandidate) >= 2) {
            $startIndex = $index;
            $maxHeaderColumns = count($headerCandidate); // update supaya ambil baris header "terlengkap"
        }
    }
}




if (is_null($startIndex)) continue; // tidak ada header valid

// Ambil header (key = nama kolom), trim semua kolom
$headers = array_map('trim', $data[$startIndex]);

// Ambil baris setelah header
$dataRows = array_slice($data, $startIndex);

// Loop setiap baris data
foreach ($dataRows as $rowIndex => $row) {
    // Trim semua nilai
    $trimmedRow = array_map('trim', $row);

    // Pastikan jumlah kolom sesuai header
    $rowCount = count($trimmedRow);
    $headerCount = count($headers);

    if ($rowCount < $headerCount) {
        $trimmedRow = array_pad($trimmedRow, $headerCount, null);
    } elseif ($rowCount > $headerCount) {
        $trimmedRow = array_slice($trimmedRow, 0, $headerCount);
    }

    $rowData = array_combine($headers, $trimmedRow);

    // Lewati baris kosong
    if (collect($rowData)->filter(fn($val) => trim((string) $val) !== '')->isEmpty()) continue;


        try {
            switch (trim($sheetName)) {
                case 'Kerjasama Pendidikan':
                    $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;

                    \App\Models\KerjasamaTridharmaPendidikan::create(
                        [
                            'judul_kegiatan' => $rowData['Judul Kerjasama'] ?? '-',
                            'lembaga_mitra' => $rowData['Lembaga Mitra'] ?? '-',
                            'tahun_ajaran_id' => $tahunAjaranId,
                            'tingkat' => $rowData['Tingkat'] ?? '-',
                            'tahun_berakhir' => $rowData['Tahun Berakhir Kerjasama'] ?? '-',
                            'manfaat' => $rowData['Manfaat Bagi Ps'] ?? '-',
                            'waktu_durasi' => $rowData['Waktu Durasi'] ?? '-',
                            'bukti' => $rowData['Bukti Kerjasama'] ?? '-',
                            'user_id' => $userId,
                        ]
                    );
                    break;

                case 'Kerjasama Penelitian':
                    $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;

                    \App\Models\KerjasamaTridharmaPenelitian::create(
                        [
                            'judul_kegiatan' => $rowData['Judul Kerjasama'] ?? '-',
                            'lembaga_mitra' => $rowData['Lembaga Mitra'] ?? '-',
                            'tahun_ajaran_id' => $tahunAjaranId,
                            'tingkat' => $rowData['Tingkat'] ?? '-',
                            'tahun_berakhir' => $rowData['Tahun Berakhir Kerjasama'] ?? '-',
                            'manfaat' => $rowData['Manfaat Bagi Ps'] ?? '-',
                            'waktu_durasi' => $rowData['Waktu Durasi'] ?? '-',
                            'bukti' => $rowData['Bukti Kerjasama'] ?? '-',
                            'user_id' => $userId,
                        ]
                    );
                    break;

                case 'Kerjasama Pengabdian Masyarakat':
                    $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;

                    \App\Models\KerjasamaTridharmaPengmas::create(
                        [
                            'judul_kegiatan' => $rowData['Judul Kerjasama'] ?? '-',
                            'lembaga_mitra' => $rowData['Lembaga Mitra'] ?? '-',
                            'tahun_ajaran_id' => $tahunAjaranId,
                            'tingkat' => $rowData['Tingkat'] ?? '-',
                            'tahun_berakhir' => $rowData['Tahun Berakhir Kerjasama'] ?? '-',
                            'manfaat' => $rowData['Manfaat Bagi Ps'] ?? '-',
                            'waktu_durasi' => $rowData['Waktu Durasi'] ?? '-',
                            'bukti' => $rowData['Bukti Kerjasama'] ?? '-',
                            'user_id' => $userId,
                        ]
                    );
                    break;

                case 'Seleksi Mahasiswa Baru':
                    $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;

                    \App\Models\SeleksiMahasiswaBaru::create(
                       [
            'tahun_akademik' => $rowData['Tahun Akademik'] ?? '-',
            'daya_tampung' => ($rowData['Daya Tampung'] ?? '-') === '-' ? 0 : (int) $rowData['Daya Tampung'],
            'pendaftar' => ($rowData['Jumlah Calon Mahasiswa - Pendaftar'] ?? '-') === '-' ? 0 : (int) $rowData['Jumlah Calon Mahasiswa - Pendaftar'],
            'lulus_seleksi' => ($rowData['Jumlah Calon Mahasiswa - Lulus Seleksi'] ?? '-') === '-' ? 0 : (int) $rowData['Jumlah Calon Mahasiswa - Lulus Seleksi'],
            'maba_reguler' => ($rowData['Jumlah Mahasiswa Baru - Reguler'] ?? '-') === '-' ? 0 : (int) $rowData['Jumlah Mahasiswa Baru - Reguler'],
            'maba_transfer' => ($rowData['Jumlah Mahasiswa Baru - Trfansfer'] ?? '-') === '-' ? 0 : (int) $rowData['Jumlah Mahasiswa Baru - Trfansfer'],
            'mhs_aktif_reguler' => ($rowData['Jumlah Mahasiswa Aktif - Reguler'] ?? '-') === '-' ? 0 : (int) $rowData['Jumlah Mahasiswa Aktif - Reguler'],
            'mhs_aktif_transfer' => ($rowData['Jumlah Mahasiswa Aktif - Trfansfer'] ?? '-') === '-' ? 0 : (int) $rowData['Jumlah Mahasiswa Aktif - Trfansfer'],
            'user_id' => $userId,
                            'tahun_ajaran_id' => $tahunAjaranId,
        ]
                    );
                    break;

                case 'Mahasiswa Asing':
                    $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;

                    \App\Models\MahasiswaAsing::create(
                        [
                            'tahun_akademik' => $rowData['Tahun Akademik'] ?? '-',
                            'mhs_aktif' => $rowData['Jumlah Mahasiswa Aktif'] ?? '0',
                            'mhs_asing_fulltime' => $rowData['Jumlah Mahasiswa Asing Penuh Waktu'] ?? '0',
                            'mhs_asing_parttime' => $rowData['Jumlah Mahasiswa Asing Paruh Waktu'] ?? '0',
                            'tahun_ajaran_id' => $tahunAjaranId,
                            'user_id' => $userId,
                        ]
                    );
                    break;
                    case 'Dosen Tetap':
                        $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;
                        $kesesuaianKompetensi = !empty(trim($rowData['Kesesuaian dengan Kompetensi Inti PS'] ?? '')) ? 1 : 0;;
$kesesuaianKeahlian = !empty(trim($rowData['Kesesuaian Bidang Keahlian dengan Mata Kuliah yang Diampu'] ?? '')) ? 1 : 0;;

                        \App\Models\DosenTetapPT::create(
                            [
                                'nama_dosen' => $rowData['Nama Dosen'] ?? '-',
                                'nidn_nidk' => $rowData['NIDN/NIDK'] ?? '-',
                                'gelar_magister' => $rowData['Pendidikan Pasca Sarjana - Magister/ Magister Terapan/ Spesialis'] ?? '-',
                                'gelar_doktor' => $rowData['Pendidikan Pasca Sarjana - Doktor/ Doktor Terapan/ Spesialis'] ?? '-',
                                'bidang_keahlian' => $rowData['Bidang Keahlian'] ?? '-',
                                'kesesuaian_kompetensi' => $kesesuaianKompetensi ?? '-',
                                'jabatan_akademik' => $rowData['Jabatan Akademik'] ?? '-',
                                'sertifikat_pendidik' => $rowData['Sertifikat Pendidik Profesional'] ?? '-',
                                'sertifikat_kompetensi' => $rowData['Sertifikat Kompetensi/ Profesi/ Industri'] ?? '-',
                                'mk_diampu' => $rowData['Mata Kuliah yang Diampu pada PS'] ?? '-',
                                'kesesuaian_keahlian_mk' => $kesesuaianKeahlian ?? '-',
                                'mk_ps_lain' => $rowData['Mata Kuliah yang Diampu pada PS Lain'] ?? '-',
                                'tahun_ajaran_id' => $tahunAjaranId,
                                'user_id' => $userId,
                            ]
                        );
                        break;
                        case 'Dosen Tidak Tetap':
                            $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;
                            $kesesuaianKompetensi = 0;
$kesesuaianKeahlian = 0;

if (($rowData['Kesesuaian dengan Kompetensi Inti PS'] ?? '') === '✓') {
    $kesesuaianKompetensi = 1;
}

if (($rowData['Kesesuaian Bidang Keahlian dengan Mata Kuliah yang Diampu'] ?? '') === '✓') {
    $kesesuaianKeahlian = 1;
}

                            \App\Models\DosenTidakTetap::create(
                                [
                                    'nama_dosen' => $rowData['Nama Dosen'] ?? '-',
                                    'nidn_nidk' => $rowData['NIDN/NIDK'] ?? '-',
                                    'pendidikan_pascasarjana' => $rowData['Pendidikan Pasca Sarjana'] ?? '-',
                                    'bidang_keahlian' => $rowData['Bidang Keahlian'] ?? '-',
                                    'kesesuaian_kompetensi' => $kesesuaianKompetensi ?? '-',
                                    'jabatan_akademik' => $rowData['Jabatan Akademik'] ?? '-',
                                    'sertifikat_pendidik' => $rowData['Sertifikat Pendidik Profesional'] ?? '-',
                                    'sertifikat_kompetensi' => $rowData['Sertifikat Kompetensi/ Profesi/ Industri'] ?? '-',
                                    'mk_diampu' => $rowData['Mata Kuliah yang Diampu pada PS'] ?? '-',
                                    'kesesuaian_keahlian_mk' => $kesesuaianKeahlian ?? '-',
                                    'mk_ps_lain' => $rowData['Mata Kuliah yang Diampu pada PS Lain'] ?? '-',
                                    'tahun_ajaran_id' => $tahunAjaranId,
                                    'user_id' => $userId,
                                ]
                            );
                            break;
                            case 'Dosen Pembimbing TA':
                                $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;

                                \App\Models\DosenPembimbingTA::create(
                                    [
                                        'nama_dosen' => $rowData['Nama Dosen'] ?? '-',
                                        'mhs_bimbingan_ps' => $rowData['Jumlah Mahasiswa yang Dibimbing - Pada PS'] ?? '-',
                                        'mhs_bimbingan_ps_lain' => $rowData['Jumlah Mahasiswa yang Dibimbing - Pada PS Lain'] ?? '-',
                                        'tahun_ajaran_id' => $tahunAjaranId,
                                        'user_id' => $userId,
                                        'tahun_ajaran_id' => $tahunAjaranId,
                                    ]
                                );
                                break;
                                case 'Dosen EWMP Dosen':
                                    $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;
                                    $lsDtps = 0;
if (isset($rowData['DTPS']) && $rowData['DTPS'] === '✓') {
    $isDtps = 1;
} else {
    $isDtps = 0;
}

                                    \App\Models\EwmpDosen::create(
                                        [
                                            'nama_dosen' => $rowData['Nama Dosen'] ?? '-',
    'is_dtps' => $isDtps ?? '0',
    'ps_diakreditasi' => is_numeric($rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Pendidikan: Pembelajaran dan Pembimbingan - PS yang Diakreditasi'] ?? null)
        ? $rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Pendidikan: Pembelajaran dan Pembimbingan - PS yang Diakreditasi']
        : 0,
    'ps_lain_dalam_pt' => is_numeric($rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Pendidikan: Pembelajaran dan Pembimbingan - PS Lain di dalam PT'] ?? null)
        ? $rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Pendidikan: Pembelajaran dan Pembimbingan - PS Lain di dalam PT']
        : 0,
    'ps_lain_luar_pt' => is_numeric($rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Pendidikan: Pembelajaran dan Pembimbingan - PS Lain di luar PT'] ?? null)
        ? $rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Pendidikan: Pembelajaran dan Pembimbingan - PS Lain di luar PT']
        : 0,
    'penelitian' => is_numeric($rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Penelitian'] ?? null)
        ? $rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Penelitian']
        : 0,
    'pkm' => is_numeric($rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - PkM'] ?? null)
        ? $rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - PkM']
        : 0,
    'tugas_tambahan' => is_numeric($rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Tugas Tambahan dan/atau Penunjang'] ?? null)
        ? $rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Tugas Tambahan dan/atau Penunjang']
        : 0,
    'avg_per_semester' => is_numeric($rowData['Rata-rata per Semester (sks)'] ?? null)
        ? $rowData['Rata-rata per Semester (sks)']
        : 0,
                                            'tahun_ajaran_id' => $tahunAjaranId,
                                            'user_id' => $userId,
                                        ]
                                    );
                                    break;
                                case 'Dosen Industri Praktisi':
                                    $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;

                                    \App\Models\DosenIndustriPraktisi::create(
                                        [
                                            'nama_dosen' => $rowData['Nama Dosen'] ?? '-',
                                            'nidk' => $rowData['NIDK'] ?? '-',
                                            'perusahaan' => $rowData['Perusahaan/ Industri'] ?? '-',
                                            'pendidikan_tertinggi' => $rowData['Pendidikan Tertinggi'] ?? '-',
                                            'bidang_keahlian' => $rowData['Bidang Keahlian'] ?? '-',
                                            'sertifikat_kompetensi' => $rowData['Sertifikat Profesi/ Kompetensi/ Industri'] ?? '-',
                                            'mk_diampu' => $rowData['Mata Kuliah yang Diampu'] ?? '-',
                                            'bobot_kredit_sks' => $rowData['Bobot Kredit (sks)'] ?? '-',
                                            'tahun_ajaran_id' => $tahunAjaranId,
                                            'user_id' => $userId,
                                        ]
                                    );
                                    break;
                                    case 'Rekognisi Dtps':
                                        $value = $rowData['Rekognisi dan Bukti Pendukung'] ?? '-';

if ($value && filter_var($value, FILTER_VALIDATE_URL)) {
    $bukti_pendukung = $value;
    $nama_rekognisi = '-';
} else {
    $bukti_pendukung = '-';
    $nama_rekognisi = $value;
}
if (($rowData['Tingkat - Wilayah'] ?? null) === '✓') {
    $tingkat = 'lokal';
} elseif (($rowData['Tingkat - Nasional'] ?? null) === '✓') {
    $tingkat = 'nasional';
} elseif (($rowData['Tingkat - Internasional'] ?? null) === '✓') {
    $tingkat = 'internasional';
} else {
    $tingkat = '-';
}
                                  \App\Models\RekognisiDosen::create(
                                            [
                                                'nama_dosen' => $rowData['Nama Dosen'] ?? '-',
                                                'bidang_keahlian' => $rowData['Bidang Keahlian'] ?? '-',
                                                'bukti_pendukung' => $bukti_pendukung,
                                                'nama_rekognisi' => $nama_rekognisi,
                                                'tingkat' => $tingkat ?? '-',
                                                'tahun' => $rowData['Tahun'] ?? '-',
                                                'user_id' => $userId,
                                            ]
                                        );
                                        break;
                                        case 'Penelitian Dtps':
                                            $sumberDana = [
                                            'a. Perguruan Tinggi (POLIJE) \n b. Mandiri' => 'lokal',

                                            'Lembaga Dalam Negeri (Diluar Polije)' => 'nasional',

                                            'Lembaga Luar Negeri' => 'internasional',
                                            ];
                                            $sumberPembiayaan = $rowData['Sumber Pembiayaan'] ?? null;
$sumber_dana = $sumberDana[$sumberPembiayaan] ?? '-';

                                            \App\Models\PenelitianDtps::create(
                                                [
        'sumber_dana' => $sumber_dana,
        'jumlah_judul' => $rowData['Jumlah Judul Penelitian'] ?? '0',
        'tahun_penelitian' => $rowData['Tahun Penelitian'] ?? '-',
        'user_id' => $userId,
    ]
                                            );
                                            break;
                                            case 'PKM Dtps':
                                                $sumberDana = [
                                                'a. Perguruan Tinggi (POLIJE) \n b. Mandiri' => 'lokal',

                                                'Lembaga Dalam Negeri (Diluar Polije)' => 'nasional',

                                                'Lembaga Luar Negeri' => 'internasional',
                                                ];
                                                $sumberPembiayaan = $rowData['Sumber Pembiayaan'] ?? null;
$sumber_dana = $sumberDana[$sumberPembiayaan] ?? '-';
                                                \App\Models\PkmDtps::create(
                                                    [
                                                        'sumber_dana' => $sumber_dana,
                                                        'jumlah_judul' => $rowData['Jumlah Judul Penelitian'] ?? '0',
                                                        'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                    ]
                                                );
                                                break;
                                                case 'Produk Teradopsi Dosen':
                                                    \App\Models\ProdukTeradopsiDosen::create(
                                                        [
                                                            'nama_dosen' => $rowData['Nama Dosen'] ?? '-',
                                                            'nama_produk' => $rowData['Nama Produk/Jasa'] ?? '-',
                                                            'deskripsi_produk' => $rowData['Deskripsi Poduk/Jasa'] ?? '-',
                                                            'bukti' => $rowData['Bukti'] ?? '-',
                                                            'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                        ]
                                                    );
                                                    break;
                                                case 'Publikasi Ilmiah Dosen':
                                                        \App\Models\PublikasiIlmiahDosen::create(
                                                            [
                                                                'nama_dosen' => $rowData['Nama Dosen'] ?? '-',
                                                                'judul_artikel' => $rowData['Judul Artikel'] ?? '-',
                                                                'jenis_artikel' => $rowData['Jenis Publikasi'] ?? '-',
                                                                'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                            ]
                                                        );
                                                        break;
                                                        case 'Sitasi Karya Dosen':
                                                            \App\Models\SitasiKaryaDosen::create(
                                                                [
                                                                    'nama_dosen' => $rowData['Nama Dosen'] ?? '-',
                                                                    'judul_artikel' => $rowData['Judul Artikel'] ?? '-',
                                                                    'jumlah_sitasi' => $rowData['Jumlah Sitasi'] ?? '0',
                                                                    'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                ]
                                                            );
                                                            break;
                                                            case 'HKI Paten Dosen':
                                                                \App\Models\HkiPatenDosen::create(
                                                                    [
                                                                        'luaran_penelitian' => $rowData['Luaran Penelitian - HKI: a) Paten, b) Paten Sederhana'] ?? '-',
                                                                        'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                        'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                    ]
                                                                );
                                                                break;
                                                                case 'HKI HakCipta Dosen':
                                                                    \App\Models\HkiHakciptaDosen::create(
                                                                        [
                                                                            'luaran_penelitian' => $rowData['Luaran Penelitian - HKI: a) Hak Cipta, b) Desain Produk Industri, c) Perlindungan Varietas Tanaman (Sertifikat Perlindungan'] ?? '-',
                                                                            'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                            'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                        ]
                                                                    );
                                                                    break;
                                                                    case 'Teknologi Karya Dosen':
                                                                        \App\Models\TeknologiKaryaDosen::create(
                                                                            [
                                                                                'luaran_penelitian' => $rowData['Luaran Penelitian - Teknologi Tepat Guna, Produk (Produk Terstandarisasi, Produk Tersertifikasi), Karya Seni, Rekayasa Sosial'] ?? '-',
                                                                                'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                                'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                            ]
                                                                        );
                                                                        break;
                                                                        case 'Buku Chapter Dosen':
                                                                            \App\Models\BukuChapterDosen::create(
                                                                                [
                                                                                    'luaran_penelitian' => $rowData['Luaran Penelitian - Buku ber-ISBN, Book Chapter'] ?? '-',
                                                                                    'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                                    'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                                ]
                                                                            );
                                                                            break;
                                                                        case 'IPK Lulusan':
                                                                            \App\Models\IpkLulusan::create(
                                                                                [
                                                                                    'jumlah_lulusan' => $rowData['Jumlah Lulusan'] ?? '0',
                                                                                    'ipk_minimal' => $rowData['Indeks Prestasi Kumulatif - Min'] ?? '0',
                                                                                    'ipk_maksimal' => $rowData['Indeks Prestasi Kumulatif - Rata-rata'] ?? '0',
                                                                                    'ipk_rata_rata' => $rowData['Indeks Prestasi Kumulatif - Max'] ?? '0',
                                                                                    'tahun' => $rowData['Tahun Ajaran'] ?? '-',
                                                                                    'user_id' => $userId,
                                                                                ]
                                                                            );
                                                                            break;
                                                                        case 'Masa Studi Lulusan':
                                                                            \App\Models\MasaStudiLulusan::create(
                                                                                [
                                                                                    'masa_studi' => $rowData['Masa Studi'] ?? '-',
                                                                                    'jumlah_mhs_diterima' => $rowData['Jumlah Mahasiswa Diterima'] ?? '0',
                                                                                    'jumlah_mhs_lulus_akhir_ts' => $rowData['Jumlah Mahasiswa yang Lulus Pada Akhir TS - Akhir TS'] ?? '0',
                                                                                    'jumlah_mhs_lulus_akhir_ts_1' => $rowData['Jumlah Mahasiswa yang Lulus Pada Akhir TS - Akhir TS-1'] ?? '0',
                                                                                    'jumlah_mhs_lulus_akhir_ts_2' => $rowData['Jumlah Mahasiswa yang Lulus Pada Akhir TS - Akhir TS-2'] ?? '0',
                                                                                    'jumlah_mhs_lulus_akhir_ts_3' => $rowData['Jumlah Mahasiswa yang Lulus Pada Akhir TS - Akhir TS-3'] ?? '0',
                                                                                    'jumlah_mhs_lulus_akhir_ts_4' => $rowData['Jumlah Mahasiswa yang Lulus Pada Akhir TS - Akhir TS-4'] ?? '0',
                                                                                    'jumlah_mhs_lulus_akhir_ts_5' => $rowData['Jumlah Mahasiswa yang Lulus Pada Akhir TS - Akhir TS-5'] ?? '-',
                                                                                    'jumlah_mhs_lulus_akhir_ts_6' => $rowData['Jumlah Mahasiswa yang Lulus Pada Akhir TS - Akhir TS-6'] ?? '0',
                                                                                    'jumlah_lulusan' => $rowData['Jumlah Lulusan s.d Akhir TS'] ?? '0',
                                                                                    'mean_masa_studi' => $rowData['Rata-rata Masa Studi'] ?? '0',
                                                                                    'tahun' => $rowData['Tahun Masuk'] ?? '-',
                                                                                            'user_id' => $userId,
                                                                                ]
                                                                            );
                                                                            break;
                                                                        case 'Prestasi Akademik':
                                                                            $lokal = ($rowData['Tingkat - Lokal/Wilayah'] ?? '') === '✓' ? 1 : 0;
$nasional = ($rowData['Tingkat - Nasional'] ?? '') === '✓' ? 1 : 0;
$internasional = ($rowData['Tingkat - Internasional'] ?? '') === '✓' ? 1 : 0;

if ($lokal === 1) {
    $tingkat = 'lokal';
} elseif ($nasional === 1) {
    $tingkat = 'nasional';
} elseif ($internasional === 1) {
    $tingkat = 'internasional';
} else {
    $tingkat = '';
}

                                                                            \App\Models\PrestasiAkademikMhs::create(
                                                                                [
                                                                                    'nama_kegiatan' => $rowData['Nama Kegiatan'] ?? '-',
                                                                                    'prestasi' => $rowData['Prestasi yang Dicapai'] ?? '-',
                                                                                    'tingkat' => $tingkat ?? '-',
                                                                                    'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                                ]
                                                                            );
                                                                            break;
                                                                            case 'Prestasi Non Akademik':
                                                                                $lokal = ($rowData['Tingkat - Lokal/Wilayah'] ?? '') === '✓' ? 1 : 0;
$nasional = ($rowData['Tingkat - Nasional'] ?? '') === '✓' ? 1 : 0;
$internasional = ($rowData['Tingkat - Internasional'] ?? '') === '✓' ? 1 : 0;

if ($lokal === 1) {
    $tingkat = 'lokal';
} elseif ($nasional === 1) {
    $tingkat = 'nasional';
} elseif ($internasional === 1) {
    $tingkat = 'internasional';
} else {
    $tingkat = '';
}

                                                                                \App\Models\PrestasiNonakademikMhs::create(
                                                                                    [
                                                                                        'nama_kegiatan' => $rowData['Nama Kegiatan'] ?? '-',
                                                                                        'prestasi' => $rowData['Prestasi yang Dicapai'] ?? '-',
                                                                                        'tingkat' => $tingkat ?? '-',
                                                                                        'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                                    ]
                                                                                );
                                                                                break;
                                                                                case 'Evaluasi Kepuasan Pengguna':
                                                                                    \App\Models\EvalKepuasanPengguna::create(
                                                                                        [
                                                                                            'jenis_kemampuan' => $rowData['Jenis Kemampuan'] ?? '-',
                                                                                            'tingkat_kepuasan_sangat_baik' => $rowData['Tingkat Kepuasan Pengguna (%) - Sangat Baik'] ?? '0',
                                                                                            'tingkat_kepuasan_baik' => $rowData['Tingkat Kepuasan Pengguna (%) - Baik'] ?? '0',
                                                                                            'tingkat_kepuasan_cukup' => $rowData['Tingkat Kepuasan Pengguna (%) - Cukup'] ?? '0',
                                                                                            'tingkat_kepuasan_kurang' => $rowData['Tingkat Kepuasan Pengguna (%) - Kurang'] ?? '0',
                                                                                            'rencana_tindakan' => $rowData['Rencana Tindak Lanjut Oleh UPPS/PS'] ?? '0',
                                                                                            'jumlah_lulusan' => $rowData['Jumlah Lulusan'] ?? '0',
                                                                                            'jumlah_responden' => $rowData['Jumlah Tanggapan Kepuasan Pengguna yang Terlacak'] ?? '0',
                                                                                            'tahun' => $rowData['Tahun Lulus'] ?? '-',
                                                                                            'user_id' => $userId,
                                                                                        ]
                                                                                    );
                                                                                    break;
                                                                                case 'Evaluasi Kesesuaian Kerja':
                                                                                    \App\Models\EvalKesesuaianKerja::create(
                                                                                        [
                                                                                            'jumlah_lulusan' => $rowData['Jumlah Lulusan'] ?? '0',
                                                                                            'jumlah_lulusan_terlacak' => $rowData['Jumlah Lulusan yang Terlacak'] ?? '0',
                                                                                            'jumlah_lulusan_bekerja' => $rowData['Jumlah Lulusan yang Terlacak dengan Tingkat Kesesuaian Bidang Kerja'] ?? '0',
                                                                                            'tahun' => $rowData['Tahun Lulus'] ?? '-',
                                                                                            'user_id' => $userId,
                                                                                        ]
                                                                                    );
                                                                                    break;
                                                                                case 'Evaluasi Tempat Kerja':
                                                                                    \App\Models\EvalTempatKerja::create(
                                                                                        [
                                                                                            'jumlah_lulusan_terlacak' => $rowData['Jumlah Lulusan yang Terlacak'] ?? '0',
                                                                                            'jumlah_lulusan' => $rowData['Jumlah Lulusan'] ?? '0',
                                                                                            'jumlah_lulusan_bekerja_lokal' => $rowData['Jumlah Lulusan yang Terlacak dengan Tingkat/Ukuran Tempat Kerja/Berwirausaha - Lokal/ Wilayah/ Berwirausaha tidak Berbadan Hukum'] ?? '0',
                                                                                            'jumlah_lulusan_bekerja_nasional' => $rowData['Jumlah Lulusan yang Terlacak dengan Tingkat/Ukuran Tempat Kerja/Berwirausaha - Nasional/ Berwirausaha berbadan Hukum'] ?? '0',
                                                                                            'jumlah_lulusan_bekerja_internasional' => $rowData['Jumlah Lulusan yang Terlacak dengan Tingkat/Ukuran Tempat Kerja/Berwirausaha - Multinasional/ Internasional'] ?? '0',
                                                                                            'tahun' => $rowData['Tahun Lulus'] ?? '-',
                                                                                            'user_id' => $userId,
                                                                                        ]
                                                                                    );
                                                                                    break;
                                                                                case 'Evaluasi Waktu Tunggu':
                                                                                    \App\Models\EvalWaktuTunggu::create(
                                                                                        [
                                                                                            'masa_studi' => $rowData['Masa Studi'] ?? '-',
                                                                                            'jumlah_lulusan' => $rowData['Jumlah Lulusan'] ?? '0',
                                                                                            'jumlah_lulusan_terlacak' => $rowData['Jumlah Lulusan yang Terlacak'] ?? '0',
                                                                                            'jumlah_lulusan_terlacak_dipesan' => $rowData['Jumlah Lulusan yang Terlacak Dipesan'] ?? '0',
                                                                                            'jumlah_lulusan_waktu_tiga_bulan' => $rowData['Jumlah Lulusan yang Terlacak dengan Waktu Tunggu - WT < 3 Bulan'] ?? '0',
                                                                                            'jumlah_lulusan_waktu_enam_bulan' => $rowData['Jumlah Lulusan yang Terlacak dengan Waktu Tunggu - 3 Bulan < WT < 6 Bulan'] ?? '0',
                                                                                            'jumlah_lulusan_waktu_sembilan_bulan' => $rowData['Jumlah Lulusan yang Terlacak dengan Waktu Tunggu - WT > 6 Bulan'] ?? '0',
                                                                                            'tahun' => $rowData['Tahun Lulus'] ?? '-',
                                                                                            'user_id' => $userId,
                                                                                        ]
                                                                                    );
                                                                                    break;
                                                                                case 'Integrasi Penelitian':
                                                                                    \App\Models\IntegrasiPenelitian::create(
                                                                                        [
                                                                                            'judul_penelitian' => $rowData['Judul Penelitian'] ?? '-',
                                                                                            'nama_dosen' => $rowData['Nama Dosen'] ?? '-',
                                                                                            'mata_kuliah' => $rowData['Mata Kuliah'] ?? '-',
                                                                                            'bentuk_integrasi' => $rowData['Bidang Keahlian'] ?? '-',
                                                                                            'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                                        ]
                                                                                    );
                                                                                    break;
                                                                                case 'Kepuasan Mahasiswa':
                                                                                    \App\Models\KepuasanMahasiswa::create(
                                                                                        [
                                                                                            'aspek_penilaian' => $rowData['Aspek yang Diukur'] ?? '-',
                                                                                            'tingkat_kepuasan_sangat_baik' => $rowData['Tingkat Kepuasan Mahasiswa (%) - Sangat Baik'] ?? '0',
                                                                                            'tingkat_kepuasan_baik' => $rowData['Tingkat Kepuasan Mahasiswa (%) - Baik'] ?? '0',
                                                                                            'tingkat_kepuasan_cukup' => $rowData['Tingkat Kepuasan Mahasiswa (%) - Cukup'] ?? '0',
                                                                                            'tingkat_kepuasan_kurang' => $rowData['Tingkat Kepuasan Mahasiswa (%) - Kurang'] ?? '0',
                                                                                            'rencana_tindakan' => $rowData['Rencana Tindak Lanjut oleh UPPS/PS'] ?? '-',
                                                                                            'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                                        ]
                                                                                    );
                                                                                    break;
                                                                                    case 'Kurikulum Pembelajaran':
                                                                                        $kompetensi = ($rowData['Mata Kuliah Kompetensi'] ?? '') === '✓' ? 1 : 0;
$sikap = ($rowData['Capaian Pembelajaran - Sikap'] ?? '') === '✓' ? 1 : 0;
$pengetahuan = ($rowData['Capaian Pembelajaran - Pengetahuan'] ?? '') === '✓' ? 1 : 0;
$keterampilanumum = ($rowData['Capaian Pembelajaran - Keterampilan Umum'] ?? '') === '✓' ? 1 : 0;
$keterampilankhusus = ($rowData['Capaian Pembelajaran - Keterampilan Khusus'] ?? '') === '✓' ? 1 : 0;



                                                                                        \App\Models\KurikulumPembelajaran::create(
                                                                                            [
                                                                                                'nama_mata_kuliah' => $rowData['Mata Kuliah'] ?? '-',
                                                                                                'kode_mata_kuliah' => $rowData['Kode Mata Kuliah'] ?? '-',
                                                                                                'mata_kuliah_kompetensi' => $kompetensi ?? '-',
                                                                                                'sks_kuliah' => $rowData['Bobot Kredit (SKS) - Kuliah/ Responsi/ Tutorial'] ?? '0',
                                                                                                'sks_seminar' => $rowData['Bobot Kredit (SKS) - Seminar'] ?? '0',
                                                                                                'sks_praktikum' => $rowData['Bobot Kredit (SKS) - Praktikum Praktik/ Praktik Lapangan'] ?? '0',
                                                                                                'konversi_sks' => $rowData['Konversi Kredit ke Jam'] ?? '0',
                                                                                                'semester' => $rowData['Semester'] ?? '0',
                                                                                                'metode_pembelajaran' => $rowData['Metode Pembelajaran'] ?? '-',
                                                                                                'dokumen' => $rowData['Dokumen Rencana Pembelajaran'] ?? '-',
                                                                                                'unit_penyelenggara' => $rowData['Unit Penyelenggara'] ?? '-',
                                                                                                'capaian_kuliah_sikap' => $sikap ?? '-',
                                                                                                'capaian_kuliah_pengetahuan' => $pengetahuan ?? '-',
                                                                                                'capaian_kuliah_keterampilan_umum' => $keterampilanumum ?? '-',
                                                                                                'capaian_kuliah_keterampilan_khusus' => $keterampilankhusus ?? '-',
                                                                                                'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                                            ]
                                                                                        );
                                                                                        break;
                                                                                        case 'Penelitian Mahasiswa':
                                                                                            \App\Models\DtpsPenelitianMahasiswa::create(
                                                                                                [
                                                                                                    'nama_dosen' => $rowData['Nama Dosen Pembimbing'] ?? '-',
                                                                                                    'tema_penelitian' => $rowData['Tema Penelitian Sesuai Roadmap'] ?? '-',
                                                                                                    'nama_mahasiswa' => $rowData['Nama Mahasiswa'] ?? '-',
                                                                                                    'judul' => $rowData['Judul Kegiatan'] ?? '-',
                                                                                                    'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                        'user_id' => $userId,
                                                                                                ]
                                                                                            );
                                                                                            break;
                                                                                            case 'Rujukan Tesis Mahasiswa':
                                                                                                \App\Models\DtpsRujukanTesis::create(
                                                                                                    [
                                                                                                        'nama_dosen' => $rowData['Nama Dosen Pembimbing'] ?? '-',
                                                                                                        'tema_penelitian' => $rowData['Tema Penelitian Sesuai Roadmap'] ?? '-',
                                                                                                        'nama_mahasiswa' => $rowData['Nama Mahasiswa'] ?? '-',
                                                                                                        'judul' => $rowData['Judul Kegiatan'] ?? '-',
                                                                                                        'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                            'user_id' => $userId,
                                                                                                    ]
                                                                                                );
                                                                                                break;
                                                                                                case 'PKM Dtps Mahasiswa':
                                                                                                    \App\Models\PkmDtpsMahasiswa::create(
                                                                                                        [
                                                                                                            'tema' => $rowData['Tema Penelitian Sesuai Roadmap'] ?? '-',
                                                                                                            'nama_mhs' => $rowData['Nama Mahasiswa'] ?? '-',
                                                                                                            'judul' => $rowData['Judul Kegiatan'] ?? '-',
                                                                                                            'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                                'user_id' => $userId,
                                                                                                        ]
                                                                                                    );
                                                                                                    break;
                                                                                                    case 'Produk Jasa Mahasiswa':
                                                                                                        \App\Models\ProdukJasaMahasiswa::create(
                                                                                                            [
                                                                                                                'nama_produk' => $rowData['Nama Produk/Jasa'] ?? '-',
                                                                                                                'nama_mahasiswa' => $rowData['Nama Mahasiswa'] ?? '-',
                                                                                                                'deskripsi_produk' => $rowData['Deskripsi Produk/Jasa'] ?? '-',
                                                                                                                'bukti' => $rowData['Bukti Dukungan'] ?? '-',
                                                                                                                'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                                    'user_id' => $userId,
                                                                                                            ]
                                                                                                        );
                                                                                                        break;
                                                                                                        case 'Publikasi Mahasiswa':
                                                                                                            \App\Models\PublikasiMahasiswa::create(
                                                                                                                [
                                                                                                                    'judul_artikel' => $rowData['Judul Artikel'] ?? '-',
                                                                                                                    'nama_mahasiswa' => $rowData['Nama Mahasiswa'] ?? '-',
                                                                                                                    'jenis_artikel' => $rowData['Jenis Publikasi'] ?? '-',
                                                                                                                    'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                                        'user_id' => $userId,
                                                                                                                ]
                                                                                                            );
                                                                                                            break;
                                                                                                            case 'Sitasi Karya Mahasiswa':
                                                                                                                \App\Models\SitasiKaryaMahasiswa::create(
                                                                                                                    [
                                                                                                                        'judul_artikel' => $rowData['Judul Artikel'] ?? '-',
                                                                                                                        'nama_mahasiswa' => $rowData['Nama Mahasiswa'] ?? '-',
                                                                                                                        'jumlah_sitasi' => $rowData['Jumlah Sitasi'] ?? '0',
                                                                                                                        'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                                            'user_id' => $userId,
                                                                                                                    ]
                                                                                                                );
                                                                                                                break;
                                                                                                                case 'HKI Paten Mahasiswa':
                                                                                                                    \App\Models\HkiPatenMahasiswa::create(
                                                                                                                        [
                                                                                                                            'luaran_penelitian' => $rowData['Luaran Penelitian - HKI: a) Paten, b) Paten Sederhana'] ?? '-',
                                                                                                                            'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                                                                            'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                                                                    'user_id' => $userId,
                                                                                                                        ]
                                                                                                                    );
                                                                                                                    break;
                                                                                                                    case 'HKI HakCipta Mahasiswa':
                                                                                                                        \App\Models\HkiHakCiptaMahasiswa::create(
                                                                                                                            [
                                                                                                                                'luaran_penelitian' => $rowData['Luaran Penelitian - HKI: a) Hak Cipta, b) Desain Produk Industri, c) Perlindungan Varietas Tanaman (Sertifikat Perlindungan'] ?? '-',
                                                                                                                                'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                                                                                'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                                                                    'user_id' => $userId,
                                                                                                                            ]
                                                                                                                        );
                                                                                                                        break;
                                                                                                                        case 'Teknologi Karya Mahasiswa':
                                                                                                                            \App\Models\TeknologiKaryaMahasiswa::create(
                                                                                                                                [
                                                                                                                                    'luaran_penelitian' => $rowData['Luaran Penelitian - Teknologi Tepat Guna, Produk (Produk Terstandarisasi, Produk Tersertifikasi), Karya Seni, Rekayasa Sosial'] ?? '-',
                                                                                                                                    'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                                                                                    'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                                                                    'user_id' => $userId,
                                                                                                                                ]
                                                                                                                            );
                                                                                                                            break;
                                                                                                                            case 'Buku Chapter Mahasiswa':
                                                                                                                                \App\Models\BukuChapterMahasiswa::create(
                                                                                                                                    [
                                                                                                                                        'luaran_penelitian' => $rowData['Luaran Penelitian - Buku ber-ISBN, Book Chapter'] ?? '-',
                                                                                                                                        'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                                                                                        'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                                                                    'user_id' => $userId,
                                                                                                                                    ]
                                                                                                                                );                                                                                                                     break;
            }
} catch (\Exception $e) {
        Log::error("Gagal simpan data di Sheet '{$sheetName}', Baris Excel " . ($rowIndex + 1) . ": " . $e->getMessage());
    }
        
            
        }
    }

    Storage::delete($filePath);

    return redirect()->back()->with('success', 'Data berhasil diimpor!');
}
}
