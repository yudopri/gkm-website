<?php

namespace App\Http\Controllers\Api\ExportPdf;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\SeleksiMahasiswaBaru;
use App\Models\PublikasiIlmiahDosen;
use App\Models\PublikasiMahasiswa;
use Illuminate\Support\Collection;

class ExportPdfController extends Controller
{
    public function exportPdf(string $dosenId)
    {
        try {
            $data = User::with([
                'profile',
                'kerjasama_tridharma_pendidikan',
                'kerjasama_tridharma_penelitian',
                'kerjasama_tridharma_pengmas',
                'seleksi_maba',
                'mahasiswa_asing',
                'dosen_tetap',
                'dosen_tidak_tetap',
                'dosen_pembimbing_ta',
                'ewmp_dosen',
                'dosen_praktisi',
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
                'ipk_lulusan',
                'masa_studi_lulusan',
                'eval_kepuasan_pengguna',
                'eval_kesesuaian_kerja',
                'eval_tempat_kerja',
                'eval_waktu_tunggu',
                'prestasi_akademik',
                'prestasi_nonakademik',
                'integrasi_penelitian',
                'kepuasan_mahasiswa',
                'kurikulum_pembelajaran',
                'penelitian_mahasiswa',
                'rujukan_tesis_mahasiswa',
                'pkm_dtps_mahasiswa',
                'produk_jasa_mahasiswa',
                'publikasi_mahasiswa',
                'sitasi_karya_mahasiswa',
                'hki_paten_mahasiswa',
                'hki_cipta_mahasiswa',
                'teknologi_karya_mahasiswa',
                'buku_chapter_mahasiswa',
            ])->whereId($dosenId)->firstOrFail();

            // Mencegah error foreach dan sum() on null
            $relasiList = [
                'kerjasama_tridharma_pendidikan',
                'kerjasama_tridharma_penelitian',
                'kerjasama_tridharma_pengmas',
                'seleksi_maba',
                'mahasiswa_asing',
                'dosen_tetap',
                'dosen_tidak_tetap',
                'dosen_pembimbing_ta',
                'ewmp_dosen',
                'dosen_praktisi',
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
                'ipk_lulusan',
                'masa_studi_lulusan',
                'eval_kepuasan_pengguna',
                'eval_kesesuaian_kerja',
                'eval_tempat_kerja',
                'eval_waktu_tunggu',
                'prestasi_akademik',
                'prestasi_nonakademik',
                'integrasi_penelitian',
                'kepuasan_mahasiswa',
                'kurikulum_pembelajaran',
                'penelitian_mahasiswa',
                'rujukan_tesis_mahasiswa',
                'pkm_dtps_mahasiswa',
                'produk_jasa_mahasiswa',
                'publikasi_mahasiswa',
                'sitasi_karya_mahasiswa',
                'hki_paten_mahasiswa',
                'hki_cipta_mahasiswa',
                'teknologi_karya_mahasiswa',
                'buku_chapter_mahasiswa',
            ];

            foreach ($relasiList as $relasi) {
                if (!($data->$relasi instanceof Collection)) {
                    $data->$relasi = collect();
                }
            }

            // Total seleksi mahasiswa baru
            $total = SeleksiMahasiswaBaru::selectRaw('
                SUM(pendaftar) as total_pendaftar,
                SUM(lulus_seleksi) as total_lulus_seleksi,
                SUM(maba_reguler) as total_maba_reguler,
                SUM(maba_transfer) as total_maba_transfer,
                SUM(COALESCE(mhs_aktif_reguler, 0) + COALESCE(mhs_aktif_transfer, 0)) as total_mhs_aktif
            ')->first();

            // Total publikasi
            $totalpublik = PublikasiIlmiahDosen::whereNull('deleted_at')->count();
            $totalpublikmaha = PublikasiMahasiswa::whereNull('deleted_at')->count();

            $pdf = Pdf::loadView('pages.admin.petugas.list-dosen.print', compact('data', 'total', 'totalpublik', 'totalpublikmaha'))->setPaper('legal', 'landscape');
            $filename = 'laporan-gkm-' . Str::slug($data->name) . '-' . time() . '.pdf';

            return response()->streamDownload(
                function () use ($pdf) {
                    echo $pdf->output();
                },
                $filename,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="'.$filename.'"',
                ]
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
