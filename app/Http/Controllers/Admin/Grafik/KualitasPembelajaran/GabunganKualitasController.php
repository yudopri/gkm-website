<?php

namespace App\Http\Controllers\Admin\Grafik\KualitasPembelajaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IntegrasiPenelitian;
use App\Models\KepuasanMahasiswa;
use App\Models\KurikulumPembelajaran;

class GabunganKualitasController extends Controller
{
    public function index()
    {
        // Contoh model yang kamu punya, sesuaikan nama model dan field-nya
        $totalIP = IntegrasiPenelitian::count();
        $totalKM = KepuasanMahasiswa::count();
        $totalKurikulum = KurikulumPembelajaran::count();

        $totals = [
            'Integrasi Penelitian' => $totalIP,
            'Kepuasan Mahasiswa' => $totalKM,
            'Kurikulum Pembelajaran' => $totalKurikulum, 
        ];
        

        return view('pages.admin.petugas.grafik.kualitas-pembelajaran.gabungan.index', compact('totals'));
    }
}
