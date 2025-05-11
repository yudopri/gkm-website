<?php

namespace App\Http\Controllers\Admin\Grafik\KinerjaLulusan;

use App\Http\Controllers\Controller;
use App\Models\PrestasiAkademikMhs;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikAkademikController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = PrestasiAkademikMhs::join('tahun_ajaran_semester', 'prestasi_akademik_mhs.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(prestasi_akademik_mhs.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.kinerja-lulusan.akademik.index', compact('data'));
    }
}
