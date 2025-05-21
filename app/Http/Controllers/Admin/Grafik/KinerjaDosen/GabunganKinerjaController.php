<?php

namespace App\Http\Controllers\Admin\Grafik\KinerjaDosen;

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

class GabunganKinerjaController extends Controller
{
    public function index()
    {
        // Contoh model yang kamu punya, sesuaikan nama model dan field-nya
        $totalBC = BukuChapterDosen::count();
        $totalHC = HkiHakciptaDosen::count();
        $totalHP = HkiPatenDosen::count();
        $totalPenelitianDtps = PenelitianDtps::count();
        $totalPengakuan = RekognisiDosen::count();
        $totalPkmDtps = PkmDtps::count();
        $totalPJ = ProdukTeradopsiDosen::count();
        $totalPubil = PublikasiIlmiahDosen::count();
        $totalSitil = SitasiKaryaDosen::count();
        $totalTk = TeknologiKaryaDosen::count();

        $totals = [
            'Buku & Chapter' => $totalBC,
            'HKI Cipta' => $totalHC,
            'HKI Paten' => $totalHP,
            'Penelitian Dtps' => $totalPenelitianDtps,
            'Pengakuan/Rekognisi Dosen' => $totalPengakuan,
            'PKM DTPS' => $totalPkmDtps,
            'Produk Jasa Teradopsi' => $totalPJ,
            'Dosen Publikasi Ilmiah' => $totalPubil,
            'Dosen Sitasi Ilmiah' => $totalSitil,
            'Teknologi & Karya' => $totalTk

            
        ];
        

        return view('pages.admin.petugas.grafik.kinerja-dosen.gabungan.index', compact('totals'));
    }
}
