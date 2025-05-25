<?php

namespace App\Http\Controllers\Api\RekapData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use App\Http\Controllers\Admin\RekapData\RekapUtamaController;
// Import semua model untuk rekap

class RedirectController extends Controller
{
     /**
     * Mengembalikan data rekap dosen dalam bentuk JSON.
     *
     * @param string $tahun_ajaran
     * @param int $dosenId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJson( int $dosenId, $tahun_ajaran)
    {
        // Validasi dosen
        $user = User::find($dosenId);
        if (! $user) {
            return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
        }

        // Validasi tahun ajaran
        $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahun_ajaran)->first();
        if (! $tahunAjaranObj) {
            return response()->json(['message' => 'Tahun ajaran tidak ditemukan'], 404);
        }

        // Inject ke request untuk controller rekap utama
        request()->merge([
            'tahun'    => $tahunAjaranObj->tahun_ajaran,
            'semester' => $tahunAjaranObj->semester,
        ]);

        // Ambil data rekap
        $rekapArray = (new RekapUtamaController)->getRekap($dosenId);

        // Keys yang digunakan
        $dosenKeys = [
            'kerjasama_tridharma_pendidikan',
            'kerjasama_tridharma_penelitian',
            'kerjasama_tridharma_pengmas',
            'seleksi_mahasiswa_baru',
            'mahasiswa_asing',
            'dosen_tetap_pt',
            'dosen_pembimbing_ta',
            'ewmp_dosen',
            'dosen_tidak_tetap',
            'dosen_industri_praktisi',
             'rekognisi_dosen',
            'penellitian_dpts',
            'pkm _dpts',
            'publikasi_ilmiah_dosen',
            'sitasi_karya_dosen',
            'produk_teradopsi_dosen' ,
             'hki_hakcipta_dosen',
            'hki_paten_dosen',
            'teknologi_karya_dosen',
            'buku_chapter_dosen',
             'kurikulum_pembelajaran',
            'integrasi_penelitian',
            'kepuasan_mahasiswa',
             'dtps_penelitian_mahasiswa',
            'dtps_rujukan_tesis',
            'pkm_dtps_mahasiswa',
            'ipk_lulusan',
            'prestasi_akademik_mhs'         ,
            'prestasi_nonakademik_mhs'   ,
            'masa_studi_lulusan',
              'eval_waktu_tunggu',  
            'eval_tempat_kerja',              
            'eval_kesesuaian_kerja',
            'eval_kepuasan_pengguna' ,
              'publikasi_mahasiswa',
            'sitasi_karya_mahasiswa',
            'produk_jasa_mahasiswa',
            'hki_paten_mahasiswa',
            'hki_hakcipta_mahasiswa',
            'teknologi_karya_mahasiswa',
            'buku_chapter_mahasiswa'
        ];

        $dosenKeyAliases = [
            'kerjasama_tridharma_pendidikan' =>'Tabel 1.1 Kerjasama Tridharma - Pendidikan',
            'kerjasama_tridharma_penelitian' =>'Tabel 1.2 Kerjasama Tridharma - Penelitian',
            'kerjasama_tridharma_pengmas' => 'Tabel 1.3 Kerjasama Tridharma - Pengabdian kepada Masyarakat',
            'seleksi_mahasiswa_baru' =>'Tabel 2.a Seleksi Mahasiswa',
            'mahasiswa_asing'=>'Tabel 2.b Mahasiswa Asing',
            'dosen_tetap_pt' => 'Tabel 3.a.1) Dosen Tetap Perguruan Tinggi',
            'dosen_pembimbing_ta' => 'Tabel 3.a.2) Dosen Pembimbing Utama Tugas Akhir',
            'ewmp_dosen' =>'Tabel 3.a.3) Ekuivalen Waktu Mengajar Penuh (EWMP) Dosen Tetap Perguruan Tinggi',
            'dosen_tidak_tetap' =>'Tabel 3.a.4) Dosen Tidak Tetap',
            'dosen_industri_praktisi' => 'Tabel 3.a.5) Dosen Industri/Praktisi',
             'rekognisi_dosen' => 'Tabel 3.b.1) Pengakuan/Rekognisi Dosen',
            'penellitian_dpts' =>'Tabel 3.b.2) Penelitian DTPS',
            'pkm _dpts' =>'Tabel 3.b.3) PkM DTPS',
            'publikasi_ilmiah_dosen'=>'Tabel 3.b.4) Pagelaran/Pameran/Publikasi Ilmiah DTPS',
            'sitasi_karya_dosen' =>'Tabel 3.b.5) Karya Ilmiah DTPS yang Disitasi',
            'produk_teradopsi_dosen'  => 'Tabel 3.b.6) Produk/Jasa DTPS yang Diadopsi',
             'hki_hakcipta_dosen' => 'Tabel 3.b.7) Luaran HKI - Paten, ',
            'hki_paten_dosen' => 'Tabel 3.b.8) Luaran HKI - Hak Cipta',
            'teknologi_karya_dosen' => 'Tabel 3.b.9) Teknologi Tepat Guna DTPS',
            'buku_chapter_dosen' => 'Tabel 3.b.10) Buku/Book Chapter DTPS',
             'kurikulum_pembelajaran' => 'Tabel 5.a Kurikulum & Rencana Pembelajaran',
            'integrasi_penelitian' => 'Tabel 5.b Integrasi Penelitian/PkM',
            'kepuasan_mahasiswa' => 'Tabel 5.c Kepuasan Mahasiswa',
             'dtps_penelitian_mahasiswa' => 'Tabel 6.a Penelitian DTPS + Mahasiswa',
            'dtps_rujukan_tesis' => 'Tabel 6.b Penelitian Rujukan Tesis',
            'pkm_dtps_mahasiswa' => 'Tabel 7 PkM DTPS + Mahasiswa',
            'ipk_lulusan' => 'Tabel 8.a IPK Lulusan',
            'prestasi_akademik_mhs' => 'Tabel 8.b.1) Prestasi Akademik',
            'prestasi_nonakademik_mhs' => 'Tabel 8.b.2) Prestasi Non-akademik',
            'masa_studi_lulusan' => 'Tabel 8.c Masa Studi Lulusan',
              'eval_waktu_tunggu' => 'Tabel 8.d.1) Waktu Tunggu',  
            'eval_tempat_kerja' => 'Tabel 8.e.1) Tempat Kerja',              
            'eval_kesesuaian_kerja' => 'Tabel 8.d.2) Kesesuaian Kerja',
            'eval_kepuasan_pengguna' => 'Tabel 8.e.2) Kepuasan Pengguna' ,
              'publikasi_mahasiswa' => 'Tabel 8.f.1) Publikasi Mahasiswa',
            'sitasi_karya_mahasiswa' => 'Tabel 8.f.2) Sitasi Mahasiswa',
            'produk_jasa_mahasiswa' => 'Tabel 8.f.3) Produk Mahasiswa',
            'hki_paten_mahasiswa' => 'Tabel 8.f.4) HKI Mahasiswa - Paten',
            'hki_hakcipta_mahasiswa' => 'Tabel 8.f.5) HKI Mahasiswa - Hak Cipta',
            'teknologi_karya_mahasiswa' => 'Tabel 8.f.6) Teknologi Mahasiswa',
            'buku_chapter_mahasiswa' => 'Tabel 8.f.7) Buku Mahasiswa',
        ];

        // Proses data sebagai map, bukan array
        $rows = [];
        foreach ($dosenKeys as $key) {
            $label = $dosenKeyAliases[$key] ?? ucwords(str_replace('_', ' ', $key));
            $rows[$label] = [
                'count'      => $rekapArray[$key]['count'] ?? 0,
                'min'        => $rekapArray[$key]['min'] ?? '-',
                'status'     => $rekapArray[$key]['status'] ?? 'belum diisi',
            ];
        }
        // Tambah rasio dosen tetap
        $rows['Rasio Dosen Tetap : Mahasiswa Aktif'] = [
            'count'      => $rekapArray['dosen_tetap_pt_ratio'] ?? 'n/a',
            'min'        => '-',
            'status'     => 'Rasio dosen tetap terhadap mahasiswa aktif reguler',
        ];
        // Hitung persentase dosen tidak tetap
        $dosenTetap = $rekapArray['dosen_tetap_pt']['count'] ?? 0;
        $dosenTidakTetap = $rekapArray['dosen_tidak_tetap']['count'] ?? 0;
        $persentaseTidakTetap = $dosenTetap > 0 ? ($dosenTidakTetap / $dosenTetap) * 100 : 0;
        $rows['Persentase Dosen Tidak Tetap'] = [
            'count'      => round($persentaseTidakTetap, 2) . '%',
            'min'        => '-',
            'status'     => $persentaseTidakTetap > 30
                ? 'Jumlah dosen tidak tetap melebihi 30%'
                : 'Jumlah dosen tidak tetap sesuai',
        ];

        // Kembalikan response JSON
        return response()->json([
            'tahun_ajaran' => $tahun_ajaran,
            'dosen'        => [
                'id'   => $user->id,
                'nama' => $user->name,
            ],
            'data' => $rows,
        ]);
    }
}