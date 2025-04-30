<?php

use App\Http\Controllers\Api\AuthControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KerjasamaTridharma\PendidikanApiController;
use App\Http\Controllers\Api\KerjasamaTridharma\PenelitianApiController;
use App\Http\Controllers\Api\KerjasamaTridharma\PengmasApiController;
use App\Http\Controllers\Api\KinerjaDosen\LuaranLain\BukuChapterApiController;
use App\Http\Controllers\Api\KinerjaDosen\LuaranLain\HkiHakciptaApiController;
use App\Http\Controllers\Api\KinerjaDosen\LuaranLain\HkiPatenApiController;
use App\Http\Controllers\Api\KinerjaDosen\LuaranLain\TeknologiKaryaApiController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\Dosen\TahunAjaranApiController;
use App\Http\Controllers\Api\DataDosen\DosenPraktisiApiController;
use App\Http\Controllers\Api\DataDosen\DosenTetapApiController;
use App\Http\Controllers\Api\DataDosen\DosenTidakTetapApiController;
use App\Http\Controllers\Api\DataDosen\EwmpDosenApiController;
use App\Http\Controllers\Api\DataDosen\PembimbingTaApiController;
use App\Http\Controllers\Api\DataMahasiswa\MahasiswaAsingApiController;
use App\Http\Controllers\Api\DataMahasiswa\SeleksiMabaApiController;
use App\Http\Controllers\Api\KinerjaLulusan\EvaluasiLulusan\KepuasanPenggunaController;
use App\Http\Controllers\Api\KinerjaLulusan\EvaluasiLulusan\KesesuaianKerjaController;
use App\Http\Controllers\Api\KinerjaLulusan\EvaluasiLulusan\TempatKerjaController;
use App\Http\Controllers\Api\KinerjaLulusan\EvaluasiLulusan\WaktuTungguController;
use App\Http\Controllers\Api\KinerjaLulusan\PrestasiMahasiswa\AkademikController;
use App\Http\Controllers\Api\KinerjaLulusan\PrestasiMahasiswa\NonAkademikController;
use App\Http\Controllers\Api\KinerjaLulusan\IpkLulusanController;
use App\Http\Controllers\Api\KinerjaLulusan\MasaStudiLulusanController;
use App\Http\Controllers\Api\KualitasPembelajaran\IntegrasiPenelitianController;
use App\Http\Controllers\Api\KualitasPembelajaran\KepuasanMahasiswaController;
use App\Http\Controllers\Api\KualitasPembelajaran\KurikulumPembelajaranController;
use App\Http\Controllers\Api\PenelitianDtps\PenelitianMahasiswaController;
use App\Http\Controllers\Api\PenelitianDtps\RujukanTesisController;
use App\Http\Controllers\Api\Petugas\ListDosenController;
use App\Http\Controllers\Admin\RekapData\RekapUtamaController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/token', [AuthControllerApi::class, 'requestToken']);
Route::middleware('auth:sanctum')->apiResource('/user-profiles', UserProfileController::class);
Route::middleware('auth:sanctum')->apiResource('/dosen-praktisi', DosenPraktisiApiController::class);
Route::middleware('auth:sanctum')->apiResource('/dosen-tetap', DosenTetapApiController::class);
Route::middleware('auth:sanctum')->apiResource('/dosen-tidak-tetap', DosenTidakTetapApiController::class);
Route::middleware('auth:sanctum')->apiResource('/dosen-pembimbing-ta', PembimbingTaApiController::class);
Route::middleware('auth:sanctum')->apiResource('/ewmp-dosen', EwmpDosenApiController::class);
Route::middleware('auth:sanctum')->apiResource('/tahun-ajaran', TahunAjaranApiController::class);
Route::middleware('auth:sanctum')->apiResource('/mahasiswa-asing', MahasiswaAsingApiController::class);
Route::middleware('auth:sanctum')->apiResource('/seleksi-maba', SeleksiMabaApiController::class);
Route::middleware('auth:sanctum')->apiResource('/kstd-pendidikan', PendidikanApiController::class);
Route::middleware('auth:sanctum')->apiResource('/kstd-penelitian', PenelitianApiController::class);
Route::middleware('auth:sanctum')->apiResource('/kstd-pengmas', PengmasApiController::class);
Route::middleware('auth:sanctum')->apiResource('/luaran-bukuchapter', BukuChapterApiController::class);
Route::middleware('auth:sanctum')->apiResource('/luaran-hkihakcipta', HkiHakciptaApiController::class);
Route::middleware('auth:sanctum')->apiResource('/luaran-hkipaten', HkiPatenApiController::class);
Route::middleware('auth:sanctum')->apiResource('/luaran-teknologikarya', TeknologiKaryaApiController::class);
Route::middleware('auth:sanctum')->apiResource('/kinerja-penelitian', BukuChapterApiController::class);
Route::middleware('auth:sanctum')->apiResource('/kinerja-pkmdtps', HkiHakciptaApiController::class);
Route::middleware('auth:sanctum')->apiResource('/kinerja-produk', HkiPatenApiController::class);
Route::middleware('auth:sanctum')->apiResource('/kinerja-publikasi', TeknologiKaryaApiController::class);
Route::middleware('auth:sanctum')->apiResource('/kinerja-rekognisi', TeknologiKaryaApiController::class);
Route::middleware('auth:sanctum')->apiResource('/kinerja-sitasi', TeknologiKaryaApiController::class);
Route::middleware('auth:sanctum')->apiResource('/kepuasan-pengguna', KepuasanPenggunaController::class);
Route::middleware('auth:sanctum')->apiResource('/kesesuaian-kerja', KesesuaianKerjaController::class);
Route::middleware('auth:sanctum')->apiResource('/tempat-kerja', TempatKerjaController::class);
Route::middleware('auth:sanctum')->apiResource('/waktu-tunggu', WaktuTungguController::class);
Route::middleware('auth:sanctum')->apiResource('/prestasi-akademik', AkademikController::class);
Route::middleware('auth:sanctum')->apiResource('/prestasi-non-akademik', NonAkademikController::class);
Route::middleware('auth:sanctum')->apiResource('/ipk-lulusan', IpkLulusanController::class);
Route::middleware('auth:sanctum')->apiResource('/masa-studi-lulusan', MasaStudiLulusanController::class);
Route::middleware('auth:sanctum')->apiResource('/integrasi-penelitian', IntegrasiPenelitianController::class);
Route::middleware('auth:sanctum')->apiResource('/kepuasan-mahasiswa', KepuasanMahasiswaController::class);
Route::middleware('auth:sanctum')->apiResource('/kurikulum-pembelajaran', KurikulumPembelajaranController::class);
Route::middleware('auth:sanctum')->apiResource('/penelitian-mahasiswa', PenelitianMahasiswaController::class);
Route::middleware('auth:sanctum')->apiResource('/rujukan-tesis', RujukanTesisController::class);
Route::middleware('auth:sanctum')->apiResource('/list-dosen', ListDosenController::class);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/rekap', [RekapUtamaController::class, 'index']);
});