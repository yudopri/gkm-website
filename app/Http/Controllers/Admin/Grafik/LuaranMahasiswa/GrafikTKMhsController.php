<?php

namespace App\Http\Controllers\Admin\Grafik\LuaranMahasiswa;

use App\Http\Controllers\Controller;
use App\Models\TeknologiKaryaMahasiswa;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikTKMhsController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = TeknologiKaryaMahasiswa::join('tahun_ajaran_semester', 'teknologi_karya_mahasiswa.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(teknologi_karya_mahasiswa.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.luaran-karya-mahasiswa.teknologi_karya.index', compact('data'));
    }
}
