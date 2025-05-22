<?php

namespace App\Http\Controllers\Admin\Grafik\PenelitianDTPS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DtpsPenelitianMahasiswa;
use App\Models\DtpsRujukanTesis;

class GabunganPenelitianController extends Controller
{
    public function index()
    {
        // Contoh model yang kamu punya, sesuaikan nama model dan field-nya
        $totalPM = DtpsPenelitianMahasiswa::count();
        $totalRT = DtpsRujukanTesis::count();

        $totals = [
            'Penelitian Mahasiswa' => $totalPM,
            'Rujukan Tesis' => $totalRT
        ];
        

        return view('pages.admin.petugas.grafik.penelitian-dtps.gabungan.index', compact('totals'));
    }
}
