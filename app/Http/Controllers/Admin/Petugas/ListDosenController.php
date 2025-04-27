<?php

namespace App\Http\Controllers\Admin\Petugas;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- Tambahkan ini
use PhpOffice\PhpSpreadsheet\IOFactory; // buat baca Excel (kalau kamu pakai PhpSpreadsheet)
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\SeleksiMahasiswaBaru;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class ListDosenController extends Controller
{
    public function index()
    {
        try {
            $listDosen = User::with('profile')->role('dosen')->get();
            return view('pages.admin.petugas.list-dosen.index', [
                'list_dosen' => $listDosen,
            ]);
        } catch (\Exception $e) {
            // return back()->withErrors('Oops something went wrong!');
            return back()->withErrors($e->getMessage());
        }
    }

    public function exportPdf(string $dosenId)
    {
        try {
            $data = User::with([
                'profile',

                /* kerjasama tridharma */
                'kerjasama_tridharma_pendidikan',
                'kerjasama_tridharma_penelitian',
                'kerjasama_tridharma_pengmas',

                /* data mahasiswa */
                'seleksi_maba',
                'mahasiswa_asing',

                /* data dosen */
                'dosen_tetap',
                'dosen_tidak_tetap',
                'dosen_pembimbing_ta',
                'ewmp_dosen',
                'dosen_praktisi',

                /*Kinerja Dosen*/
                'rekognisi_dtps',
                'penelitian_dtps',
                'pkm_dtps',
                'produk_teradopsi',
                'publikasi_ilmiah',
                'sitasi_karya_dosen',
                'hki_paten_dosen',
                'hki_cipta_dosen',
                'teknologi_karya_dosen',
                'buku_chapter_dosen',

                /*Kinerja Lulusan*/
                'ipk_lulusan',
                'masa_studi_lulusan',
                'eval_kepuasan_pengguna',
                'eval_kesesuaian_kerja',
                'eval_tempat_kerja',
                'eval_waktu_tunggu',
                'prestasi_akademik',
                'prestasi_nonakademik',

                /*kualitas pembelajaran*/
                'integrasi_penelitian',
                'kepuasan_mahasiswa',
                'kurikulum_pembelajaran',

                /*penelitian dtps*/
                'penelitian_mahasiswa',
                'rujukan_tesis_mahasiswa',

                /*pkm dtps mahasiswa*/
                'pkm_dtps_mahasiswa',

                /*Luaran Mahasiswa*/
                'produk_jasa_mahasiswa',
                'publikasi_mahasiswa',
                'sitasi_karya_mahasiswa',
                'hki_paten_mahasiswa',
                'hki_cipta_mahasiswa',
                'teknologi_karya_mahasiswa',
                'buku_chapter_mahasiswa',

            ])->whereId($dosenId)->firstOrFail();
            // dd($data);

            $total = SeleksiMahasiswaBaru::selectRaw('
                SUM(pendaftar) as total_pendaftar,
                SUM(lulus_seleksi) as total_lulus_seleksi,
                SUM(maba_reguler) as total_maba_reguler,
                SUM(maba_transfer) as total_maba_transfer,
                SUM(COALESCE(mhs_aktif_reguler, 0) + COALESCE(mhs_aktif_transfer, 0)) as total_mhs_aktif
            ')->first();

            $pdf = Pdf::loadView('pages.admin.petugas.list-dosen.print', compact('data', 'total'))->setPaper('legal', 'landscape');

            $filename = 'laporan-gkm-' . Str::slug($data->name) . '-' . time()  . '.pdf';

            return $pdf->stream($filename);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
    public function exportExcel(string $dosenId)
{
    try {
        $data = User::with([
            'profile',
            // kerjasama tridharma
            'kerjasama_tridharma_pendidikan',
            'kerjasama_tridharma_penelitian',
            'kerjasama_tridharma_pengmas',
            // data mahasiswa
            'seleksi_maba',
            'mahasiswa_asing',
            // data dosen
            'dosen_tetap',
            'dosen_tidak_tetap',
            'dosen_pembimbing_ta',
            'ewmp_dosen',
            'dosen_praktisi',
            // Kinerja Dosen
            'rekognisi_dtps',
            'penelitian_dtps',
            'pkm_dtps',
            'produk_teradopsi',
            'publikasi_ilmiah',
            'sitasi_karya_dosen',
            'hki_paten_dosen',
            'hki_cipta_dosen',
            'teknologi_karya_dosen',
            'buku_chapter_dosen',
            // Kinerja Lulusan
            'ipk_lulusan',
            'masa_studi_lulusan',
            'eval_kepuasan_pengguna',
            'eval_kesesuaian_kerja',
            'eval_tempat_kerja',
            'eval_waktu_tunggu',
            'prestasi_akademik',
            'prestasi_nonakademik',
            // kualitas pembelajaran
            'integrasi_penelitian',
            'kepuasan_mahasiswa',
            'kurikulum_pembelajaran',
            // penelitian dtps
            'penelitian_mahasiswa',
            'rujukan_tesis_mahasiswa',
            // pkm dtps mahasiswa
            'pkm_dtps_mahasiswa',
            // Luaran Mahasiswa
            'produk_jasa_mahasiswa',
            'publikasi_mahasiswa',
            'sitasi_karya_mahasiswa',
            'hki_paten_mahasiswa',
            'hki_cipta_mahasiswa',
            'teknologi_karya_mahasiswa',
            'buku_chapter_mahasiswa',
        ])->whereId($dosenId)->firstOrFail();

        // Membuat Spreadsheet baru
        $spreadsheet = new Spreadsheet();

        // Sheet 1: Kerjasama Pendidikan
$sheet1 = $spreadsheet->createSheet();
$sheet1->setTitle('Kerjasama Pendidikan');
$sheet1->fromArray([
    ['Judul Kerjasama', 'Lembaga Mitra', 'Tingkat', 'Manfaat Bagi Ps', 'Waktu Durasi', 'Bukti Kerjasama', 'Tahun Berakhir Kerjasama','Tahun Ajaran']
], NULL, 'A1');

$kerjasamaPendidikan = $data->kerjasama_tridharma_pendidikan->map(function ($item) {
    return [
        $item->judul_kegiatan ?? '-',
        $item->lembaga_mitra ?? '-',
        $item->tingkat ?? '-',
        $item->manfaat ?? '-',
        $item->waktu_durasi ?? '-',
        $item->bukti_kerjasama ?? '-',
        $item->tahun_berakhir ?? '-',
        $item->tahunAjaran->tahun_ajaran ?? '-',
    ];
})->toArray();

$sheet1->fromArray($kerjasamaPendidikan, NULL, 'A2');

// AutoSize dan WrapText Sheet 1
foreach (range('A', 'G') as $col) {
    $sheet1->getColumnDimension($col)->setAutoSize(true);
}
$sheet1->getStyle('A1:L' . (count($kerjasamaPendidikan) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet1->getStyle('A1:L' . (count($kerjasamaPendidikan) + 1))
    ->getAlignment()
    ->setWrapText(true);


// Sheet 2: Kerjasama Penelitian
$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('Kerjasama Penelitian');
$sheet2->fromArray([
    ['Judul Kerjasama', 'Lembaga Mitra', 'Tingkat', 'Manfaat Bagi Ps', 'Waktu Durasi', 'Bukti Kerjasama', 'Tahun Berakhir Kerjasama','Tahun Ajaran']
], NULL, 'A1');

$kerjasamaPenelitian = $data->kerjasama_tridharma_penelitian->map(function ($item) {
    return [
        $item->judul_kegiatan ?? '-',
        $item->lembaga_mitra ?? '-',
        $item->tingkat ?? '-',
        $item->manfaat ?? '-',
        $item->waktu_durasi ?? '-',
        $item->bukti_kerjasama ?? '-',
        $item->tahun_berakhir ?? '-',
        $item->tahunAjaran->tahun_ajaran ?? '-',
    ];
})->toArray();

$sheet2->fromArray($kerjasamaPenelitian, NULL, 'A2');

// AutoSize dan WrapText Sheet 2
foreach (range('A', 'G') as $col) {
    $sheet2->getColumnDimension($col)->setAutoSize(true);
}
$sheet2->getStyle('A1:L' . (count($kerjasamaPenelitian) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet2->getStyle('A1:L' . (count($kerjasamaPenelitian) + 1))
    ->getAlignment()
    ->setWrapText(true);


// Sheet 3: Kerjasama Pengabdian Masyarakat
$sheet3 = $spreadsheet->createSheet();
$sheet3->setTitle('Kerjasama Pengabdian Masyarakat');
$sheet3->fromArray([
    ['Judul Kerjasama', 'Lembaga Mitra', 'Tingkat', 'Manfaat Bagi Ps', 'Waktu Durasi', 'Bukti Kerjasama', 'Tahun Berakhir Kerjasama','Tahun Ajaran']
], NULL, 'A1');

$kerjasamaPengmas = $data->kerjasama_tridharma_pengmas->map(function ($item) {
    return [
        $item->judul_kegiatan ?? '-',
        $item->lembaga_mitra ?? '-',
        $item->tingkat ?? '-',
        $item->manfaat ?? '-',
        $item->waktu_durasi ?? '-',
        $item->bukti_kerjasama ?? '-',
        $item->tahun_berakhir ?? '-',
        $item->tahunAjaran->tahun_ajaran ?? '-',
    ];
})->toArray();

$sheet3->fromArray($kerjasamaPengmas, NULL, 'A2');

// AutoSize dan WrapText Sheet 3
foreach (range('A', 'G') as $col) {
    $sheet3->getColumnDimension($col)->setAutoSize(true);
}
$sheet3->getStyle('A1:L' . (count($kerjasamaPengmas) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet3->getStyle('A1:L' . (count($kerjasamaPengmas) + 1))
    ->getAlignment()
    ->setWrapText(true);


// Sheet 4: Seleksi Mahasiswa Baru
$sheet4 = $spreadsheet->createSheet();
$sheet4->setTitle('Seleksi Mahasiswa Baru');
$sheet4->fromArray([
    ['Tahun Akademik', 'Daya Tampung', 'Jumlah Calon Mahasiswa', '', 'Jumlah Mahasiswa Baru', '', 'Jumlah Mahasiswa Aktif', '','Tahun Ajaran'],
    ['', '', 'Pendaftar', 'Lulus Seleksi', 'Reguler', 'Transfer', 'Reguler', 'Transfer']
], NULL, 'A1');

$seleksiMaba = $data->seleksi_maba->map(function ($item) {
    return [
        $item->tahun_akademik ?? '-',
        $item->daya_tampung ?? '-',
        $item->pendaftar ?? '-',
        $item->lulus_seleksi ?? '-',
        $item->maba_reguler ?? '-',
        $item->maba_transfer ?? '-',
        $item->mhs_aktif_reguler ?? '-',
        $item->mhs_aktif_transfer ?? '-',
        $item->tahunAjaran->tahun_ajaran ?? '-',
    ];
})->toArray();

$sheet4->fromArray($seleksiMaba, NULL, 'A3');

// Merge Cells header Sheet 4
$sheet4->mergeCells('A1:A2');
$sheet4->mergeCells('B1:B2');
$sheet4->mergeCells('C1:D1');
$sheet4->mergeCells('E1:F1');
$sheet4->mergeCells('G1:H1');

// AutoSize dan WrapText Sheet 4
foreach (range('A', 'H') as $col) {
    $sheet4->getColumnDimension($col)->setAutoSize(true);
}
$sheet4->getStyle('A1:L' . (count($seleksiMaba) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet4->getStyle('A1:L' . (count($seleksiMaba) + 2))
    ->getAlignment()
    ->setWrapText(true);


// Sheet 5: Mahasiswa Asing
$sheet5 = $spreadsheet->createSheet();
$sheet5->setTitle('Mahasiswa Asing');
$sheet5->fromArray([
    ['Tahun AJaran', 'Jumlah Mahasiswa Aktif', 'Jumlah Mahasiswa Asing Penuh Waktu', 'Jumlah Mahasiswa Asing Paruh Waktu']
], NULL, 'A1');

$mahasiswaAsing = $data->mahasiswa_asing->map(function ($item) {
    return [
        $item->tahunAjaran?->tahun_ajaran ?? '-',
        $item->mhs_aktif ?? '-',
        $item->mhs_asing_fulltime ?? '-',
        $item->mhs_asing_parttime ?? '-',
    ];
})->toArray();

$sheet5->fromArray($mahasiswaAsing, NULL, 'A2');

// AutoSize dan WrapText Sheet 5
foreach (range('A', 'D') as $col) {
    $sheet5->getColumnDimension($col)->setAutoSize(true);
}
$sheet5->getStyle('A1:L' . (count($mahasiswaAsing) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet5->getStyle('A1:L' . (count($mahasiswaAsing) + 1))
    ->getAlignment()
    ->setWrapText(true);


// Sheet 6: Dosen Tetap
$sheet6 = $spreadsheet->createSheet();
$sheet6->setTitle('Dosen Tetap');

$sheet6->fromArray([
    [
        'Nama Dosen',
        'NIDN/NIDK',
        'Pendidikan Pasca Sarjana', '',
        'Bidang Keahlian',
        'Kesesuaian dengan Kompetensi Inti PS',
        'Jabatan Akademik',
        'Sertifikat Pendidik Profesional',
        'Sertifikat Kompetensi/ Profesi/ Industri',
        'Mata Kuliah yang Diampu pada PS',
        'Kesesuaian Bidang Keahlian dengan Mata Kuliah yang Diampu',
        'Mata Kuliah yang Diampu pada PS Lain',
        'Tahun Ajaran'
    ],
    [
        '', '',
        'Magister/ Magister Terapan/ Spesialis', 'Doktor/ Doktor Terapan/ Spesialis',
        '', '', '', '', '', '', '', ''
    ]
], NULL, 'A1');

// Merge Cells Sheet 6
$sheet6->mergeCells('A1:A2');
$sheet6->mergeCells('B1:B2');
$sheet6->mergeCells('C1:D1');
$sheet6->mergeCells('E1:E2');
$sheet6->mergeCells('F1:F2');
$sheet6->mergeCells('G1:G2');
$sheet6->mergeCells('H1:H2');
$sheet6->mergeCells('I1:I2');
$sheet6->mergeCells('J1:J2');
$sheet6->mergeCells('K1:K2');
$sheet6->mergeCells('L1:L2');
$sheet6->mergeCells('M1:M2');

$dosenTetap = $data->dosen_tetap->map(function ($item) {
    return [
        $item->nama_dosen ?? '-',
        $item->nidn_nidk ?? '-',
        $item->gelar_magister ?? '-',
        $item->gelar_doktor ?? '-',
        $item->bidang_keahlian ?? '-',
        $item->kesesuaian_kompetensi ? '✓' : '-',
        $item->jabatan_akademik ?? '-',
        $item->sertifikat_pendidik ?? '-',
        $item->sertifikat_kompetensi ?? '-',
        $item->mk_diampu ?? '-',
        $item->kesesuaian_keahlian_mk ? '✓' : '-',
        $item->mk_ps_lain ?? '-',
        $item->tahunAjaran->tahun_ajaran ?? '-',
    ];
})->toArray();

$sheet6->fromArray($dosenTetap, NULL, 'A3');

// AutoSize dan WrapText Sheet 6
foreach (range('A', 'M') as $col) {
    $sheet6->getColumnDimension($col)->setAutoSize(true);
}
$sheet6->getStyle('A1:M' . (count($dosenTetap) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet6->getStyle('A1:M' . (count($dosenTetap) + 2))
    ->getAlignment()
    ->setWrapText(true);

// Sheet 7: Dosen Tidak Tetap
$sheet7 = $spreadsheet->createSheet();
$sheet7->setTitle('Dosen Tidak Tetap');

$sheet7->fromArray([
    [
        'Nama Dosen',
        'NIDN/NIDK',
        'Pendidikan Pasca Sarjana',
        'Bidang Keahlian',
        'Kesesuaian dengan Kompetensi Inti PS',
        'Jabatan Akademik',
        'Sertifikat Pendidik Profesional',
        'Sertifikat Kompetensi/ Profesi/ Industri',
        'Mata Kuliah yang Diampu pada PS',
        'Kesesuaian Bidang Keahlian dengan Mata Kuliah yang Diampu',
        'Mata Kuliah yang Diampu pada PS Lain',
        'Tahun Ajaran'
    ],
], NULL, 'A1');

// Merge Cells Sheet 7

$dosenTidakTetap = $data->dosen_tidak_tetap->map(function ($item) {
    return [
        $item->nama_dosen ?? '-',
        $item->nidn_nidk ?? '-',
        $item->pendidikan_pascasarjana ?? '-',
        $item->bidang_keahlian ?? '-',
        $item->kesesuaian_kompetensi ? '✓' : '-',
        $item->jabatan_akademik ?? '-',
        $item->sertifikat_pendidik ?? '-',
        $item->sertifikat_kompetensi ?? '-',
        $item->mk_diampu ?? '-',
        $item->kesesuaian_keahlian_mk ? '✓' : '-',
        $item->mk_ps_lain ?? '-',
        $item->tahunAjaran->tahun_ajaran ?? '-',

    ];
})->toArray();

$sheet7->fromArray($dosenTidakTetap, NULL, 'A2');

// AutoSize dan WrapText Sheet 7
foreach (range('A', 'M') as $col) {
    $sheet7->getColumnDimension($col)->setAutoSize(true);
}
$sheet7->getStyle('A1:M' . (count($dosenTidakTetap) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet7->getStyle('A1:M' . (count($dosenTidakTetap) + 1))
    ->getAlignment()
    ->setWrapText(true);

// Sheet 8: Dosen Pembimbing TA
$sheet8 = $spreadsheet->createSheet();
$sheet8->setTitle('Dosen Pembimbing TA');

$sheet8->fromArray([
    [
        'Nama Dosen',
        'Jumlah Mahasiswa yang Dibimbing',
        '',
        'Tahun Ajaran'

    ],
    [
        '',
        'Pada PS',
        'Pada PS Lain',
        ''
    ],
], NULL, 'A1');

// Merge Cells Sheet 8

$sheet8->mergeCells('A1:A2');
$sheet8->mergeCells('B1:C1');
$sheet8->mergeCells('D1:D2');

$dosenPembimbingTA = $data->dosen_pembimbing_ta->map(function ($item) {
    return [
        $item->nama_dosen ?? '-',
        $item->mhs_bimbingan_ps ?? '-',
        $item->mhs_bimbingan_ps_lain ?? '-',
        $item->tahunAjaran->tahun_ajaran ?? '-',
    ];
})->toArray();

$sheet8->fromArray($dosenPembimbingTA, NULL, 'A3');

// AutoSize dan WrapText Sheet 8
foreach (range('A', 'L') as $col) {
    $sheet8->getColumnDimension($col)->setAutoSize(true);
}
$sheet8->getStyle('A1:L' . (count($dosenPembimbingTA) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet8->getStyle('A1:L' . (count($dosenPembimbingTA) + 2))
    ->getAlignment()
    ->setWrapText(true);

// Sheet 9: Dosen EWMP Dosen
$sheet9 = $spreadsheet->createSheet();
$sheet9->setTitle('Dosen EWMP Dosen');

$sheet9->fromArray([
    [
        'Nama Dosen',
        'DTPS',
        'Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks)',
        '',
        '',
        '',
        '',
        '',
        'Jumlah (sks)',
        'Rata-rata per Semester (sks)',
        'Tahun Ajaran'
    ],
    [
        '',
        '',
        'Pendidikan: Pembelajaran dan Pembimbingan',
        '',
        '',
        'Penelitian',
        'PkM',
        'Tugas Tambahan dan/atau Penunjang',
        '',
        '',
        ''
    ],
    [
        '',
        '',
        'PS yang Diakreditasi',
        'PS Lain di dalam PT',
        'PS Lain di luar PT',
        '',
        '',
        '',
        '',
        '',
        ''
    ],
], NULL, 'A1');

// Merge Cells Sheet 9

$sheet9->mergeCells('A1:A3');
$sheet9->mergeCells('B1:B3');
$sheet9->mergeCells('C1:H1');
$sheet9->mergeCells('C2:E2');
$sheet9->mergeCells('F2:F3');
$sheet9->mergeCells('G2:G3');
$sheet9->mergeCells('H2:H3');
$sheet9->mergeCells('I1:I3');
$sheet9->mergeCells('J1:J3');
$sheet9->mergeCells('K1:K3');



$ewmpDosen = $data->ewmp_dosen->map(function ($item) {
    return [
        $item->nama_dosen ?? '-',
        $item->is_dtps ? '✓' : '-',
        $item->ps_diakreditasi ?? '-',
        $item->ps_lain_dalam_pt ?? '-',
        $item->ps_lain_luar_pt ?? '-',
        $item->penelitian ?? '-',
        $item->pkm ?? '-',
        $item->tugas_tambahan ?? '-',
        $item->jumlah_sks ?? '-',
        $item->avg_per_semester ?? '-',
        $item->tahunAjaran->tahun_ajaran ?? '-',
    ];
})->toArray();

$sheet9->fromArray($ewmpDosen, NULL, 'A4');

// AutoSize dan WrapText Sheet 9
foreach (range('A', 'L') as $col) {
    $sheet9->getColumnDimension($col)->setAutoSize(true);
}
$sheet9->getStyle('A1:L' . (count($ewmpDosen) + 3))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet9->getStyle('A1:L' . (count($ewmpDosen) + 3))
    ->getAlignment()
    ->setWrapText(true);

    // Sheet 10: Dosen Industri/Praktisi
$sheet10 = $spreadsheet->createSheet();
$sheet10->setTitle('Dosen Industri Praktisi');
$sheet10->fromArray([
    ['Nama Dosen Industri/Praktisi', 'NIDK', 'Perusahaan/ Industri', 'Pendidikan Tertinggi', 'Bidang Keahlian', 'Sertifikat Profesi/ Kompetensi/ Industri', 'Mata Kuliah yang Diampu','Bobot Kredit (sks)', 'Tahun Ajaran']
], NULL, 'A1');

$DosenPraktisi = $data->dosen_praktisi->map(function ($item) {
    return [
        $item->nama_dosen ?? '-',
        $item->nidk ?? '-',
        $item->tingkat ?? '-',
        $item->perusahaan ?? '-',
        $item->pendidikan_tertinggi ?? '-',
        $item->bidang_keahlian ?? '-',
        $item->sertifikat_kompetensi ?? '-',
        $item->mk_diampu ?? '-',
        $item->bobot_kredit_sks ?? '-',
        $item->tahunAjaran->tahun_ajaran ?? '-',
    ];
})->toArray();

$sheet10->fromArray($DosenPraktisi, NULL, 'A2');

// AutoSize dan WrapText Sheet 10
foreach (range('A', 'G') as $col) {
    $sheet10->getColumnDimension($col)->setAutoSize(true);
}
$sheet10->getStyle('A1:L' . (count($DosenPraktisi) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet10->getStyle('A1:L' . (count($DosenPraktisi) + 1))
    ->getAlignment()
    ->setWrapText(true);

    // Sheet 11: Rekognisi Dtps
$sheet11 = $spreadsheet->createSheet();
$sheet11->setTitle('Rekognisi Dtps');

$sheet11->fromArray([
    [
        'Nama Dosen',
        'Bidang Keahlian',
        'Rekognisi dan Bukti Pendukung',
        'Tingkat',
        '',
        '',
        'Tahun'
    ],
    [
        '',
        '',
        '',
        'Wilayah',
        'Nasional',
        'Internasional',
        ''

    ],
], NULL, 'A1');

// Merge Cells Sheet 11

$sheet11->mergeCells('A1:A2');
$sheet11->mergeCells('B1:B2');
$sheet11->mergeCells('C1:C2');
$sheet11->mergeCells('D1:F1');
$sheet11->mergeCells('G1:G2');

$rekognisiDtps = $data->rekognisi_dtps->map(function ($item) {
    return [
        $item->nama_dosen ?? '-',
        $item->bidang_keahlian ?? '-',
        ($item->bukti_pendukung ?? '-') . ' | ' . ($item->nama_rekognisi ?? '-'),
        $item->tingkat == 'lokal' ? '✓' : '-',
        $item->tingkat == 'nasional' ? '✓' : '-',
        $item->tingkat == 'internasional' ? '✓' : '-',
        $item->tahun ?? '-',
    ];
})->toArray();

$sheet11->fromArray($rekognisiDtps, NULL, 'A3');

// AutoSize dan WrapText Sheet 11
foreach (range('A', 'L') as $col) {
    $sheet11->getColumnDimension($col)->setAutoSize(true);
}
$sheet11->getStyle('A1:L' . (count($rekognisiDtps) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet11->getStyle('A1:L' . (count($rekognisiDtps) + 2))
    ->getAlignment()
    ->setWrapText(true);

    // Sheet 12: Penelitian Dtps
$sheet12 = $spreadsheet->createSheet();
$sheet12->setTitle('Penelitian Dtps');

$sheet12->fromArray([
    [
        'Sumber Pembiayaan',
        'Jumlah Judul Penelitian',
        'Tahun Penelitian'
    ],
], NULL, 'A1');

$sumberDana = [
    'lokal' => "a. Perguruan Tinggi (POLIJE) \n b. Mandiri",

    'nasional' => "Lembaga Dalam Negeri (Diluar Polije)",

    'internasional' => "Lembaga Luar Negeri"
];
$penelitianDtps = $data->penelitian_dtps->map(function ($item) {
    return [
        $sumberDana[$item->sumber_dana] ?? '-' ,
        $item->jumlah_judul ?? '-',
        $item->tahun_penelitian ?? '-',
    ];
})->toArray();

$sheet12->fromArray($penelitianDtps, NULL, 'A2');

// AutoSize dan WrapText Sheet 12
foreach (range('A', 'L') as $col) {
    $sheet12->getColumnDimension($col)->setAutoSize(true);
}
$sheet12->getStyle('A1:L' . (count($penelitianDtps) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet12->getStyle('A1:L' . (count($penelitianDtps) + 1))
    ->getAlignment()
    ->setWrapText(true);

// Sheet 13: pkm Dtps
$sheet13 = $spreadsheet->createSheet();
$sheet13->setTitle('PKM Dtps');

$sheet13->fromArray([
    [
        'Sumber Pembiayaan',
        'Jumlah Judul PKM',
        'Tahun'
    ],
], NULL, 'A1');

$sumberDana = [
    'lokal' => "a. Perguruan Tinggi (POLIJE) \n b. Mandiri",

    'nasional' => "Lembaga Dalam Negeri (Diluar Polije)",

    'internasional' => "Lembaga Luar Negeri"
];
$pkmDtps = $data->pkm_dtps->map(function ($item) {
    return [
        $sumberDana[$item->sumber_dana] ?? '-' ,
        $item->jumlah_judul ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();

$sheet13->fromArray($pkmDtps, NULL, 'A2');

// AutoSize dan WrapText Sheet 13
foreach (range('A', 'L') as $col) {
    $sheet13->getColumnDimension($col)->setAutoSize(true);
}
$sheet13->getStyle('A1:L' . (count($pkmDtps) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet13->getStyle('A1:L' . (count($pkmDtps) + 1))
    ->getAlignment()
    ->setWrapText(true);

// Sheet 14: Produk Teradopsi Dosen
$sheet14 = $spreadsheet->createSheet();
$sheet14->setTitle('Produk Teradopsi Dosen');

$sheet14->fromArray([
    [
        'Nama Dosen',
        'Nama Produk/Jasa',
        'Deskripsi Poduk/Jasa',
        'Bukti',
        'Tahun'
    ],
], NULL, 'A1');

$produkTeradopsi = $data->produk_teradopsi->map(function ($item) {
    return [
        $item->nama_dosen ?? '-' ,
        $item->nama_produk ?? '-',
        $item->deskripsi_produk ?? '-',
        $item->bukti ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();

$sheet14->fromArray($produkTeradopsi, NULL, 'A2');

// AutoSize dan WrapText Sheet 14
foreach (range('A', 'L') as $col) {
    $sheet14->getColumnDimension($col)->setAutoSize(true);
}
$sheet14->getStyle('A1:L' . (count($produkTeradopsi) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet14->getStyle('A1:L' . (count($produkTeradopsi) + 1))
    ->getAlignment()
    ->setWrapText(true);

    // Sheet 15: Publikasi Ilmiah Dosen
$sheet15 = $spreadsheet->createSheet();
$sheet15->setTitle('Publikasi Ilmiah Dosen');

$sheet15->fromArray([
    [
        'Nama Dosen',
        'Judul Artikel',
        'Jenis Publikasi',
        'Tahun'
    ],
], NULL, 'A1');

$publikasiIlmiah = $data->publikasi_ilmiah->map(function ($item) {
    return [
        $item->nama_dosen ?? '-' ,
        $item->judul_artikel ?? '-' ,
        $item->jenis_artikel ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();

$sheet15->fromArray($publikasiIlmiah, NULL, 'A2');

// AutoSize dan WrapText Sheet 15
foreach (range('A', 'L') as $col) {
    $sheet15->getColumnDimension($col)->setAutoSize(true);
}
$sheet15->getStyle('A1:L' . (count($publikasiIlmiah) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$sheet15->getStyle('A1:L' . (count($publikasiIlmiah) + 1))
    ->getAlignment()
    ->setWrapText(true);
    // Sheet 16: Sitasi Karya Dosen
$sheet16 = $spreadsheet->createSheet();
$sheet16->setTitle('Sitasi Karya Dosen');
$sheet16->fromArray([
    [
        'Nama Dosen',
        'Judul Artikel',
        'Jumlah Sitasi',
        'Tahun',
    ],
], NULL, 'A1');
$sitasiKaryaDosen = $data->sitasi_karya_dosen->map(function ($item) {
    return [
        $item->nama_dosen ?? '-' ,
        $item->judul_artikel ?? '-',
        $item->jumlah_sitasi ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();
$sheet16->fromArray($sitasiKaryaDosen, NULL, 'A2');
// AutoSize dan WrapText Sheet 16
foreach (range('A', 'L') as $col) {
    $sheet16->getColumnDimension($col)->setAutoSize(true);
}
$sheet16->getStyle('A1:L' . (count($sitasiKaryaDosen) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet16->getStyle('A1:L' . (count($sitasiKaryaDosen) + 1))
    ->getAlignment()
    ->setWrapText(true);
    // Sheet 17: HKI Paten Dosen
$sheet17 = $spreadsheet->createSheet();
$sheet17->setTitle('HKI Paten Dosen');
$sheet17->fromArray([
    [
        'Luaran Penelitian',
        '',
        'Tahun',
        'Keterangan'
    ],
    [
        'I',
        'HKI: a) Paten, b) Paten Sederhana',
        '',
        ''
    ],
], NULL, 'A1');
// Merge Cells header Sheet 41
$sheet17->mergeCells('A1:B1');
$sheet17->mergeCells('C1:C2');
$sheet17->mergeCells('D1:D2');
$hkiPatenDosen = $data->hki_paten_dosen->map(function ($item) {
    return [
        '',
        $item->luaran_penelitian ?? '-' ,
        $item->tahun ?? '-',
        $item->keterangan ?? '-',
    ];
})->toArray();
$sheet17->fromArray($hkiPatenDosen, NULL, 'A3');
// AutoSize dan WrapText Sheet 17
foreach (range('A', 'L') as $col) {
    $sheet17->getColumnDimension($col)->setAutoSize(true);
}
$sheet17->getStyle('A1:L' . (count($hkiPatenDosen) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet17->getStyle('A1:L' . (count($hkiPatenDosen) + 2))
    ->getAlignment()
    ->setWrapText(true);
    // Sheet 18: HKI Cipta Dosen
$sheet18 = $spreadsheet->createSheet();
$sheet18->setTitle('HKI HakCipta Dosen');
$sheet18->fromArray([
    [
        'Luaran Penelitian',
        '',
        'Tahun',
        'Keterangan'
    ],
    [
        'II',
        'HKI: a) Hak Cipta, b) Desain Produk Industri, c) Perlindungan Varietas Tanaman (Sertifikat Perlindungan
                        Varietas Tanaman, Sertifikat Pelepasan Varietas, Sertifikat Pendaftaran Varietas), d) Desain Tata Letak
                        Sirkuit Terpadu, e) dll.)',
        '',
        ''
    ],
], NULL, 'A1');
// Merge Cells header Sheet 41
$sheet18->mergeCells('A1:B1');
$sheet18->mergeCells('C1:C2');
$sheet18->mergeCells('D1:D2');
$hkiCiptaDosen = $data->hki_cipta_dosen->map(function ($item) {
    return [
        '',
        $item->luaran_penelitian ?? '-' ,
        $item->tahun ?? '-',
        $item->keterangan ?? '-',
    ];
})->toArray();
$sheet18->fromArray($hkiCiptaDosen, NULL, 'A3');
// AutoSize dan WrapText Sheet 18
foreach (range('A', 'L') as $col) {
    $sheet18->getColumnDimension($col)->setAutoSize(true);
}
$sheet18->getStyle('A1:L' . (count($hkiCiptaDosen) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet18->getStyle('A1:L' . (count($hkiCiptaDosen) + 2))
    ->getAlignment()
    ->setWrapText(true);
    // Sheet 19: Teknologi Karya Dosen
$sheet19 = $spreadsheet->createSheet();
$sheet19->setTitle('Teknologi Karya Dosen');
$sheet19->fromArray([
    [
        'Luaran Penelitian',
        '',
        'Tahun',
        'Keterangan'
    ],
    [
        'III',
        'Teknologi Tepat Guna, Produk (Produk Terstandarisasi, Produk Tersertifikasi), Karya Seni, Rekayasa Sosial',
        '',
        ''
    ],
], NULL, 'A1');
// Merge Cells header Sheet 41
$sheet19->mergeCells('A1:B1');
$sheet19->mergeCells('C1:C2');
$sheet19->mergeCells('D1:D2');
$teknologiKaryaDosen = $data->teknologi_karya_dosen->map(function ($item) {
    return [
        '',
        $item->luaran_penelitian ?? '-' ,
        $item->tahun ?? '-',
        $item->keterangan ?? '-',
    ];
})->toArray();
$sheet19->fromArray($teknologiKaryaDosen, NULL, 'A3');
// AutoSize dan WrapText Sheet 19
foreach (range('A', 'L') as $col) {
    $sheet19->getColumnDimension($col)->setAutoSize(true);
}
$sheet19->getStyle('A1:L' . (count($teknologiKaryaDosen) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet19->getStyle('A1:L' . (count($teknologiKaryaDosen) + 2))
    ->getAlignment()
    ->setWrapText(true);
    // Sheet 20: Buku Chapter Dosen
$sheet20 = $spreadsheet->createSheet();
$sheet20->setTitle('Buku Chapter Dosen');
$sheet20->fromArray([
    [
        'Luaran Penelitian',
        '',
        'Tahun',
        'Keterangan'
    ],
    [
        'IV',
        'Buku ber-ISBN, Book Chapter',
        '',
        ''
    ],
], NULL, 'A1');
// Merge Cells header Sheet 41
$sheet20->mergeCells('A1:B1');
$sheet20->mergeCells('C1:C2');
$sheet20->mergeCells('D1:D2');
$bukuChapterDosen = $data->buku_chapter_dosen->map(function ($item) {
    return [
        '-',
        $item->luaran_penelitian ?? '-' ,
        $item->tahun ?? '-',
        $item->keterangan ?? '-',
    ];
})->toArray();
$sheet20->fromArray($bukuChapterDosen, NULL, 'A3');
// AutoSize dan WrapText Sheet 20
foreach (range('A', 'L') as $col) {
    $sheet20->getColumnDimension($col)->setAutoSize(true);
}
$sheet20->getStyle('A1:L' . (count($bukuChapterDosen) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet20->getStyle('A1:L' . (count($bukuChapterDosen) + 2))
    ->getAlignment()
    ->setWrapText(true);
    // Sheet 21: IPK Lulusan
$sheet21 = $spreadsheet->createSheet();
$sheet21->setTitle('IPK Lulusan');
$sheet21->fromArray([
    [
        'Tahun Ajaran',
        'Jumlah Lulusan',
        'Indeks Prestasi Kumulatif',
        '',
        ''
    ],
    [
        '',
        '',
        'Min',
        'Rata-rata',
        'Max'
    ],
], NULL, 'A1');
$ipkLulusan = $data->ipk_lulusan->map(function ($item) {
    return [
        $item->tahun ?? '-',
        $item->jumlah_lulusan ?? '-',
        $item->ipk_minimal ?? '-',
        $item->ipk_rata_rata ?? '-',
        $item->ipk_maksimal ?? '-',
    ];
})->toArray();
$sheet21->fromArray($ipkLulusan, NULL, 'A3');
// Merge Cells header Sheet 21
$sheet21->mergeCells('A1:A2');
$sheet21->mergeCells('B1:B2');
$sheet21->mergeCells('C1:E1');
$sheet21->mergeCells('F1:F2');
$sheet21->mergeCells('G1:G2');
// AutoSize dan WrapText Sheet 21
foreach (range('A', 'L') as $col) {
    $sheet21->getColumnDimension($col)->setAutoSize(true);
}
$sheet21->getStyle('A1:L' . (count($ipkLulusan) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet21->getStyle('A1:L' . (count($ipkLulusan) + 2))
    ->getAlignment()
    ->setWrapText(true);
// Sheet 22: Masa Studi Lulusan
$sheet22 = $spreadsheet->createSheet();
$sheet22->setTitle('Masa Studi Lulusan');
$sheet22->fromArray([
    [
        'Masa Studi',
        'Tahun Masuk',
        'Jumlah Mahasiswa Diterima',
        'Jumlah Mahasiswa yang Lulus Pada Akhir TS',
        '',
        '',
        '',
        '',
        '',
        '',
        'Jumlah Lulusan s.d Akhir TS',
        'Rata-rata Masa Studi'
    ],
    [
        '',
        '',
        '',
        'Akhir TS-6',
        'Akhir TS-5',
        'Akhir TS-4',
        'Akhir TS-3',
        'Akhir TS-2',
        'Akhir TS-1',
        'Akhir TS',
        '',
        ''
    ],
], NULL, 'A1');
$masaStudiLulusan = $data->masa_studi_lulusan->map(function ($item) {
    return [
        $item->masa_studi ?? '-',
        $item->tahun ?? '-',
        $item->jumlah_mhs_diterima ?? '-',
        $item->jumlah_mhs_lulus_akhir_ts6 ?? '-',
        $item->jumlah_mhs_lulus_akhir_ts5 ?? '-',
        $item->jumlah_mhs_lulus_akhir_ts4 ?? '-',
        $item->jumlah_mhs_lulus_akhir_ts3 ?? '-',
        $item->jumlah_mhs_lulus_akhir_ts2 ?? '-',
        $item->jumlah_mhs_lulus_akhir_ts1 ?? '-',
        $item->jumlah_mhs_lulus_akhir_ts ?? '-',
        $item->jumlah_lulusan_sampai_akhir_ts ?? '-',
        $item->rata_rata_masa_studi ?? '-',
    ];
})->toArray();
$sheet22->fromArray($masaStudiLulusan, NULL, 'A3');
// Merge Cells header Sheet 22
$sheet22->mergeCells('A1:A2');
$sheet22->mergeCells('B1:B2');
$sheet22->mergeCells('C1:C2');
$sheet22->mergeCells('D1:J1');
$sheet22->mergeCells('K1:K2');
$sheet22->mergeCells('L1:L2');
// AutoSize dan WrapText Sheet 22
foreach (range('A', 'M') as $col) {
    $sheet22->getColumnDimension($col)->setAutoSize(true);
}
$sheet22->getStyle('A1:M' . (count($masaStudiLulusan) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet22->getStyle('A1:M' . (count($masaStudiLulusan) + 2))
    ->getAlignment()
    ->setWrapText(true);
// Sheet 23: Prestasi Akademik
$sheet23 = $spreadsheet->createSheet();
$sheet23->setTitle('Prestasi Akademik');
$sheet23->fromArray([
    [
        'Nama Kegiatan',
        'Tingkat',
        '',
        '',
        'Prestasi yang Dicapai',
        'Tahun'
    ],
    [
        '',
        'Lokal/Wilayah',
        'Nasional',
        'Internasional',
        '',
        ''
    ],
], NULL, 'A1');
// Merge Cells header Sheet 23
$sheet23->mergeCells('A1:A2');
$sheet23->mergeCells('B1:D1');
$sheet23->mergeCells('E1:E2');
$sheet23->mergeCells('F1:F2');
$prestasiAkademik = $data->prestasi_akademik->map(function ($item) {
    return [
        $item->nama_kegiatan ?? '-',
        $item->tingkat == 'lokal' ? '✓' : '-',
        $item->tingkat == 'nasional' ? '✓' : '-',
        $item->tingkat == 'internasional' ? '✓' : '-',
        $item->prestasi ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();
$sheet23->fromArray($prestasiAkademik, NULL, 'A3');
// AutoSize dan WrapText Sheet 23
foreach (range('A', 'F') as $col) {
    $sheet23->getColumnDimension($col)->setAutoSize(true);
}
$sheet23->getStyle('A1:L' . (count($prestasiAkademik) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet23->getStyle('A1:L' . (count($prestasiAkademik) + 2))
    ->getAlignment()
    ->setWrapText(true);
// Sheet 24: Prestasi Non Akademik
$sheet24 = $spreadsheet->createSheet();
$sheet24->setTitle('Prestasi Non Akademik');
$sheet24->fromArray([
    [
        'Nama Kegiatan',
        'Tingkat',
        '',
        '',
        'Prestasi yang Dicapai',
        'Tahun'
    ],
    [
        '',
        'Lokal/Wilayah',
        'Nasional',
        'Internasional',
        '',
        ''
    ],
], NULL, 'A1');
// Merge Cells header Sheet 24
$sheet24->mergeCells('A1:A2');
$sheet24->mergeCells('B1:D1');
$sheet24->mergeCells('E1:E2');
$sheet24->mergeCells('F1:F2');
$prestasiNonAkademik = $data->prestasi_nonakademik->map(function ($item) {
    return [
        $item->nama_kegiatan ?? '-',
        $item->tingkat == 'lokal' ? '✓' : '-',
        $item->tingkat == 'nasional' ? '✓' : '-',
        $item->tingkat == 'internasional' ? '✓' : '-',
        $item->prestasi ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();
$sheet24->fromArray($prestasiNonAkademik, NULL, 'A3');
// AutoSize dan WrapText Sheet 24
foreach (range('A', 'F') as $col) {
    $sheet24->getColumnDimension($col)->setAutoSize(true);
}
$sheet24->getStyle('A1:L' . (count($prestasiNonAkademik) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet24->getStyle('A1:L' . (count($prestasiNonAkademik) + 2))
    ->getAlignment()
    ->setWrapText(true);
// Sheet 25: Evaluasi Kepuasan Pengguna
$sheet25 = $spreadsheet->createSheet();
$sheet25->setTitle('Evaluasi Kepuasan Pengguna');
$sheet25->fromArray([
    [
        'Tahun Lulus',
        'Jumlah Lulusan',
        'Jumlah Tanggapan Kepuasan Pengguna yang Terlacak',
        'Jenis Kemampuan',
        'Tingkat Kepuasan Pengguna (%)',
        '',
        '',
        '',
        'Rencana Tindak Lanjut Oleh UPPS/PS'
    ],
    [
        '',
        '',
        '',
        '',
        'Sangat Baik',
        'Baik',
        'Cukup',
        'Kurang',
        ''
    ],
], NULL, 'A1');
$evaluasiKepuasanPengguna = $data->eval_kepuasan_pengguna->map(function ($item) {
    return [
        $item->tahun ?? '-',
        $item->jumlah_lulusan ?? '-',
        $item->jumlah_responden ?? '-',
        $item->jenis_kemampuan ?? '-',
        $item->tingkat_kepuasan_sangat_baik ?? '-',
        $item->tingkat_kepuasan_baik ?? '-',
        $item->tingkat_kepuasan_cukup ?? '-',
        $item->tingkat_kepuasan_kurang ?? '-',
        $item->rencana_tindakan ?? '-',
    ];
})->toArray();
$sheet25->fromArray($evaluasiKepuasanPengguna, NULL, 'A3');
// Merge Cells header Sheet 25
$sheet25->mergeCells('A1:A2');
$sheet25->mergeCells('B1:B2');
$sheet25->mergeCells('C1:C2');
$sheet25->mergeCells('D1:D2');
$sheet25->mergeCells('E1:H1');
$sheet25->mergeCells('I1:I2');
$sheet25->mergeCells('J1:J2');
$sheet25->mergeCells('K1:K2');
$sheet25->mergeCells('L1:L2');
// AutoSize dan WrapText Sheet 25
foreach (range('A', 'L') as $col) {
    $sheet25->getColumnDimension($col)->setAutoSize(true);
}
$sheet25->getStyle('A1:L' . (count($evaluasiKepuasanPengguna) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet25->getStyle('A1:L' . (count($evaluasiKepuasanPengguna) + 2))
    ->getAlignment()
    ->setWrapText(true);
    $sheet26 = $spreadsheet->createSheet();
    $sheet26->setTitle('Evaluasi Kesesuaian Kerja');

    // Header 2 baris
    $sheet26->fromArray([
        [
            'Tahun Lulus',
            'Jumlah Lulusan',
            'Jumlah Lulusan yang Terlacak',
            'Jumlah Lulusan yang Terlacak dengan Tingkat Kesesuaian Bidang Kerja'
        ],
    ], NULL, 'A1');

    // Map data
    $evaluasiKesesuaianKerja = $data->eval_kesesuaian_kerja->map(function ($item) {
        return [
            $item->tahun ?? '-',
            $item->jumlah_lulusan ?? '-',
            $item->jumlah_lulusan_terlacak ?? '-',
            $item->jumlah_lulusan_bekerja ?? '-',
        ];
    })->toArray();

    // Masukkan data ke sheet
    $sheet26->fromArray($evaluasiKesesuaianKerja, NULL, 'A3');

    // Merge header
    $sheet26->mergeCells('A1:A2');
    $sheet26->mergeCells('B1:B2');
    $sheet26->mergeCells('C1:C2');
    $sheet26->mergeCells('D1:F1');

    // AutoSize dan WrapText
    foreach (range('A', 'F') as $col) {
        $sheet26->getColumnDimension($col)->setAutoSize(true);
    }
    $sheet26->getStyle('A1:F' . (count($evaluasiKesesuaianKerja) + 2))
        ->getNumberFormat()
        ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
    $sheet26->getStyle('A1:F' . (count($evaluasiKesesuaianKerja) + 2))
        ->getAlignment()
        ->setWrapText(true);
    // Sheet 27: Evaluasi Tempat Kerja
$sheet27 = $spreadsheet->createSheet();
$sheet27->setTitle('Evaluasi Tempat Kerja');
$sheet27->fromArray([
    [
        'Tahun Lulus',
        'Jumlah Lulusan',
        'Jumlah Lulusan yang Terlacak',
        'Jumlah Lulusan yang Terlacak dengan Tingkat/Ukuran Tempat Kerja/Berwirausaha',
        '',
        ''
    ],
    [
        '',
        '',
        '',
        'Lokal/ Wilayah/ Berwirausaha tidak Berbadan Hukum',
        'Nasional/ Berwirausaha berbadan Hukum',
        'Multinasional/ Internasional'
    ],
], NULL, 'A1');
// Merge Cells header Sheet 27
$sheet27->mergeCells('A1:A2');
$sheet27->mergeCells('B1:B2');
$sheet27->mergeCells('C1:C2');
$sheet27->mergeCells('D1:F1');
$evaluasiTempatKerja = $data->eval_tempat_kerja->map(function ($item) {
    return [
        $item->tahun ?? '-',
        $item->jumlah_lulusan ?? '-',
        $item->jumlah_lulusan_terlacak ?? '-',
        $item->jumlah_lulusan_bekerja_lokal == 'lokal' ? '✓' : '-',
        $item->jumlah_lulusan_bekerja_nasional == 'nasional' ? '✓' : '-',
        $item->jumlah_lulusan_bekerja_internasional == 'internasional' ? '✓' : '-',
    ];
})->toArray();
$sheet27->fromArray($evaluasiTempatKerja, NULL, 'A3');
// AutoSize dan WrapText Sheet 27
foreach (range('A', 'L') as $col) {
    $sheet27->getColumnDimension($col)->setAutoSize(true);
}
$sheet27->getStyle('A1:F' . (count($evaluasiTempatKerja) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet27->getStyle('A1:F' . (count($evaluasiTempatKerja) + 2))
    ->getAlignment()
    ->setWrapText(true);
        // Sheet 28: Evaluasi Waktu Tunggu
$sheet28 = $spreadsheet->createSheet();
$sheet28->setTitle('Evaluasi Waktu Tunggu');
$sheet28->fromArray([
    [
        'Masa Studi',
        'Tahun Lulus',
        'Jumlah Lulusan',
        'Jumlah Lulusan yang Terlacak',
        'Jumlah Lulusan yang Terlacak Dipesan',
        'Jumlah Lulusan yang Terlacak dengan Waktu Tunggu',
        '',
        ''
    ],
    [
        '',
        '',
        '',
        '',
        '',
        'WT < 3 Bulan',
        '3 Bulan < WT < 6 Bulan',
        'WT > 6 Bulan'
    ],
], NULL, 'A1');
// Merge Cells header Sheet 28
$sheet28->mergeCells('A1:A2');
$sheet28->mergeCells('B1:B2');
$sheet28->mergeCells('C1:C2');
$sheet28->mergeCells('D1:D2');
$sheet28->mergeCells('E1:E2');
$sheet28->mergeCells('F1:H1');
$evaluasiWaktuTunggu = $data->eval_waktu_tunggu->map(function ($item) {
    return [
        $item->masa_studi ?? '-',
        $item->tahun ?? '-',
        $item->jumlah_lulusan ?? '-',
        $item->jumlah_lulusan_terlacak ?? '-',
        $item->jumlah_lulusan_terlacak_dipesan ?? '-',
        $item->jumlah_lulusan_waktu_tiga_bulan ? '✓' : '-',
        $item->jumlah_lulusan_waktu_enam_bulan ? '✓' : '-',
        $item->jumlah_lulusan_waktu_sembilan_bulan ? '✓' : '-',
    ];
})->toArray();
$sheet28->fromArray($evaluasiWaktuTunggu, NULL, 'A3');
// AutoSize dan WrapText Sheet 28
foreach (range('A', 'L') as $col) {
    $sheet28->getColumnDimension($col)->setAutoSize(true);
}
$sheet28->getStyle('A1:G' . (count($evaluasiWaktuTunggu) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet28->getStyle('A1:G' . (count($evaluasiWaktuTunggu) + 2))
    ->getAlignment()
    ->setWrapText(true);
        // Sheet 29: Integrasi Penelitian
$sheet29 = $spreadsheet->createSheet();
$sheet29->setTitle('Integrasi Penelitian');
$sheet29->fromArray([
    [
        'Nama Dosen',
        'Judul Penelitian',
        'Mata Kuliah',
        'Bidang Keahlian',
        'Tahun'
    ],
], NULL, 'A1');
$integrasiPenelitian = $data->integrasi_penelitian->map(function ($item) {
    return [
        $item->nama_dosen ?? '-' ,
        $item->judul_penelitian ?? '-',
        $item->mata_kuliah ?? '-',
        $item->bidang_keahlian ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();
$sheet29->fromArray($integrasiPenelitian, NULL, 'A2');
// AutoSize dan WrapText Sheet 29
foreach (range('A', 'E') as $col) {
    $sheet29->getColumnDimension($col)->setAutoSize(true);
}
$sheet29->getStyle('A1:E' . (count($integrasiPenelitian) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet29->getStyle('A1:E' . (count($integrasiPenelitian) + 1))
    ->getAlignment()
    ->setWrapText(true);
        // Sheet 30: Kepuasan Mahasiswa
$sheet30 = $spreadsheet->createSheet();
$sheet30->setTitle('Kepuasan Mahasiswa');
$sheet30->fromArray([
    [
        'Aspek yang Diukur',
        'Tingkat Kepuasan Mahasiswa (%)',
        '',
        '',
        '',
        'Rencana Tindak Lanjut oleh UPPS/PS',
        'Tahun'
    ],
    [
        '',
        'Sangat Baik',
        'Baik',
        'Cukup',
        'Kurang',
        '',
        ''
    ],
], NULL, 'A1');
// Merge Cells header Sheet 30
$sheet30->mergeCells('A1:A2');
$sheet30->mergeCells('B1:E1');
$sheet30->mergeCells('F1:F2');
$sheet30->mergeCells('G1:G2');
$kepuasanMahasiswa = $data->kepuasan_mahasiswa->map(function ($item) {
    return [
        $item->aspek ?? '-',
        $item->tingkat_kepuasan_sangat_baik ?? '-',
        $item->tingkat_kepuasan_baik ?? '-',
        $item->tingkat_kepuasan_cukup ?? '-',
        $item->tingkat_kepuasan_kurang ?? '-',
        $item->rencana_tindakan ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();
$sheet30->fromArray($kepuasanMahasiswa, NULL, 'A3');
// AutoSize dan WrapText Sheet 30
foreach (range('A', 'G') as $col) {
    $sheet30->getColumnDimension($col)->setAutoSize(true);
}
$sheet30->getStyle('A1:G' . (count($kepuasanMahasiswa) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet30->getStyle('A1:G' . (count($kepuasanMahasiswa) + 2))
    ->getAlignment()
    ->setWrapText(true);
        // Sheet 31: Kurikulum Pembelajaran
$sheet31 = $spreadsheet->createSheet();
$sheet31->setTitle('Kurikulum Pembelajaran');
$sheet31->fromArray([
    [
        'Semester',
        'Mata Kuliah',
        'Kode Mata Kuliah',
        'Mata Kuliah Kompetensi',
        'Bobot Kredit (SKS)',
        '',
        '',
        'Konversi Kredit ke Jam',
        'Capaian Pembelajaran',
        '',
        '',
        '',
        'Metode Pembelajaran',
        'Dokumen Rencana Pembelajaran',
        'Unit Penyelenggara',
        'Tahun'
    ],
    [
        '',
        '',
        '',
        '',
        'Kuliah/ Responsi/ Tutorial',
        'Seminar',
        'Praktikum Praktik/ Praktik Lapangan',
        '',
        'Sikap',
        'Pengetahuan',
        'Keterampilan Umum',
        'Keterampilan Khusus',
        '',
        '',
        ''
    ],
], NULL, 'A1');
// Merge Cells header Sheet 31
$sheet31->mergeCells('A1:A2');
$sheet31->mergeCells('B1:B2');
$sheet31->mergeCells('C1:C2');
$sheet31->mergeCells('D1:D2');
$sheet31->mergeCells('E1:G1');
$sheet31->mergeCells('H1:H2');
$sheet31->mergeCells('I1:L1');
$sheet31->mergeCells('M1:M2');
$sheet31->mergeCells('N1:N2');
$sheet31->mergeCells('O1:O2');
$sheet31->mergeCells('P1:P2');
$kurikulumPembelajaran = $data->kurikulum_pembelajaran->map(function ($item) {
    return [
        $item->semester ?? '-',
        $item->nama_mata_kuliah ?? '-',
        $item->kode_mata_kuliah ?? '-',
        $item->mata_kuliah_kompetensi ? '✓' : '-',
        $item->sks_kuliah ?? '-',
        $item->sks_seminar ?? '-',
        $item->sks_praktikum ?? '-',
        $item->konversi_sks ?? '-',
        $item->capaian_kuliah_sikap ? '✓' : '-',
        $item->capaian_kuliah_pengetahuan ? '✓' : '-',
        $item->capaian_kuliah_keterampilan_umum ? '✓' : '-',
        $item->capaian_kuliah_keterampilan_khusus ? '✓' : '-',
        $item->metode_pembelajaran ?? '-',
        $item->dokumen ?? '-',
        $item->unit_penyelenggara ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();
$sheet31->fromArray($kurikulumPembelajaran, NULL, 'A3');
// AutoSize dan WrapText Sheet 31
foreach (range('A', 'P') as $col) {
    $sheet31->getColumnDimension($col)->setAutoSize(true);
}
$sheet31->getStyle('A1:P' . (count($kurikulumPembelajaran) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet31->getStyle('A1:P' . (count($kurikulumPembelajaran) + 2))
    ->getAlignment()
    ->setWrapText(true);
        // Sheet 32: Penelitian Mahasiswa
$sheet32 = $spreadsheet->createSheet();
$sheet32->setTitle('Penelitian Mahasiswa');
$sheet32->fromArray([
    [
        'Nama Mahasiswa',
        'Nama Dosen Pembimbing',
        'Tema Penelitian Sesuai Roadmap',
        'Judul Kegiatan',
        'Tahun'
    ],
], NULL, 'A1');
$penelitianMahasiswa = $data->penelitian_mahasiswa->map(function ($item) {
    return [
        $item->nama_mahasiswa ?? '-',
        $item->nama_dosen ?? '-',
        $item->tema_penelitian ?? '-',
        $item->judul_kegiatan ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();
$sheet32->fromArray($penelitianMahasiswa, NULL, 'A2');
// AutoSize dan WrapText Sheet 32
foreach (range('A', 'F') as $col) {
    $sheet32->getColumnDimension($col)->setAutoSize(true);
}
$sheet32->getStyle('A1:F' . (count($penelitianMahasiswa) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet32->getStyle('A1:F' . (count($penelitianMahasiswa) + 1))
    ->getAlignment()
    ->setWrapText(true);
        // Sheet 33: Rujukan Tesis Mahasiswa
$sheet33 = $spreadsheet->createSheet();
$sheet33->setTitle('Rujukan Tesis Mahasiswa');
$sheet33->fromArray([
    [
        'Nama Mahasiswa',
        'Judul Tesis',
        'Tema Penelitian Sesuai Roadmap',
        'Nama Dosen Pembimbing',
        'Tahun'
    ],
], NULL, 'A1');
$rujukanTesisMahasiswa = $data->rujukan_tesis_mahasiswa->map(function ($item) {
    return [
        $item->nama_mahasiswa ?? '-',
        $item->judul ?? '-',
        $item->tema_penelitian ?? '-',
        $item->nama_dosen ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();
$sheet33->fromArray($rujukanTesisMahasiswa, NULL, 'A2');
// AutoSize dan WrapText Sheet 33
foreach (range('A', 'F') as $col) {
    $sheet33->getColumnDimension($col)->setAutoSize(true);
}
$sheet33->getStyle('A1:F' . (count($rujukanTesisMahasiswa) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet33->getStyle('A1:F' . (count($rujukanTesisMahasiswa) + 1))
    ->getAlignment()
    ->setWrapText(true);
        // Sheet 34: PKM Dtps Mahasiswa
$sheet34 = $spreadsheet->createSheet();
$sheet34->setTitle('PKM Dtps Mahasiswa');
$sheet34->fromArray([
    [
        'Nama Mahasiswa',
        'Judul Kegiatan',
        'Tema Penelitian Sesuai Roadmap',
        'Tahun'
    ],
], NULL, 'A1');
$pkmDtpsMahasiswa = $data->pkm_dtps_mahasiswa->map(function ($item) {
    return [
        $item->nama_mhs ?? '-',
        $item->judul ?? '-',
        $item->tema ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();
$sheet34->fromArray($pkmDtpsMahasiswa, NULL, 'A2');
// AutoSize dan WrapText Sheet 34
foreach (range('A', 'D') as $col) {
    $sheet34->getColumnDimension($col)->setAutoSize(true);
}
$sheet34->getStyle('A1:D' . (count($pkmDtpsMahasiswa) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet34->getStyle('A1:D' . (count($pkmDtpsMahasiswa) + 1))
    ->getAlignment()
    ->setWrapText(true);
        // Sheet 35: Produk Jasa Mahasiswa
$sheet35 = $spreadsheet->createSheet();
$sheet35->setTitle('Produk Jasa Mahasiswa');
$sheet35->fromArray([
    [
        'Nama Mahasiswa',
        'Nama Produk/Jasa',
        'Deskripsi Produk/Jasa',
        'Bukti Dukungan',
        'Tahun'
    ],
], NULL, 'A1');
$produkJasaMahasiswa = $data->produk_jasa_mahasiswa->map(function ($item) {
    return [
        $item->nama_mahasiswa ?? '-',
        $item->nama_produk ?? '-',
        $item->deskripsi_produk ?? '-',
        $item->bukti ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();
$sheet35->fromArray($produkJasaMahasiswa, NULL, 'A2');
// AutoSize dan WrapText Sheet 35
foreach (range('A', 'E') as $col) {
    $sheet35->getColumnDimension($col)->setAutoSize(true);
}
$sheet35->getStyle('A1:E' . (count($produkJasaMahasiswa) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet35->getStyle('A1:E' . (count($produkJasaMahasiswa) + 1))
    ->getAlignment()
    ->setWrapText(true);
        // Sheet 36: Publikasi Mahasiswa
$sheet36 = $spreadsheet->createSheet();
$sheet36->setTitle('Publikasi Mahasiswa');
$sheet36->fromArray([
    [
        'Nama Mahasiswa',
        'Judul Artikel',
        'Jenis Publikasi',
        'Tahun'
    ],
], NULL, 'A1');
$publikasiMahasiswa = $data->publikasi_mahasiswa->map(function ($item) {
    return [
        $item->nama_mahasiswa ?? '-',
        $item->judul_artikel ?? '-',
        $item->jenis_artikel ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();
$sheet36->fromArray($publikasiMahasiswa, NULL, 'A2');
// AutoSize dan WrapText Sheet 36
foreach (range('A', 'E') as $col) {
    $sheet36->getColumnDimension($col)->setAutoSize(true);
}
$sheet36->getStyle('A1:E' . (count($publikasiMahasiswa) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet36->getStyle('A1:E' . (count($publikasiMahasiswa) + 1))
    ->getAlignment()
    ->setWrapText(true);
        // Sheet 37: Sitasi Karya Mahasiswa
$sheet37 = $spreadsheet->createSheet();
$sheet37->setTitle('Sitasi Karya Mahasiswa');
$sheet37->fromArray([
    [
        'Judul Karya',
        'Nama Mahasiswa',
        'Jumlah Sitasi',
        'Tahun'
    ],
], NULL, 'A1');
$sitasiKaryaMahasiswa = $data->sitasi_karya_mahasiswa->map(function ($item) {
    return [
        $item->judul_artikel ?? '-',
        $item->nama_mahasiswa ?? '-',
        $item->jumlah_sitasi ?? '-',
        $item->tahun ?? '-',
    ];
})->toArray();
$sheet37->fromArray($sitasiKaryaMahasiswa, NULL, 'A2');
// AutoSize dan WrapText Sheet 37
foreach (range('A', 'D') as $col) {
    $sheet37->getColumnDimension($col)->setAutoSize(true);
}
$sheet37->getStyle('A1:D' . (count($sitasiKaryaMahasiswa) + 1))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet37->getStyle('A1:D' . (count($sitasiKaryaMahasiswa) + 1))
    ->getAlignment()
    ->setWrapText(true);
        // Sheet 38: HKI (Paten) Mahasiswa
$sheet38 = $spreadsheet->createSheet();
$sheet38->setTitle('HKI Paten Mahasiswa');
$sheet38->fromArray([
    [
        'Luaran Penelitian',
        '',
        'Tahun',
        'Keterangan'
    ],
    [
        'I',
        'HKI: a) Paten, b) Paten Sederhana',
        '',
        ''
    ],
], NULL, 'A1');
// Merge Cells header Sheet 41
$sheet38->mergeCells('A1:B1');
$sheet38->mergeCells('C1:C2');
$sheet38->mergeCells('D1:D2');
$hkiMahasiswa = $data->hki_paten_mahasiswa->map(function ($item) {
    return [
        '',
        $item->luaran_penelitian ?? '-',
        $item->tahun ?? '-',
        $item->keterangan ?? '-',
    ];
})->toArray();
$sheet38->fromArray($hkiMahasiswa, NULL, 'A3');
// AutoSize dan WrapText Sheet 38
foreach (range('A', 'C') as $col) {
    $sheet38->getColumnDimension($col)->setAutoSize(true);
}
$sheet38->getStyle('A1:C' . (count($hkiMahasiswa) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet38->getStyle('A1:C' . (count($hkiMahasiswa) + 2))
    ->getAlignment()
    ->setWrapText(true);
        // Sheet 39: HKI (Hak Cipta) Mahasiswa
$sheet39 = $spreadsheet->createSheet();
$sheet39->setTitle('HKI HakCipta Mahasiswa');
$sheet39->fromArray([
    [
        'Luaran Penelitian',
        '',
        'Tahun',
        'Keterangan'
    ],
    [
        'II',
        'HKI: a) Hak Cipta, b) Desain Produk Industri, c) Perlindungan Varietas Tanaman (Sertifikat Perlindungan
                        Varietas Tanaman, Sertifikat Pelepasan Varietas, Sertifikat Pendaftaran Varietas), d) Desain Tata Letak
                        Sirkuit Terpadu, e) dll.)',
        '',
        ''
    ],
], NULL, 'A1');
// Merge Cells header Sheet 41
$sheet39->mergeCells('A1:B1');
$sheet39->mergeCells('C1:C2');
$sheet39->mergeCells('D1:D2');
$hkiHakCiptaMahasiswa = $data->hki_cipta_mahasiswa->map(function ($item) {
    return [
        '',
        $item->luaran_penelitian ?? '-',
        $item->tahun ?? '-',
        $item->keterangan ?? '-',
    ];
})->toArray();
$sheet39->fromArray($hkiHakCiptaMahasiswa, NULL, 'A3');
// AutoSize dan WrapText Sheet 39
foreach (range('A', 'C') as $col) {
    $sheet39->getColumnDimension($col)->setAutoSize(true);
}
$sheet39->getStyle('A1:C' . (count($hkiHakCiptaMahasiswa) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet39->getStyle('A1:C' . (count($hkiHakCiptaMahasiswa) + 2))
    ->getAlignment()
    ->setWrapText(true);
        // Sheet 40: Teknologi Karya Mahasiswa
$sheet40 = $spreadsheet->createSheet();
$sheet40->setTitle('Teknologi Karya Mahasiswa');
$sheet40->fromArray([
    [
        'Luaran Penelitian',
        '',
        'Tahun',
        'Keterangan'
    ],
    [
        'III',
        'Teknologi Tepat Guna, Produk (Produk Terstandarisasi, Produk Tersertifikasi), Karya Seni, Rekayasa Sosial',
        '',
        ''
    ],
], NULL, 'A1');
// Merge Cells header Sheet 41
$sheet40->mergeCells('A1:B1');
$sheet40->mergeCells('C1:C2');
$sheet40->mergeCells('D1:D2');
$teknologiKaryaMahasiswa = $data->teknologi_karya_mahasiswa->map(function ($item) {
    return [
        '',
        $item->luaran_penelitian ?? '-',
        $item->tahun ?? '-',
        $item->keterangan ?? '-',
    ];
})->toArray();
$sheet40->fromArray($teknologiKaryaMahasiswa, NULL, 'A3');
// AutoSize dan WrapText Sheet 40
foreach (range('A', 'C') as $col) {
    $sheet40->getColumnDimension($col)->setAutoSize(true);
}
$sheet40->getStyle('A1:C' . (count($teknologiKaryaMahasiswa) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet40->getStyle('A1:C' . (count($teknologiKaryaMahasiswa) + 2))
    ->getAlignment()
    ->setWrapText(true);
        // Sheet 41: Buku Chapter Mahasiswa
$sheet41 = $spreadsheet->createSheet();
$sheet41->setTitle('Buku Chapter Mahasiswa');
$sheet41->fromArray([
    [
        'Luaran Penelitian',
        '',
        'Tahun',
        'Keterangan'
    ],
    [
        'IV',
        'Buku ber-ISBN, Book Chapter',
        '',
        ''
    ],
], NULL, 'A1');
// Merge Cells header Sheet 41
$sheet41->mergeCells('A1:B1');
$sheet41->mergeCells('C1:C2');
$sheet41->mergeCells('D1:D2');
$bukuChapterMahasiswa = $data->buku_chapter_mahasiswa->map(function ($item) {
    return [
        '-',
        $item->luaran_penelitian ?? '-',
        $item->tahun ?? '-',
        $item->keterangan ?? '-',
    ];
})->toArray();
$sheet41->fromArray($bukuChapterMahasiswa, NULL, 'A3');
// AutoSize dan WrapText Sheet 41
foreach (range('A', 'C') as $col) {
    $sheet41->getColumnDimension($col)->setAutoSize(true);
}
$sheet41->getStyle('A1:C' . (count($bukuChapterMahasiswa) + 2))
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
$sheet41->getStyle('A1:C' . (count($bukuChapterMahasiswa) + 2))
    ->getAlignment()
    ->setWrapText(true);



        // Set sheet pertama sebagai default
        $spreadsheet->setActiveSheetIndex(0);

        // Menyimpan file Excel
        $filename = 'laporan-dosen-' . Str::slug($data->name) . '-' . time() . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Mengunduh file
        return response()->stream(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="laporan-dosen.xlsx"',
            'Cache-Control' => 'max-age=0',
        ]);

    } catch (\Exception $e) {
        return back()->withErrors($e->getMessage());
    }
}
public function importExcel(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv',
    ]);

    $filePath = $request->file('file')->store('temp');
    $fullPath = Storage::path($filePath);
    $spreadsheet = IOFactory::load($fullPath);

    $userId = auth()->id();

    foreach ($spreadsheet->getSheetNames() as $sheetIndex => $sheetName) {
        $sheet = $spreadsheet->getSheet($sheetIndex);
        $rows = $sheet->toArray();

        if (empty($rows)) continue;

        // Gabung header dari beberapa baris pertama
        $headerRows = [
            $rows[0] ?? [],
            $rows[1] ?? [],
            $rows[2] ?? [],
        ];

        $combinedHeaders = [];
        foreach ($headerRows[0] as $index => $header) {
            $fullHeaderParts = [];
            foreach ($headerRows as $row) {
                if (!empty($row[$index])) {
                    $fullHeaderParts[] = trim($row[$index]);
                }
            }
            $combinedHeaders[$index] = implode(' - ', $fullHeaderParts);
        }

        // Proses data mulai dari baris ke-3
        foreach ($rows as $index => $row) {
            if ($index < 3) continue; // Lewati baris 1-3 (header)

            if (empty(array_filter($row))) continue; // Skip baris kosong

            $rowData = array_combine($combinedHeaders, $row);

            if (!$rowData) continue; // Skip jika kombinasi gagal

            switch ($sheetName) {
                case 'Kerjasama Pendidikan':
                    $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;

                    \App\Models\KerjasamaTridharmaPendidikan::updateOrCreate(
                        [
                            'user_id' => $userId,
                            'judul_kegiatan' => $rowData['Judul Kerjasama'] ?? '-',
                        ],
                        [
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

                    \App\Models\KerjasamaTridharmaPenelitian::updateOrCreate(
                        [
                            'user_id' => $userId,
                            'judul_kegiatan' => $rowData['Judul Kerjasama'] ?? '-',
                        ],
                        [
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

                    \App\Models\KerjasamaTridharmaPengmas::updateOrCreate(
                        [
                            'user_id' => $userId,
                            'judul_kegiatan' => $rowData['Judul Kerjasama'] ?? '-',
                        ],
                        [
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

                    \App\Models\SeleksiMahasiswaBaru::updateOrCreate(
                        [
                            'user_id' => $userId,
                            'tahun_ajaran_id' => $tahunAjaranId,
                        ],
                        [
                            'tahun_akademik' => $rowData['Tahun Akademik'] ?? '-',
                            'daya_tampung' => $rowData['Daya Tampung'] ?? '-',
                            'pendaftar' => $rowData['Jumlah Calon Mahasiswa - Pendaftar'] ?? '-',
                            'lulus_seleksi' => $rowData['Jumlah Calon Mahasiswa - Lulus Seleksi'] ?? '-',
                            'maba_reguler' => $rowData['Jumlah Mahasiswa Baru - Reguler'] ?? '-',
                            'maba_transfer' => $rowData['Jumlah Mahasiswa Baru - Trfansfer'] ?? '-',
                            'mhs_aktif_reguler' => $rowData['Jumlah Mahasiswa Aktif - Reguler'] ?? '-',
                            'mhs_aktif_transfer' => $rowData['Jumlah Mahasiswa Aktif - Trfansfer'] ?? '-',
                            'user_id' => $userId,
                        ]
                    );
                    break;

                case 'Mahasiswa Asing':
                    $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;

                    \App\Models\MahasiswaAsing::updateOrCreate(
                        [
                            'user_id' => $userId,
                        ],
                        [
                            'tahun_akademik' => $rowData['Tahun Akademik'] ?? '-',
                            'mhs_aktif' => $rowData['Jumlah Mahasiswa Aktif'] ?? '-',
                            'mhs_asing_fulltime' => $rowData['Jumlah Mahasiswa Asing Penuh Waktu'] ?? '-',
                            'mhs_asing_parttime' => $rowData['Jumlah Mahasiswa Asing Paruh Waktu'] ?? '-',
                            'tahun_ajaran_id' => $tahunAjaranId,
                            'user_id' => $userId,
                        ]
                    );
                    break;
                    case 'Dosen Tetap':
                        $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;
                        $kesesuaianKompetensi = !empty(trim($rowData['Kesesuaian dengan Kompetensi Inti PS'] ?? '')) ? 1 : 0;;
$kesesuaianKeahlian = !empty(trim($rowData['Kesesuaian Bidang Keahlian dengan Mata Kuliah yang Diampu'] ?? '')) ? 1 : 0;;

                        \App\Models\DosenTetapPT::updateOrCreate(
                            [
                                'user_id' => $userId,
                            ],
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
                            if($rowData['Kesesuaian dengan Kompetensi Inti PS'] == '✓'){
                                $kesesuaianKompetensi = 1;
                            }
                            if($rowData['Kesesuaian Bidang Keahlian dengan Mata Kuliah yang Diampu'] == '✓'){
                                $kesesuaianKeahlian = 1;
                            }
                            \App\Models\DosenTidakTetap::updateOrCreate(
                                [
                                    'user_id' => $userId,
                                ],
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

                                \App\Models\DosenPembimbingTA::updateOrCreate(
                                    [
                                        'user_id' => $userId,
                                    ],
                                    [
                                        'nama_dosen' => $rowData['Nama Dosen'] ?? '-',
                                        'mhs_bimbingan_ps' => $rowData['Jumlah Mahasiswa yang Dibimbing - Pada PS'] ?? '-',
                                        'mhs_bimbingan_ps_lain' => $rowData['Jumlah Mahasiswa yang Dibimbing - Pada PS Lain'] ?? '-',
                                        'tahun_ajaran_id' => $tahunAjaranId,
                                        'user_id' => $userId,
                                    ]
                                );
                                break;
                                case 'Dosen EWMP Dosen':
                                    $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;
                                    if($rowData['DTPS'] == '✓'){
                                        $isDtps = 1;
                                    }
                                    \App\Models\EwmpDosen::updateOrCreate(
                                        [
                                            'user_id' => $userId,
                                        ],
                                        [
                                            'nama_dosen' => $rowData['Nama Dosen'] ?? '-',
                                            'is_dtps' => $isDtps ?? '-',
                                            'ps_diakreditasi' => $rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Pendidikan: Pembelajaran dan Pembimbingan - PS yang Diakreditasi'] ?? '-',
                                            'ps_lain_dalam_pt' => $rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Pendidikan: Pembelajaran dan Pembimbingan - PS Lain di dalam PT'] ?? '-',
                                            'ps_lain_luar_pt' => $rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Pendidikan: Pembelajaran dan Pembimbingan - PS Lain di luar PT'] ?? '-',
                                            'ps_diakreditasi' => $rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Penelitian'] ?? '-',
                                            'penelitian' => $rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - PkM'] ?? '-',
                                            'pkm' => $rowData['Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks) - Tugas Tambahan dan/atau Penunjang'] ?? '-',
                                            'tugas_tambahan' => $rowData['Jumlah (sks)'] ?? '-',
                                            'avg_per_semester' => $rowData['Rata-rata per Semester (sks)'] ?? '-',
                                            'tahun_ajaran_id' => $tahunAjaranId,
                                            'user_id' => $userId,
                                        ]
                                    );
                                    break;
                                case 'Dosen Industri Praktisi':
                                    $tahunAjaranId = optional(\App\Models\TahunAjaranSemester::where('tahun_ajaran', $rowData['Tahun Ajaran'] ?? '-')->first())->id;

                                    \App\Models\DosenIndustriPraktisi::updateOrCreate(
                                        [
                                            'user_id' => $userId,
                                        ],
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
if($rowData['Tingkat - Wilayah'] == '✓'){
    $tingkat = 'lokal';
}
if($rowData['Tingkat - Nasional'] == '✓'){
    $tingkat = 'nasional';
}
if($rowData['Tingkat - Internasional'] == '✓'){
    $tingkat = 'internasional';
}
                                        \App\Models\RekognisiDosen::updateOrCreate(
                                            [
                                                'user_id' => $userId,
                                            ],
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
                                            \App\Models\PenelitianDtps::updateOrCreate(
                                                [
                                                    'user_id' => $userId,
                                                ],
                                                [
                                                    'sumber_dana' => $sumberDana[$rowData['Sumber Pembiayaan']] ?? '-',
                                                    'jumlah_judul' => $rowData['Jumlah Judul Penelitian'] ?? '-',
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
                                                \App\Models\PkmDtps::updateOrCreate(
                                                    [
                                                        'user_id' => $userId,
                                                    ],
                                                    [
                                                        'sumber_dana' => $sumberDana[$rowData['Sumber Pembiayaan']] ?? '-',
                                                        'jumlah_judul' => $rowData['Jumlah Judul Penelitian'] ?? '-',
                                                        'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                    ]
                                                );
                                                break;
                                                case 'Produk Teradopsi Dosen':
                                                    \App\Models\ProdukTeradopsiDosen::updateOrCreate(
                                                        [
                                                            'user_id' => $userId,
                                                        ],
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
                                                        \App\Models\PublikasiIlmiahDosen::updateOrCreate(
                                                            [
                                                                'user_id' => $userId,
                                                            ],
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
                                                            \App\Models\SitasiKaryaDosen::updateOrCreate(
                                                                [
                                                                    'user_id' => $userId,
                                                                ],
                                                                [
                                                                    'nama_dosen' => $rowData['Nama Dosen'] ?? '-',
                                                                    'judul_artikel' => $rowData['Judul Artikel'] ?? '-',
                                                                    'jumlah_sitasi' => $rowData['Jumlah Sitasi'] ?? '-',
                                                                    'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                ]
                                                            );
                                                            break;
                                                            case 'HKI Paten Dosen':
                                                                \App\Models\HkiPatenDosen::updateOrCreate(
                                                                    [
                                                                        'user_id' => $userId,
                                                                    ],
                                                                    [
                                                                        'luaran_penelitian' => $rowData['Luaran Penelitian - HKI: a) Paten, b) Paten Sederhana'] ?? '-',
                                                                        'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                        'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                    ]
                                                                );
                                                                break;
                                                                case 'HKI HakCipta Dosen':
                                                                    \App\Models\HkiHakciptaDosen::updateOrCreate(
                                                                        [
                                                                            'user_id' => $userId,
                                                                        ],
                                                                        [
                                                                            'luaran_penelitian' => $rowData['Luaran Penelitian - HKI: a) Hak Cipta, b) Desain Produk Industri, c) Perlindungan Varietas Tanaman (Sertifikat Perlindungan'] ?? '-',
                                                                            'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                            'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                        ]
                                                                    );
                                                                    break;
                                                                    case 'Teknologi Karya Dosen':
                                                                        \App\Models\TeknologiKaryaDosen::updateOrCreate(
                                                                            [
                                                                                'user_id' => $userId,
                                                                            ],
                                                                            [
                                                                                'luaran_penelitian' => $rowData['Luaran Penelitian - Teknologi Tepat Guna, Produk (Produk Terstandarisasi, Produk Tersertifikasi), Karya Seni, Rekayasa Sosial'] ?? '-',
                                                                                'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                                'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                            ]
                                                                        );
                                                                        break;
                                                                        case 'Buku Chapter Dosen':
                                                                            \App\Models\BukuChapterDosen::updateOrCreate(
                                                                                [
                                                                                    'user_id' => $userId,
                                                                                ],
                                                                                [
                                                                                    'luaran_penelitian' => $rowData['Luaran Penelitian - Buku ber-ISBN, Book Chapter'] ?? '-',
                                                                                    'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                                    'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                                ]
                                                                            );
                                                                            break;
                                                                        case 'IPK Lulusan':
                                                                            \App\Models\IpkLulusan::updateOrCreate(
                                                                                [
                                                                                    'user_id' => $userId,
                                                                                ],
                                                                                [
                                                                                    'jumlah_lulusan' => $rowData['Jumlah Lulusan'] ?? '-',
                                                                                    'ipk_minimal' => $rowData['Indeks Prestasi Kumulatif - Min'] ?? '-',
                                                                                    'ipk_maksimal' => $rowData['Indeks Prestasi Kumulatif - Rata-rata'] ?? '-',
                                                                                    'ipk_rata_rata' => $rowData['Indeks Prestasi Kumulatif - Max'] ?? '-',
                                                                                    'tahun' => $rowData['Tahun Ajaran'] ?? '-',
                                                                                    'user_id' => $userId,
                                                                                ]
                                                                            );
                                                                            break;
                                                                        case 'Masa Studi Lulusan':
                                                                            \App\Models\MasaStudiLulusan::updateOrCreate(
                                                                                [
                                                                                    'user_id' => $userId,
                                                                                ],
                                                                                [
                                                                                    'masa_studi' => $rowData['Masa Studi'] ?? '-',
                                                                                    'jumlah_mhs_diterima' => $rowData['Jumlah Mahasiswa Diterima'] ?? '-',
                                                                                    'jumlah_mhs_lulus_akhir_ts' => $rowData['Jumlah Mahasiswa yang Lulus Pada Akhir TS - Akhir TS'] ?? '-',
                                                                                    'jumlah_mhs_lulus_akhir_ts_1' => $rowData['Jumlah Mahasiswa yang Lulus Pada Akhir TS - Akhir TS-1'] ?? '-',
                                                                                    'jumlah_mhs_lulus_akhir_ts_2' => $rowData['Jumlah Mahasiswa yang Lulus Pada Akhir TS - Akhir TS-2'] ?? '-',
                                                                                    'jumlah_mhs_lulus_akhir_ts_3' => $rowData['Jumlah Mahasiswa yang Lulus Pada Akhir TS - Akhir TS-3'] ?? '-',
                                                                                    'jumlah_mhs_lulus_akhir_ts_4' => $rowData['Jumlah Mahasiswa yang Lulus Pada Akhir TS - Akhir TS-4'] ?? '-',
                                                                                    'jumlah_mhs_lulus_akhir_ts_5' => $rowData['Jumlah Mahasiswa yang Lulus Pada Akhir TS - Akhir TS-5'] ?? '-',
                                                                                    'jumlah_mhs_lulus_akhir_ts_6' => $rowData['Jumlah Mahasiswa yang Lulus Pada Akhir TS - Akhir TS-6'] ?? '-',
                                                                                    'jumlah_lulusan' => $rowData['Jumlah Lulusan s.d Akhir TS'] ?? '-',
                                                                                    'mean_masa_studi' => $rowData['Rata-rata Masa Studi'] ?? '-',
                                                                                    'tahun' => $rowData['Tahun Masuk'] ?? '-',
                                                                                            'user_id' => $userId,
                                                                                ]
                                                                            );
                                                                            break;
                                                                        case 'Prestasi Akademik':
                                                                            $lokal=!empty(trim($rowData['Tingkat - Lokal/Wilayah'] ?? '')) ? 1 : 0;
                                                                                $nasional=!empty(trim($rowData['Tingkat - Nasional'] ?? '')) ? 1 : 0;
                                                                                $internasional=!empty(trim($rowData['Tingkat - Internasional'] ?? '')) ? 1 : 0;
                                                                                if($lokal == 1){
                                                                                    $tingkat = 'lokal';
                                                                                }else if($nasional==1){
                                                                                    $tingkat = 'nasional';
                                                                                }else if($internasional == 1){
                                                                                    $tingkat = 'internasional';
                                                                                }else{
                                                                                    $tingkat = '';
                                                                                }
                                                                            \App\Models\PrestasiAkademik::updateOrCreate(
                                                                                [
                                                                                    'user_id' => $userId,
                                                                                ],
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
                                                                                $lokal=!empty(trim($rowData['Tingkat - Lokal/Wilayah'] ?? '')) ? 1 : 0;
                                                                                $nasional=!empty(trim($rowData['Tingkat - Nasional'] ?? '')) ? 1 : 0;
                                                                                $internasional=!empty(trim($rowData['Tingkat - Internasional'] ?? '')) ? 1 : 0;
                                                                                if($lokal == 1){
                                                                                    $tingkat = 'lokal';
                                                                                }else if($nasional==1){
                                                                                    $tingkat = 'nasional';
                                                                                }else if($internasional == 1){
                                                                                    $tingkat = 'internasional';
                                                                                }else{
                                                                                    $tingkat = '';
                                                                                }
                                                                                \App\Models\PrestasiNonakademik::updateOrCreate(
                                                                                    [
                                                                                        'user_id' => $userId,
                                                                                    ],
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
                                                                                    \App\Models\EvalKepuasanPengguna::updateOrCreate(
                                                                                        [
                                                                                            'user_id' => $userId,
                                                                                        ],
                                                                                        [
                                                                                            'jenis_kemampuan' => $rowData['Jenis Kemampuan'] ?? '-',
                                                                                            'tingkat_kepuasan_sangat_baik' => $rowData['Tingkat Kepuasan Pengguna (%) - Sangat Baik'] ?? '-',
                                                                                            'tingkat_kepuasan_baik' => $rowData['Tingkat Kepuasan Pengguna (%) - Baik'] ?? '-',
                                                                                            'tingkat_kepuasan_cukup' => $rowData['Tingkat Kepuasan Pengguna (%) - Cukup'] ?? '-',
                                                                                            'tingkat_kepuasan_kurang' => $rowData['Tingkat Kepuasan Pengguna (%) - Kurang'] ?? '-',
                                                                                            'rencana_tindakan' => $rowData['Rencana Tindak Lanjut Oleh UPPS/PS'] ?? '-',
                                                                                            'jumlah_lulusan' => $rowData['Jumlah Lulusan'] ?? '-',
                                                                                            'jumlah_responden' => $rowData['Jumlah Tanggapan Kepuasan Pengguna yang Terlacak'] ?? '-',
                                                                                            'tahun' => $rowData['Tahun Lulus'] ?? '-',
                                                                                            'user_id' => $userId,
                                                                                        ]
                                                                                    );
                                                                                    break;
                                                                                case 'Evaluasi Kesesuaian Kerja':
                                                                                    \App\Models\EvalKesesuaianKerja::updateOrCreate(
                                                                                        [
                                                                                            'user_id' => $userId,
                                                                                        ],
                                                                                        [
                                                                                            'jumlah_lulusan' => $rowData['Jumlah Lulusan'] ?? '-',
                                                                                            'jumlah_lulusan_terlacak' => $rowData['Jumlah Lulusan yang Terlacak'] ?? '-',
                                                                                            'jumlah_lulusan_bekerja' => $rowData['Jumlah Lulusan yang Terlacak dengan Tingkat Kesesuaian Bidang Kerja'] ?? '-',
                                                                                            'tahun' => $rowData['Tahun Lulus'] ?? '-',
                                                                                            'user_id' => $userId,
                                                                                        ]
                                                                                    );
                                                                                    break;
                                                                                case 'Evaluasi Tempat Kerja':
                                                                                    \App\Models\EvalTempatKerja::updateOrCreate(
                                                                                        [
                                                                                            'user_id' => $userId,
                                                                                        ],
                                                                                        [
                                                                                            'jumlah_lulusan_terlacak' => $rowData['Jumlah Lulusan yang Terlacak'] ?? '-',
                                                                                            'jumlah_lulusan' => $rowData['Jumlah Lulusan'] ?? '-',
                                                                                            'jumlah_lulusan_bekerja_lokal' => $rowData['Jumlah Lulusan yang Terlacak dengan Tingkat/Ukuran Tempat Kerja/Berwirausaha - Lokal/ Wilayah/ Berwirausaha tidak Berbadan Hukum'] ?? '-',
                                                                                            'jumlah_lulusan_bekerja_nasional' => $rowData['Jumlah Lulusan yang Terlacak dengan Tingkat/Ukuran Tempat Kerja/Berwirausaha - Nasional/ Berwirausaha berbadan Hukum'] ?? '-',
                                                                                            'jumlah_lulusan_bekerja_internasional' => $rowData['Jumlah Lulusan yang Terlacak dengan Tingkat/Ukuran Tempat Kerja/Berwirausaha - Multinasional/ Internasional'] ?? '-',
                                                                                            'tahun' => $rowData['Tahun Lulus'] ?? '-',
                                                                                            'user_id' => $userId,
                                                                                        ]
                                                                                    );
                                                                                    break;
                                                                                case 'Evaluasi Waktu Tunggu':
                                                                                    \App\Models\EvalWaktuTunggu::updateOrCreate(
                                                                                        [
                                                                                            'user_id' => $userId,
                                                                                        ],
                                                                                        [
                                                                                            'masa_studi' => $rowData['Masa Studi'] ?? '-',
                                                                                            'jumlah_lulusan' => $rowData['Jumlah Lulusan'] ?? '-',
                                                                                            'jumlah_lulusan_terlacak' => $rowData['Jumlah Lulusan yang Terlacak'] ?? '-',
                                                                                            'jumlah_lulusan_terlacak_dipesan' => $rowData['Jumlah Lulusan yang Terlacak Dipesan'] ?? '-',
                                                                                            'jumlah_lulusan_waktu_tiga_bulan' => $rowData['Jumlah Lulusan yang Terlacak dengan Waktu Tunggu - WT < 3 Bulan'] ?? '-',
                                                                                            'jumlah_lulusan_waktu_enam_bulan' => $rowData['Jumlah Lulusan yang Terlacak dengan Waktu Tunggu - 3 Bulan < WT < 6 Bulan'] ?? '-',
                                                                                            'jumlah_lulusan_waktu_sembilan_bulan' => $rowData['Jumlah Lulusan yang Terlacak dengan Waktu Tunggu - WT > 6 Bulan'] ?? '-',
                                                                                            'tahun' => $rowData['Tahun Lulus'] ?? '-',
                                                                                            'user_id' => $userId,
                                                                                        ]
                                                                                    );
                                                                                    break;
                                                                                case 'Integrasi Penelitian':
                                                                                    \App\Models\IntegrasiPenelitian::updateOrCreate(
                                                                                        [
                                                                                            'user_id' => $userId,
                                                                                        ],
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
                                                                                    \App\Models\KepuasanMahasiswa::updateOrCreate(
                                                                                        [
                                                                                            'user_id' => $userId,
                                                                                        ],
                                                                                        [
                                                                                            'aspek_penilaian' => $rowData['Aspek yang Diukur'] ?? '-',
                                                                                            'tingkat_kepuasan_sangat_baik' => $rowData['Tingkat Kepuasan Mahasiswa (%) - Sangat Baik'] ?? '-',
                                                                                            'tingkat_kepuasan_baik' => $rowData['Tingkat Kepuasan Mahasiswa (%) - Baik'] ?? '-',
                                                                                            'tingkat_kepuasan_cukup' => $rowData['Tingkat Kepuasan Mahasiswa (%) - Cukup'] ?? '-',
                                                                                            'tingkat_kepuasan_kurang' => $rowData['Tingkat Kepuasan Mahasiswa (%) - Kurang'] ?? '-',
                                                                                            'rencana_tindakan' => $rowData['Rencana Tindak Lanjut oleh UPPS/PS'] ?? '-',
                                                                                            'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                'user_id' => $userId,
                                                                                        ]
                                                                                    );
                                                                                    break;
                                                                                    case 'Kurikulum Pembelajaran':
                                                                                        $kompetensi = !empty(trim($rowData['Mata Kuliah Kompetensi'] ?? '')) ? 1 : 0;
                                                                                        $sikap = !empty(trim($rowData['Capaian Pembelajaran - Sikap'] ?? '')) ? 1 : 0;
                                                                                        $pengetahuan = !empty(trim($rowData['Capaian Pembelajaran - Pengetahuan'] ?? '')) ? 1 : 0;
                                                                                        $keterampilanumum = !empty(trim($rowData['Capaian Pembelajaran - Keterampilan Umum'] ?? '')) ? 1 : 0;
                                                                                        $keterampilankhusus = !empty(trim($rowData['Capaian Pembelajaran - Keterampilan Khusus'] ?? '')) ? 1 : 0;


                                                                                        \App\Models\KurikulumPembelajaran::updateOrCreate(
                                                                                            [
                                                                                                'user_id' => $userId,
                                                                                            ],
                                                                                            [
                                                                                                'nama_mata_kuliah' => $rowData['Mata Kuliah'] ?? '-',
                                                                                                'kode_mata_kuliah' => $rowData['Kode Mata Kuliah'] ?? '-',
                                                                                                'mata_kuliah_kompetensi' => $kompetensi ?? '-',
                                                                                                'sks_kuliah' => $rowData['Bobot Kredit (SKS) - Kuliah/ Responsi/ Tutorial'] ?? '-',
                                                                                                'sks_seminar' => $rowData['Bobot Kredit (SKS) - Seminar'] ?? '-',
                                                                                                'sks_praktikum' => $rowData['Bobot Kredit (SKS) - Praktikum Praktik/ Praktik Lapangan'] ?? '-',
                                                                                                'konversi_sks' => $rowData['Konversi Kredit ke Jam'] ?? '-',
                                                                                                'semester' => $rowData['Semester'] ?? '-',
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
                                                                                            \App\Models\DtpsPenelitianMahasiswa::updateOrCreate(
                                                                                                [
                                                                                                    'user_id' => $userId,
                                                                                                ],
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
                                                                                                \App\Models\DtpsRujukanTesis::updateOrCreate(
                                                                                                    [
                                                                                                        'user_id' => $userId,
                                                                                                    ],
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
                                                                                                    \App\Models\PkmDtpsMahasiswa::updateOrCreate(
                                                                                                        [
                                                                                                            'user_id' => $userId,
                                                                                                        ],
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
                                                                                                        \App\Models\ProdukJasaMahasiswa::updateOrCreate(
                                                                                                            [
                                                                                                                'user_id' => $userId,
                                                                                                            ],
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
                                                                                                            \App\Models\PublikasiMahasiswa::updateOrCreate(
                                                                                                                [
                                                                                                                    'user_id' => $userId,
                                                                                                                ],
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
                                                                                                                \App\Models\SitasiKaryaMahasiswa::updateOrCreate(
                                                                                                                    [
                                                                                                                        'user_id' => $userId,
                                                                                                                    ],
                                                                                                                    [
                                                                                                                        'judul_artikel' => $rowData['Judul Artikel'] ?? '-',
                                                                                                                        'nama_mahasiswa' => $rowData['Nama Mahasiswa'] ?? '-',
                                                                                                                        'jumlah_sitasi' => $rowData['Jumlah Sitasi'] ?? '-',
                                                                                                                        'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                                            'user_id' => $userId,
                                                                                                                    ]
                                                                                                                );
                                                                                                                break;
                                                                                                                case 'HKI Paten Mahasiswa':
                                                                                                                    \App\Models\HkiPatenMahasiswa::updateOrCreate(
                                                                                                                        [
                                                                                                                            'user_id' => $userId,
                                                                                                                        ],
                                                                                                                        [
                                                                                                                            'luaran_penelitian' => $rowData['Luaran Penelitian - HKI: a) Paten, b) Paten Sederhana'] ?? '-',
                                                                                                                            'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                                                                            'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                                                                    'user_id' => $userId,
                                                                                                                        ]
                                                                                                                    );
                                                                                                                    break;
                                                                                                                    case 'HKI HakCipta Mahasiswa':
                                                                                                                        \App\Models\HkiHakCiptaMahasiswa::updateOrCreate(
                                                                                                                            [
                                                                                                                                'user_id' => $userId,
                                                                                                                            ],
                                                                                                                            [
                                                                                                                                'luaran_penelitian' => $rowData['Luaran Penelitian - HKI: a) Hak Cipta, b) Desain Produk Industri, c) Perlindungan Varietas Tanaman (Sertifikat Perlindungan'] ?? '-',
                                                                                                                                'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                                                                                'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                                                                    'user_id' => $userId,
                                                                                                                            ]
                                                                                                                        );
                                                                                                                        break;
                                                                                                                        case 'Teknologi Karya Mahasiswa':
                                                                                                                            \App\Models\TeknologiKaryaMahasiswa::updateOrCreate(
                                                                                                                                [
                                                                                                                                    'user_id' => $userId,
                                                                                                                                ],
                                                                                                                                [
                                                                                                                                    'luaran_penelitian' => $rowData['Luaran Penelitian - Teknologi Tepat Guna, Produk (Produk Terstandarisasi, Produk Tersertifikasi), Karya Seni, Rekayasa Sosial'] ?? '-',
                                                                                                                                    'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                                                                                    'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                                                                    'user_id' => $userId,
                                                                                                                                ]
                                                                                                                            );
                                                                                                                            break;
                                                                                                                            case 'Buku Chapter Mahasiswa':
                                                                                                                                \App\Models\BukuChapterMahasiswa::updateOrCreate(
                                                                                                                                    [
                                                                                                                                        'user_id' => $userId,
                                                                                                                                    ],
                                                                                                                                    [
                                                                                                                                        'luaran_penelitian' => $rowData['Luaran Penelitian - Buku ber-ISBN, Book Chapter'] ?? '-',
                                                                                                                                        'keterangan' => $rowData['Keterangan'] ?? '-',
                                                                                                                                        'tahun' => $rowData['Tahun'] ?? '-',
                                                                                                                                                    'user_id' => $userId,
                                                                                                                                    ]
                                                                                                                                );
                                                                                                                                break;
            }
        }
    }

    Storage::delete($filePath);

    return redirect()->back()->with('success', 'Data berhasil diimpor!');
}

}
