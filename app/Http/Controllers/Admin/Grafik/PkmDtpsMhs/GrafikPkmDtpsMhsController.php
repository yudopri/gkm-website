<?php

namespace App\Http\Controllers\Admin\Grafik\PkmDtpsMhs;

use App\Http\Controllers\Controller;
use App\Models\PkmDtpsMahasiswa;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikPkmDtpsMhsController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = PkmDtpsMahasiswa::join('tahun_ajaran_semester', 'pkm_dtps_mahasiswa.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(pkm_dtps_mahasiswa.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.pkm-dtps-mhs.index', compact('data'));
    }
}
