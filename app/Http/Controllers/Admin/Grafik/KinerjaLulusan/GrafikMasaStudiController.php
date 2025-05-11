<?php

namespace App\Http\Controllers\Admin\Grafik\KinerjaLulusan;

use App\Http\Controllers\Controller;
use App\Models\MasaStudiLulusan;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikMasaStudiController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = MasaStudiLulusan::join('tahun_ajaran_semester', 'masa_studi_lulusan.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(masa_studi_lulusan.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.kinerja-lulusan.masa_studi.index', compact('data'));
    }
}
