<?php

namespace App\Http\Controllers\Admin\Grafik\DataDosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DosenIndustriPraktisi;
use App\Models\DosenPembimbingTA;
use App\Models\DosenTetapPT;
use App\Models\DosenTidakTetap;
use App\Models\EwmpDosen;

class GabunganDosenController extends Controller
{
    public function index()
    {
        // Contoh model yang kamu punya, sesuaikan nama model dan field-nya
        $totalDospem = DosenPembimbingTA::count();
        $totalDosPraktisi = DosenIndustriPraktisi::count();
        $totalDosTetap = DosenTetapPT::count();
        $totalDosTidakTetap = DosenTidakTetap::count();
        $totalEwmpDosen = EwmpDosen::count();


        $totals = [
            'Dosen Pembimbing' => $totalDospem,
            'Dosen Praktisi' => $totalDosPraktisi,
            'Dosen Tetap' => $totalDosTetap,
            'Dosen Tidak Tetap' => $totalDosTidakTetap,
            'Ewmp Dosen' => $totalEwmpDosen

            
        ];
        

        return view('pages.admin.petugas.grafik.data-dosen.gabungan.index', compact('totals'));
    }
}
