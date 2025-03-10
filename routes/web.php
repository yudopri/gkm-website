<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KerjasamaTridharma\PendidikanController;
use App\Http\Controllers\Admin\KerjasamaTridharma\PenelitianController;
use App\Http\Controllers\Admin\KerjasamaTridharma\PengmasController;
use App\Http\Controllers\Admin\DataMahasiswa\MahasiswaAsingController;
use App\Http\Controllers\Admin\DataMahasiswa\SeleksiMabaController;
use App\Http\Controllers\Admin\DataDosen\DosenTetapController;
use App\Http\Controllers\Admin\DataDosen\DosenTidakTetapController;
use App\Http\Controllers\Admin\DataDosen\EwmpDosenController;
use App\Http\Controllers\Admin\DataDosen\PembimbingTaController;
use App\Http\Controllers\Admin\DataDosen\DosenPraktisiController;
use App\Http\Controllers\Admin\Dosen\TahunAjaranController;
use App\Http\Controllers\Admin\KinerjaDosen\LuaranLain\BukuChapterController;
use App\Http\Controllers\Admin\KinerjaDosen\LuaranLain\HkiHakciptaController;
use App\Http\Controllers\Admin\KinerjaDosen\LuaranLain\HkiPatenController;
use App\Http\Controllers\Admin\KinerjaDosen\LuaranLain\TeknologiKaryaController;
use App\Http\Controllers\Admin\KinerjaDosen\PenelitianDtpsController;
use App\Http\Controllers\Admin\KinerjaDosen\PkmDtpsController;
use App\Http\Controllers\Admin\KinerjaDosen\ProdukTeradopsiController;
use App\Http\Controllers\Admin\KinerjaDosen\PublikasiIlmiahController;
use App\Http\Controllers\Admin\KinerjaDosen\RekognisiDosenController;
use App\Http\Controllers\Admin\KinerjaDosen\SitasiKaryaController;
use App\Http\Controllers\Admin\KinerjaLulusan\EvaluasiLulusan\KepuasanPenggunaController;
use App\Http\Controllers\Admin\KinerjaLulusan\EvaluasiLulusan\KesesuaianKerjaController;
use App\Http\Controllers\Admin\KinerjaLulusan\EvaluasiLulusan\TempatKerjaController;
use App\Http\Controllers\Admin\KinerjaLulusan\EvaluasiLulusan\WaktuTungguController;
use App\Http\Controllers\Admin\KinerjaLulusan\IpkLulusanController;
use App\Http\Controllers\Admin\KinerjaLulusan\MasaStudiLulusanController;
use App\Http\Controllers\Admin\KinerjaLulusan\PrestasiMahasiswa\AkademikController;
use App\Http\Controllers\Admin\KinerjaLulusan\PrestasiMahasiswa\NonakademikController;
use App\Http\Controllers\Admin\KualitasPembelajaran\IntegrasiPenelitianController;
use App\Http\Controllers\Admin\KualitasPembelajaran\KepuasanMahasiswaController;
use App\Http\Controllers\Admin\KualitasPembelajaran\KurikulumPembelajaranController;
use App\Http\Controllers\Admin\PenelitianDtps\PenelitianMahasiswaController;
use App\Http\Controllers\Admin\PenelitianDtps\RujukanTesisController;
use App\Http\Controllers\Admin\Petugas\ListDosenController;
use App\Http\Controllers\Admin\PkmDtpsMahasiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.front.index');
});

