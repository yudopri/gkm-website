<?php

namespace App\Http\Controllers\Admin\Grafik\KinerjaDosen;

use App\Http\Controllers\Controller;
use App\Models\PublikasiIlmiahDosen;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikPublikasiIlmiahController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = PublikasiIlmiahDosen::join('tahun_ajaran_semester', 'publikasi_ilmiah_dosen.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(publikasi_ilmiah_dosen.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.kinerja-dosen.publikasi_ilmiah.index', compact('data'));
    }
}
