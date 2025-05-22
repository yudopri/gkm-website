<?php

namespace App\Http\Controllers\Admin\Grafik\PkmDtpsMhs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PkmDtpsMahasiswa;

class GabunganPkmMhsController extends Controller
{
    public function index()
    {
        // Contoh model yang kamu punya, sesuaikan nama model dan field-nya
        $totalPDM = PkmDtpsMahasiswa::count();

        $totals = [
            'PKM DTPS Mahasiswa' => $totalPDM,
        ];
        

        return view('pages.admin.petugas.grafik.pkm-dtps-mhs.gabungan.index', compact('totals'));
    }
}
