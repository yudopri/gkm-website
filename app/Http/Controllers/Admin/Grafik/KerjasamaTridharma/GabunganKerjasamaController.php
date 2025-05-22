<?php

namespace App\Http\Controllers\Admin\Grafik\KerjasamaTridharma;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KerjasamaTridharmaPendidikan;
use App\Models\KerjasamaTridharmaPenelitian;
use App\Models\KerjasamaTridharmaPengmas;

class GabunganKerjasamaController extends Controller
{
    public function index()
    {
        // Contoh model yang kamu punya, sesuaikan nama model dan field-nya
        $totalPenelitian = KerjasamaTridharmaPenelitian::count();
        $totalPengabdian = KerjasamaTridharmaPengmas::count();
        $totalPendidikan = KerjasamaTridharmaPendidikan::count();

        $totals = [
            'Penelitian' => $totalPenelitian,
            'Pengabdian' => $totalPengabdian,
            'Pendidikan' => $totalPendidikan,
            
        ];
        

        return view('pages.admin.petugas.grafik.kerjasama-tridharma.gabungan.index', compact('totals'));
    }
}
