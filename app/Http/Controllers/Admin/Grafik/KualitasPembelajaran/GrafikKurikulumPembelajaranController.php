<?php

namespace App\Http\Controllers\Admin\Grafik\KualitasPembelajaran;

use App\Http\Controllers\Controller;
use App\Models\KurikulumPembelajaran;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikKurikulumPembelajaranController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = KurikulumPembelajaran::join('tahun_ajaran_semester', 'kurikulum_pembelajaran.semester', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(kurikulum_pembelajaran.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.kualitas-pembelajaran.kurikulum_pembelajaran.index', compact('data'));
    }
}
