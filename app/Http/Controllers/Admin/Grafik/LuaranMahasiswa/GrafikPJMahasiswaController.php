<?php

namespace App\Http\Controllers\Admin\Grafik\LuaranMahasiswa;

use App\Http\Controllers\Controller;
use App\Models\ProdukJasaMahasiswa;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikPJMahasiswaController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = ProdukJasaMahasiswa::join('tahun_ajaran_semester', 'produk_jasa_mahasiswa.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(produk_jasa_mahasiswa.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.luaran-karya-mahasiswa.produk_mahasiswa.index', compact('data'));
    }
}
