<?php

namespace App\Http\Controllers\Admin\Grafik\KerjasamaTridharma;

use App\Http\Controllers\Controller;
use App\Models\KerjasamaTridharmaPenelitian;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikPenelitianController extends Controller
{
    public function index()
    {
        // Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
        $data = KerjasamaTridharmaPenelitian::join('tahun_ajaran_semester', 'kerjasama_tridharma_penelitian.tahun_ajaran_id', '=', 'tahun_ajaran_semester.id')
            ->select(
                DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"), 
                DB::raw("COUNT(*) AS total_kerjasama")
            )
            ->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester') // Grup berdasarkan tahun_ajaran dan semester
            ->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc') // Urutkan berdasarkan tahun_ajaran
            ->get(); // Ambil data

        // Kirim data ke view
        return view('pages.admin.petugas.grafik.kerjasama-tridharma.penelitian.index', compact('data'));
    }
}
