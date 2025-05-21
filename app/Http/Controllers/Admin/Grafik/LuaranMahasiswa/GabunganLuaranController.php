<?php

namespace App\Http\Controllers\Admin\Grafik\LuaranMahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BukuChapterDosen;
use App\Models\HkiHakciptaDosen;
use App\Models\HkiPatenDosen;
use App\Models\PenelitianDtps;
use App\Models\PkmDtps;
use App\Models\ProdukTeradopsiDosen;
use App\Models\PublikasiIlmiahDosen;
use App\Models\RekognisiDosen;
use App\Models\SitasiKaryaDosen;
use App\Models\TeknologiKaryaDosen;

class GabunganLuaranController extends Controller
{
    public function index()
    {
        // Contoh model yang kamu punya, sesuaikan nama model dan field-nya
        $totalBC = BukuChapterDosen::count();
        $totalHC = HkiHakciptaDosen::count();
        $totalHP = HkiPatenDosen::count();
        $totalPJ = ProdukTeradopsiDosen::count();
        $totalPM = PublikasiIlmiahDosen::count();
        $totalSM = SitasiKaryaDosen::count();
        $totalTKM = TeknologiKaryaDosen::count();

        $totals = [
            'Buku & Chapter' => $totalBC,
            'HKI Cipta' => $totalHC,
            'HKI Paten' => $totalHP,
            'Produk Jasa Teradopsi' => $totalPJ,
            'Publikasi Mahasiswa' => $totalPM,
            'Sitasi Mahasiswa' => $totalSM,
            'Teknologi & Karya Mahasiswa' => $totalTKM

            
        ];
        

        return view('pages.admin.petugas.grafik.luaran-karya-mahasiswa.gabungan.index', compact('totals'));
    }
}
