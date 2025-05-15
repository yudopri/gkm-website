<?php

namespace App\Http\Controllers\Admin\Grafik\PenelitianDTPS;

use App\Http\Controllers\Controller;
use App\Models\DtpsRujukanTesis;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikRujukanTesisController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = DtpsRujukanTesis::join('tahun_ajaran_semester', 'dtps_rujukan_tesis.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(dtps_rujukan_tesis.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.penelitian-dtps.rujukan_tesis.index', compact('data'));
    }
}
