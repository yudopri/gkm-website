<?php

namespace App\Http\Controllers\Admin\Grafik\KinerjaLulusan;

use App\Http\Controllers\Admin\KinerjaLulusan\PrestasiMahasiswa\AkademikController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EvalKepuasanPengguna;
use App\Models\EvalKesesuaianKerja;
use App\Models\EvalTempatKerja;
use App\Models\EvalWaktuTunggu;
use App\Models\IpkLulusan;
use App\Models\MasaStudiLulusan;
use App\Models\PrestasiAkademikMhs;
use App\Models\PrestasiNonakademikMhs;

class GabunganLulusanController extends Controller
{
    public function index()
    {
        // Contoh model yang kamu punya, sesuaikan nama model dan field-nya
        $totalAkademik = PrestasiAkademikMhs::count();
        $totalNonAkademik = PrestasiNonakademikMhs::count();
        $totalIL = IpkLulusan::count();
        $totalKP = EvalKepuasanPengguna::count();
        $totalKK = EvalKesesuaianKerja::count();
        $totalMS = MasaStudiLulusan::count();
        $totalTempat = EvalTempatKerja::count();
        $totalWT = EvalWaktuTunggu::count();

        $totals = [
            'Prestasi Akademik' => $totalAkademik,
            'Prestasi Non-akademik' => $totalNonAkademik,
            'IPK Lulusan' => $totalIL,
            'Kepuasan Pengguna' => $totalKP,
            'Kesesuaian Kerja' => $totalKK,
            'Masa Studi' => $totalMS,
            'Tempat Kerja' => $totalTempat,
            'Waktu Tunggu' => $totalWT 
        ];
        

        return view('pages.admin.petugas.grafik.kinerja-lulusan.gabungan.index', compact('totals'));
    }
}
