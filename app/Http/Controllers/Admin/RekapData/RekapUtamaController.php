<?php

namespace App\Http\Controllers\Admin\RekapData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import semua model
use App\Models\BukuChapterDosen;
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
use App\Models\HkiPatenDosen;
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
use App\Models\ProdukTeradopsiDosen;
use App\Models\ProgramStudi;
use App\Models\PublikasiIlmiahDosen;
use App\Models\RekognisiDosen;
use App\Models\SeleksiMahasiswaBaru;
use App\Models\SitasiKaryaDosen;
use App\Models\TahunAjaranSemester;
use App\Models\TeknologiKaryaDosen;
use App\Models\User;
use App\Models\UserProfile;

class RekapUtamaController extends Controller
{
    public function index(Request $request)
    {
        
      // Validasi user_id
      $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    $userId = $request->input('user_id');
    $user = User::find($userId);

    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'User dengan ID tersebut tidak ditemukan.'
        ], 404);
    }

        // Rekap berdasarkan user_id (asumsi semua model punya kolom user_id)
        $rekap = [
            'buku_chapter_dosen' => BukuChapterDosen::where('user_id', $userId)->count(),
            'dosen_industri_praktisi' => DosenIndustriPraktisi::where('user_id', $userId)->count(),
            'dosen_pembimbing_ta' => DosenPembimbingTA::where('user_id', $userId)->count(),
            'dosen_tidak_tetap' => DosenTidakTetap::where('user_id', $userId)->count(),
            'dtps_penelitian_mahasiswa' => DtpsPenelitianMahasiswa::where('user_id', $userId)->count(),
            'dtps_rujukan_tesis' => DtpsRujukanTesis::where('user_id', $userId)->count(),
            'eval_kepuasan_pengguna' => EvalKepuasanPengguna::where('user_id', $userId)->count(),
            'eval_kesesuaian_kerja' => EvalKesesuaianKerja::where('user_id', $userId)->count(),
            'eval_tempat_kerja' => EvalTempatKerja::where('user_id', $userId)->count(),
            'eval_waktu_tunggu' => EvalWaktuTunggu::where('user_id', $userId)->count(),
            'ewmp_dosen' => EwmpDosen::where('user_id', $userId)->count(),
            'hki_hakcipta_dosen' => HkiHakciptaDosen::where('user_id', $userId)->count(),
            'hki_paten_dosen' => HkiPatenDosen::where('user_id', $userId)->count(),
            'integrasi_penelitian' => IntegrasiPenelitian::where('user_id', $userId)->count(),
            'ipk_lulusan' => IpkLulusan::where('user_id', $userId)->count(),
            'kepuasan_mahasiswa' => KepuasanMahasiswa::where('user_id', $userId)->count(),
            'kerjasama_tridharma_pendidikan' => KerjasamaTridharmaPendidikan::where('user_id', $userId)->count(),
            'kerjasama_tridharma_penelitian' => KerjasamaTridharmaPenelitian::where('user_id', $userId)->count(),
            'kerjasama_tridharma_pengmas' => KerjasamaTridharmaPengmas::where('user_id', $userId)->count(),
            'kurikulum_pembelajaran' => KurikulumPembelajaran::where('user_id', $userId)->count(),
            'mahasiswa_asing' => MahasiswaAsing::where('user_id', $userId)->count(),
            'masa_studi_lulusan' => MasaStudiLulusan::where('user_id', $userId)->count(),
            'penelitian_dtps' => PenelitianDtps::where('user_id', $userId)->count(),
            'pkm_dtps' => PkmDtps::where('user_id', $userId)->count(),
            'pkm_dtps_mahasiswa' => PkmDtpsMahasiswa::where('user_id', $userId)->count(),
            'prestasi_akademik_mhs' => PrestasiAkademikMhs::where('user_id', $userId)->count(),
            'prestasi_nonakademik_mhs' => PrestasiNonakademikMhs::where('user_id', $userId)->count(),
            'produk_teradopsi_dosen' => ProdukTeradopsiDosen::where('user_id', $userId)->count(),
            'publikasi_ilmiah_dosen' => PublikasiIlmiahDosen::where('user_id', $userId)->count(),
            'rekognisi_dosen' => RekognisiDosen::where('user_id', $userId)->count(),
            'seleksi_mahasiswa_baru' => SeleksiMahasiswaBaru::where('user_id', $userId)->count(),
            'sitasi_karya_dosen' => SitasiKaryaDosen::where('user_id', $userId)->count(),
            'teknologi_karya_dosen' => TeknologiKaryaDosen::where('user_id', $userId)->count(),
            'user_profile' => UserProfile::where('user_id', $userId)->count(),
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil merekap semua data dosen',
            'data' => $rekap
        ]);
    }
}
