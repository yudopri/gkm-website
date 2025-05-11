<?php

namespace App\Http\Controllers\Admin\Grafik\DataDosen;

use App\Http\Controllers\Controller;
use App\Models\DosenIndustriPraktisi;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikDosenPraktisiController extends Controller
{
    public function index()
    {
        // Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
        $data = DosenIndustriPraktisi::join('tahun_ajaran_semester', 'dosen_industri_praktisi.tahun_ajaran_id', '=', 'tahun_ajaran_semester.id')
            ->select(
                DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"), 
                DB::raw("COUNT(*) AS total_kerjasama")
            )
            ->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester') // Grup berdasarkan tahun_ajaran dan semester
            ->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc') // Urutkan berdasarkan tahun_ajaran
            ->get(); // Ambil data

        // Kirim data ke view
        return view('pages.admin.petugas.grafik.data-dosen.dosen_praktisi.index', compact('data'));
    }
}
