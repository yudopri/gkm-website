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

    $filePath = $request->file('file')->store('temp');
    $fullPath = Storage::path($filePath);
    $spreadsheet = IOFactory::load($fullPath);
    \App\Models\KerjasamaTridharmaPendidikan::truncate();
    \App\Models\KerjasamaTridharmaPenelitian::truncate();
    \App\Models\KerjasamaTridharmaPengmas::truncate();
    \App\Models\SeleksiMahasiswaBaru::truncate();
    \App\Models\MahasiswaAsing::truncate();
    \App\Models\DosenTetapPT::truncate();
    \App\Models\DosenTidakTetap::truncate();
    \App\Models\DosenPembimbingTA::truncate();
    \App\Models\EwmpDosen::truncate();
    \App\Models\DosenIndustriPraktisi::truncate();
    \App\Models\RekognisiDosen::truncate();
    \App\Models\PenelitianDtps::truncate();
    \App\Models\PkmDtps::truncate();
    \App\Models\ProdukTeradopsiDosen::truncate();
    \App\Models\PublikasiIlmiahDosen::truncate();
    \App\Models\SitasiKaryaDosen::truncate();
    \App\Models\HkiPatenDosen::truncate();
    \App\Models\HkiHakciptaDosen::truncate();
    \App\Models\TeknologiKaryaDosen::truncate();
    \App\Models\BukuChapterDosen::truncate();
    \App\Models\IpkLulusan::truncate();
    \App\Models\MasaStudiLulusan::truncate();
    \App\Models\PrestasiAkademik::truncate();
    \App\Models\PrestasiNonakademik::truncate();
    \App\Models\EvalKepuasanPengguna::truncate();
    \App\Models\EvalKesesuaianKerja::truncate();
    \App\Models\EvalTempatKerja::truncate();
    \App\Models\EvalWaktuTunggu::truncate();
    \App\Models\IntegrasiPenelitian::truncate();
    \App\Models\KepuasanMahasiswa::truncate();
    \App\Models\KurikulumPembelajaran::truncate();
    \App\Models\DtpsPenelitianMahasiswa::truncate();
    \App\Models\DtpsRujukanTesis::truncate();
    \App\Models\PkmDtpsMahasiswa::truncate();
    \App\Models\ProdukJasaMahasiswa::truncate();
    \App\Models\PublikasiMahasiswa::truncate();
    \App\Models\ProdukJasaMahasiswa::truncate();
    \App\Models\SitasiKaryaMahasiswa::truncate();
    \App\Models\HkiPatenMahasiswa::truncate();
    \App\Models\HkiHakCiptaMahasiswa::truncate();
    \App\Models\TeknologiKaryaMahasiswa::truncate();
    \App\Models\BukuChapterMahasiswa::truncate();
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
