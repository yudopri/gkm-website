<?php
use App\Http\Controllers\Api\KerjasamaTridharma\PendidikanApiController;
use App\Http\Controllers\Api\KerjasamaTridharma\PenelitianApiController;
use App\Http\Controllers\Api\KerjasamaTridharma\PengmasApiController;
use App\Http\Controllers\Api\KinerjaDosen\LuaranLain\BukuChapterApiController;
use App\Http\Controllers\Api\KinerjaDosen\LuaranLain\HkiHakciptaApiController;
use App\Http\Controllers\Api\KinerjaDosen\LuaranLain\HkiPatenApiController;
use App\Http\Controllers\Api\KinerjaDosen\LuaranLain\TeknologiKaryaApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\Dosen\TahunAjaranApiController;
use App\Http\Controllers\Api\DataDosen\DosenPraktisiApiController;
use App\Http\Controllers\Api\DataDosen\DosenTetapApiController;
use App\Http\Controllers\Api\DataDosen\DosenTidakTetapApiController;
use App\Http\Controllers\Api\DataDosen\EwmpDosenApiController;
use App\Http\Controllers\Api\DataDosen\PembimbingTaApiController;
use App\Http\Controllers\Api\DataMahasiswa\MahasiswaAsingApiController;
use App\Http\Controllers\Api\DataMahasiswa\SeleksiMabaApiController;

// *Api Routes
Route::apiResource('user-profiles', UserProfileController::class);
Route::apiResource('dosen-praktisi', DosenPraktisiApiController::class);
Route::apiResource('dosen-tetap', DosenTetapApiController::class);
Route::apiResource('dosen-tidak-tetap', DosenTidakTetapApiController::class);
Route::apiResource('dosen-pembimbing-ta', PembimbingTaApiController::class);
Route::apiResource('ewmp-dosen', EwmpDosenApiController::class);
Route::apiResource('tahun-ajaran', TahunAjaranApiController::class);
Route::apiResource('mahasiswa-asing', MahasiswaAsingApiController::class);
Route::apiResource('seleksi-maba', SeleksiMabaApiController::class);
Route::apiResource('kstd-pendidikan', PendidikanApiController::class);
Route::apiResource('kstd-penelitian', PenelitianApiController::class);
Route::apiResource('kstd-pengmas', PengmasApiController::class);
Route::apiResource('luaran-bukuchapter', BukuChapterApiController::class);
Route::apiResource('luaran-hkihakcipta', HkiHakciptaApiController::class);
Route::apiResource('luaran-hkipaten', HkiPatenApiController::class);
Route::apiResource('luaran-teknologikarya', TeknologiKaryaApiController::class);
