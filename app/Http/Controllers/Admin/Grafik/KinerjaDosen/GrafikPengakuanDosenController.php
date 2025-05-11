<?php

namespace App\Http\Controllers\Admin\Grafik\KinerjaDosen;

use App\Http\Controllers\Controller;
use App\Models\RekognisiDosen;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikPengakuanDosenController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = RekognisiDosen::join('tahun_ajaran_semester', 'rekognisi_dtps.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(rekognisi_dtps.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.kinerja-dosen.pengakuan_dosen.index', compact('data'));
    }
}
