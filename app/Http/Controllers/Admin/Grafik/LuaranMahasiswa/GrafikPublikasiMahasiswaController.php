<?php

namespace App\Http\Controllers\Admin\Grafik\LuaranMahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PublikasiMahasiswa;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikPublikasiMahasiswaController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = PublikasiMahasiswa::join('tahun_ajaran_semester', 'publikasi_mahasiswa.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(publikasi_mahasiswa.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.luaran-karya-mahasiswa.publikasi_mahasiswa.index', compact('data'));
    }
}
