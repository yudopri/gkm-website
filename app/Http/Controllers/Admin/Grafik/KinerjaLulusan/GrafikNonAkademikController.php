<?php

namespace App\Http\Controllers\Admin\Grafik\KinerjaLulusan;

use App\Http\Controllers\Controller;
use App\Models\PrestasiNonakademikMhs;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikNonAkademikController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = PrestasiNonakademikMhs::join('tahun_ajaran_semester', 'prestasi_nonakademik_mhs.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(prestasi_nonakademik_mhs.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.kinerja-lulusan.non_akademik.index', compact('data'));
    }
}
