<?php

namespace App\Http\Controllers\Admin\Grafik\LuaranMahasiswa;

use App\Http\Controllers\Controller;
use App\Models\HkiHakCiptaMahasiswa;
use Illuminate\Support\Facades\DB; // <-- ini penting

class GrafikHkiMhsCiptaController extends Controller
{
    public function index()
    {
// Mengambil data yang sudah digroup dan dihitung total kerjasama berdasarkan tahun dan semester
$data = HkiHakCiptaMahasiswa::join('tahun_ajaran_semester', 'hki_hakcipta_mahasiswa.tahun', '=', 'tahun_ajaran_semester.tahun_ajaran')
->select(
    DB::raw("CONCAT(tahun_ajaran_semester.tahun_ajaran, ' - ', tahun_ajaran_semester.semester) AS tahun_ajaran"),
    DB::raw("COUNT(hki_hakcipta_mahasiswa.id) AS total_kerjasama")
)
->groupBy('tahun_ajaran_semester.tahun_ajaran', 'tahun_ajaran_semester.semester')
->orderBy('tahun_ajaran_semester.tahun_ajaran', 'asc')
->get();
        // Kirim data ke view
        return view('pages.admin.petugas.grafik.luaran-karya-mahasiswa.hki_cipta.index', compact('data'));
    }
}
