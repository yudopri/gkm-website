<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\Dosen\TahunAjaranApiController;
use App\Http\Controllers\Api\DataDosen\DosenPraktisiApiController;
use App\Http\Controllers\Api\DataDosen\DosenTetapApiController;
use App\Http\Controllers\Api\DataDosen\DosenTidakTetapApiController;
use App\Http\Controllers\Api\DataDosen\EwmpDosenApiController;
use App\Http\Controllers\Api\DataMahasiswa\MahasiswaAsingApiController;
use App\Http\Controllers\Api\DataMahasiswa\SeleksiMabaApiController;

// *Api Routes
Route::apiResource('user-profiles', UserProfileController::class);
Route::apiResource('dosen-praktisi', DosenPraktisiApiController::class);
Route::apiResource('dosen-tetap', DosenTetapApiController::class);
Route::apiResource('dosen-tidak-tetap', DosenTidakTetapApiController::class);
Route::apiResource('ewmp-dosen', EwmpDosenApiController::class);
Route::apiResource('tahun-ajaran', TahunAjaranApiController::class);
Route::apiResource('mahasiswa-asing', MahasiswaAsingApiController::class);
Route::apiResource('seleksi-maba', SeleksiMabaApiController::class);
