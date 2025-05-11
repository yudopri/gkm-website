<?php

namespace App\Http\Controllers\Admin\Grafik\KinerjaDosen;

use App\Http\Controllers\Controller;
use App\Models\ProdukTeradopsiDosen;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikProdukJasaController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = ProdukTeradopsiDosen::join('tahun_ajaran_semester', 'produk_teradopsi_dosen.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(produk_teradopsi_dosen.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.kinerja-dosen.produk_jasa.index', compact('data'));
    }
}
