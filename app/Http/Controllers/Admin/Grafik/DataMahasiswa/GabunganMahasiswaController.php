<?php

namespace App\Http\Controllers\Admin\Grafik\DataMahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MahasiswaAsing;
use App\Models\SeleksiMahasiswaBaru;

class GabunganMahasiswaController extends Controller
{
    public function index()
    {
        // Contoh model yang kamu punya, sesuaikan nama model dan field-nya
        $totalMhsAsing = MahasiswaAsing::count();
        $totalSeleksiMhs = SeleksiMahasiswaBaru::count();

        $totals = [
            'Mahasiswa Asing' => $totalMhsAsing,
            'Seleksi Mahasiswa' => $totalSeleksiMhs
 
        ];
        

        return view('pages.admin.petugas.grafik.data-mahasiswa.gabungan.index', compact('totals'));
    }
}
