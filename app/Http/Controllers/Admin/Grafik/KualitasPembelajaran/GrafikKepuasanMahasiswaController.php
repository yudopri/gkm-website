<?php

namespace App\Http\Controllers\Admin\Grafik\KualitasPembelajaran;

use App\Http\Controllers\Controller;
use App\Models\KepuasanMahasiswa;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikKepuasanMahasiswaController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = KepuasanMahasiswa::join('tahun_ajaran_semester', 'kepuasan_mahasiswa.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(kepuasan_mahasiswa.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.kualitas-pembelajaran.kepuasan_mahasiswa.index', compact('data'));
    }
}
