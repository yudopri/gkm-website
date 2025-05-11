<?php

namespace App\Http\Controllers\Admin\Grafik\LuaranMahasiswa;

use App\Http\Controllers\Controller;
use App\Models\BukuChapterMahasiswa;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikBCMhsController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = BukuChapterMahasiswa::join('tahun_ajaran_semester', 'buku_chapter_mahasiswa.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(buku_chapter_mahasiswa.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.luaran-karya-mahasiswa.buku_chapter_mahasiswa.index', compact('data'));
    }
}
