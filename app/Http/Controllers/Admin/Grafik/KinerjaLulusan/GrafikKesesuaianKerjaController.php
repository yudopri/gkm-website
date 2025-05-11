<?php

namespace App\Http\Controllers\Admin\Grafik\KinerjaLulusan;

use App\Http\Controllers\Controller;
use App\Models\EvalKesesuaianKerja;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikKesesuaianKerjaController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = EvalKesesuaianKerja::join('tahun_ajaran_semester', 'eval_kesesuaian_kerja.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(eval_kesesuaian_kerja.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.kinerja-lulusan.kesesuaian_kerja.index', compact('data'));
    }
}