Auth::routes(['register' => false]);

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ROLE ADMIN & PETUGAS
    Route::middleware('role:admin|petugas')->prefix('petugas')->name('petugas.')->group(function () {
        Route::get('/list-dosen', [ListDosenController::class, 'index'])->name('list-dosen.index');
        Route::get('/export-pdf/{dosenId}', [ListDosenController::class, 'exportPdf'])->name('list-dosen.export.pdf');

        Route::prefix('detail')->name('detail.')->group(function () {
            Route::prefix('kerjasama-tridharma')->name('kt.')->group(function () {
                Route::resource('pendidikan', PendidikanController::class)->only('show');
                Route::resource('penelitian', PenelitianController::class)->only('show');
                Route::resource('pengabdian-masyarakat', PengmasController::class)->only('show');
            });

            Route::prefix('data-mahasiswa')->name('dm.')->group(function () {
                Route::resource('seleksi-maba', SeleksiMabaController::class)->only('show');
                Route::resource('mahasiswa-asing', MahasiswaAsingController::class)->only('show');
            });

            Route::prefix('data-dosen')->name('dd.')->group(function () {
                Route::resource('dosen-tetap', DosenTetapController::class)->only('show');
                Route::resource('dosen-pembimbing-ta', PembimbingTaController::class)->only('show');
                Route::resource('ewmp-dosen', EwmpDosenController::class)->only('show');
                Route::resource('dosen-tidak-tetap', DosenTidakTetapController::class)->only('show');
                Route::resource('dosen-praktisi', DosenPraktisiController::class)->only('show');
            });
        });
    });

    // ROLE DOSEN, STAFF, D3, D4, S2
    Route::middleware('role:dosen|staff|D3|D4|S2')->prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/tahun-ajaran-semester', [TahunAjaranController::class, 'index'])->name('tahun-ajaran.index');

        Route::prefix('kerjasama-tridharma/{tahunAjaran}')->name('kt.')->group(function () {
            // Kerjasama Tridharma Pendidikan Dosen
            Route::get('/pendidikan', [PendidikanController::class, 'index'])->name('pendidikan.index');
            Route::post('/pendidikan', [PendidikanController::class, 'store'])->name('pendidikan.store');
            Route::get('/pendidikan/create', [PendidikanController::class, 'create'])->name('pendidikan.create');
            Route::get('/pendidikan/{pendidikanId}', [PendidikanController::class, 'edit'])->name('pendidikan.edit');
            Route::put('/pendidikan/{pendidikanId}', [PendidikanController::class, 'update'])->name('pendidikan.update');
            Route::delete('/pendidikan/{pendidikanId}', [PendidikanController::class, 'destroy'])->name('pendidikan.destroy');

            // Kerjasama Tridharma Penelitian Dosen
            Route::get('/penelitian', [PenelitianController::class, 'index'])->name('penelitian.index');
            Route::post('/penelitian', [PenelitianController::class, 'store'])->name('penelitian.store');
            Route::get('/penelitian/create', [PenelitianController::class, 'create'])->name('penelitian.create');
            Route::get('/penelitian/{penelitianId}', [PenelitianController::class, 'edit'])->name('penelitian.edit');
            Route::put('/penelitian/{penelitianId}', [PenelitianController::class, 'update'])->name('penelitian.update');
            Route::delete('/penelitian/{penelitianId}', [PenelitianController::class, 'destroy'])->name('penelitian.destroy');

            // Kerjasama Tridharma Pengabdian Masyarakat Dosen
            Route::get('/pengabdian-masyarakat', [PengmasController::class, 'index'])->name('pengmas.index');
            Route::post('/pengabdian-masyarakat', [PengmasController::class, 'store'])->name('pengmas.store');
            Route::get('/pengabdian-masyarakat/create', [PengmasController::class, 'create'])->name('pengmas.create');
            Route::get('/pengabdian-masyarakat/{pengmasId}', [PengmasController::class, 'edit'])->name('pengmas.edit');
            Route::put('/pengabdian-masyarakat/{pengmasId}', [PengmasController::class, 'update'])->name('pengmas.update');
            Route::delete('/pengabdian-masyarakat/{pengmasId}', [PengmasController::class, 'destroy'])->name('pengmas.destroy');
        });

        Route::prefix('data-mahasiswa/{tahunAjaran}')->name('dm.')->group(function () {
            // Seleksi Mahasiswa Baru
            Route::get('/seleksi-maba', [SeleksiMabaController::class, 'index'])->name('seleksi-maba.index');
            Route::post('/seleksi-maba', [SeleksiMabaController::class, 'store'])->name('seleksi-maba.store');
            Route::get('/seleksi-maba/create', [SeleksiMabaController::class, 'create'])->name('seleksi-maba.create');
            Route::get('/seleksi-maba/{seleksiMabaId}', [SeleksiMabaController::class, 'edit'])->name('seleksi-maba.edit');
            Route::put('/seleksi-maba/{seleksiMabaId}', [SeleksiMabaController::class, 'update'])->name('seleksi-maba.update');
            Route::delete('/seleksi-maba/{seleksiMabaId}', [SeleksiMabaController::class, 'destroy'])->name('seleksi-maba.destroy');

            // Mahasiswa Asing
            Route::get('/mahasiswa-asing', [MahasiswaAsingController::class, 'index'])->name('mahasiswa-asing.index');
            Route::post('/mahasiswa-asing', [MahasiswaAsingController::class, 'store'])->name('mahasiswa-asing.store');
            Route::get('/mahasiswa-asing/create', [MahasiswaAsingController::class, 'create'])->name('mahasiswa-asing.create');
            Route::get('/mahasiswa-asing/{mahasiswaAsingId}', [MahasiswaAsingController::class, 'edit'])->name('mahasiswa-asing.edit');
            Route::put('/mahasiswa-asing/{mahasiswaAsingId}', [MahasiswaAsingController::class, 'update'])->name('mahasiswa-asing.update');
            Route::delete('/mahasiswa-asing/{mahasiswaAsingId}', [MahasiswaAsingController::class, 'destroy'])->name('mahasiswa-asing.destroy');
        });

        Route::prefix('data-dosen/{tahunAjaran}')->name('dd.')->group(function () {
            // Dosen Tetap PT
            Route::get('/dosen-tetap', [DosenTetapController::class, 'index'])->name('dosen-tetap.index');
            Route::post('/dosen-tetap', [DosenTetapController::class, 'store'])->name('dosen-tetap.store');
            Route::get('/dosen-tetap/create', [DosenTetapController::class, 'create'])->name('dosen-tetap.create');
            Route::get('/dosen-tetap/{dosenTetapId}', [DosenTetapController::class, 'edit'])->name('dosen-tetap.edit');
            Route::put('/dosen-tetap/{dosenTetapId}', [DosenTetapController::class, 'update'])->name('dosen-tetap.update');
            Route::delete('/dosen-tetap/{dosenTetapId}', [DosenTetapController::class, 'destroy'])->name('dosen-tetap.destroy');

            // Dosen Pembimbing TA
            Route::get('/dosen-pembimbing-ta', [PembimbingTaController::class, 'index'])->name('dosen-pembimbing-ta.index');
            Route::post('/dosen-pembimbing-ta', [PSembimbingTaController::class, 'store'])->name('dosen-pembimbing-ta.store');
            Route::get('/dosen-pembimbing-ta/create', [PembimbingTaController::class, 'create'])->name('dosen-pembimbing-ta.create');
            Route::get('/dosen-pembimbing-ta/{pembimbingTaId}', [PembimbingTaController::class, 'edit'])->name('dosen-pembimbing-ta.edit');
            Route::put('/dosen-pembimbing-ta/{pembimbingTaId}', [PembimbingTaController::class, 'update'])->name('dosen-pembimbing-ta.update');
            Route::delete('/dosen-pembimbing-ta/{pembimbingTaId}', [PembimbingTaController::class, 'destroy'])->name('dosen-pembimbing-ta.destroy');

            // EWMP Dosen
            Route::get('/ewmp-dosen', [EwmpDosenController::class, 'index'])->name('ewmp-dosen.index');
            Route::post('/ewmp-dosen', [EwmpDosenController::class, 'store'])->name('ewmp-dosen.store');
            Route::get('/ewmp-dosen/create', [EwmpDosenController::class, 'create'])->name('ewmp-dosen.create');
            Route::get('/ewmp-dosen/{ewmpDosenId}', [EwmpDosenController::class, 'edit'])->name('ewmp-dosen.edit');
            Route::put('/ewmp-dosen/{ewmpDosenId}', [EwmpDosenController::class, 'update'])->name('ewmp-dosen.update');
            Route::delete('/ewmp-dosen/{ewmpDosenId}', [EwmpDosenController::class, 'destroy'])->name('ewmp-dosen.destroy');

            // Dosen Tidak Tetap PT
            Route::get('/dosen-tidak-tetap', [DosenTidakTetapController::class, 'index'])->name('dosen-tidak-tetap.index');
            Route::post('/dosen-tidak-tetap', [DosenTidakTetapController::class, 'store'])->name('dosen-tidak-tetap.store');
            Route::get('/dosen-tidak-tetap/create', [DosenTidakTetapController::class, 'create'])->name('dosen-tidak-tetap.create');
            Route::get('/dosen-tidak-tetap/{dosenTidakTetapId}', [DosenTidakTetapController::class, 'edit'])->name('dosen-tidak-tetap.edit');
            Route::put('/dosen-tidak-tetap/{dosenTidakTetapId}', [DosenTidakTetapController::class, 'update'])->name('dosen-tidak-tetap.update');
            Route::delete('/dosen-tidak-tetap/{dosenTidakTetapId}', [DosenTidakTetapController::class, 'destroy'])->name('dosen-tidak-tetap.destroy');

            // Dosen Praktisi
            Route::get('/dosen-praktisi', [DosenPraktisiController::class, 'index'])->name('dosen-praktisi.index');
            Route::post('/dosen-praktisi', [DosenPraktisiController::class, 'store'])->name('dosen-praktisi.store');
            Route::get('/dosen-praktisi/create', [DosenPraktisiController::class, 'create'])->name('dosen-praktisi.create');
            Route::get('/dosen-praktisi/{dosenPraktisiId}', [DosenPraktisiController::class, 'edit'])->name('dosen-praktisi.edit');
            Route::put('/dosen-praktisi/{dosenPraktisiId}', [DosenPraktisiController::class, 'update'])->name('dosen-praktisi.update');
            Route::delete('/dosen-praktisi/{dosenPraktisiId}', [DosenPraktisiController::class, 'destroy'])->name('dosen-praktisi.destroy');
        });
    });

    Route::prefix('kinerja-dosen')->name('kinerja-dosen.')->group(function () {
        Route::resource('rekognisi-dtps', RekognisiDosenController::class)->except('show');
        Route::resource('penelitian-dtps', PenelitianDtpsController::class)->except('show');
        Route::resource('pkm-dtps', PkmDtpsController::class)->except('show');
        Route::resource('publikasi-ilmiah', PublikasiIlmiahController::class)->except('show');
        Route::resource('sitasi-karya', SitasiKaryaController::class)->except('show');
        Route::resource('produk-teradopsi', ProdukTeradopsiController::class)->except('show');

        Route::prefix('luaran-lain')->name('luaran-lain.')->group(function () {
            Route::resource('hki-paten', HkiPatenController::class)->except('show');
            Route::resource('hki-hakcipta', HkiHakciptaController::class)->except('show');
            Route::resource('teknologi-karya', TeknologiKaryaController::class)->except('show');
            Route::resource('buku-chapter', BukuChapterController::class)->except('show');
        });
    });

    Route::prefix('kualitas-pembelajaran')->name('kualitas-pembelajaran.')->group(function () {
        Route::resource('kurikulum-pembelajaran', KurikulumPembelajaranController::class)->except('show');
        Route::resource('integrasi-penelitian', IntegrasiPenelitianController::class)->except('show');
        Route::resource('kepuasan-mahasiswa', KepuasanMahasiswaController::class)->except('show');
    });

    Route::prefix('penelitian-dtps')->name('penelitian-dtps.')->group(function () {
        Route::resource('penelitian-mahasiswa', PenelitianMahasiswaController::class)->except('show');
        Route::resource('rujukan-tesis', RujukanTesisController::class)->except('show');
    });

    Route::resource('pkm-dtps-mahasiswa', PkmDtpsMahasiswaController::class)->except('show');

    Route::prefix('kinerja-lulusan')->name('kinerja-lulusan.')->group(function () {
        Route::resource('ipk-lulusan', IpkLulusanController::class)->except('show');

        Route::prefix('prestasi-mahasiswa')->name('prestasi-mahasiswa.')->group(function () {
            Route::resource('akademik', AkademikController::class)->except('show');
            Route::resource('nonakademik', NonakademikController::class)->except('show');
        });

        Route::resource('masa-studi-lulusan', MasaStudiLulusanController::class)->except('show');

        Route::prefix('evaluasi-lulusan')->name('evaluasi-lulusan.')->group(function () {
            Route::resource('waktu-tunggu', WaktuTungguController::class)->except('show');
            Route::resource('kesesuaian-kerja', KesesuaianKerjaController::class)->except('show');
            Route::resource('tempat-kerja', TempatKerjaController::class)->except('show');
            Route::resource('kepuasan-pengguna', KepuasanPenggunaController::class)->except('show');
        });
    });
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
