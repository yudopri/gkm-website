<?php

namespace App\Http\Controllers\Admin\RekapData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use App\Models\SeleksiMahasiswaBaru;
use App\Models\Rekap; // DTO Rekap
use App\Http\Controllers\Admin\RekapData\RekapUtamaController;

class DosenTetap2Controller extends Controller
{
     /**
     * Tampilkan halaman rekap kerjasama tridharma.
     * Sekarang menerima parameter tahun ajaran dan dosen_id.
     *
     * @param string $tahun_ajaran
     * @param int    $dosenId
     */
public function index($tahun_ajaran, int $dosenId)
{
    // 1. Daftar tahun ajaran untuk dropdown
   $tahunAjaranList = TahunAjaranSemester::orderBy('id', 'desc')->get();

    // 2. Validasi dosen_id
    $user = User::find($dosenId);
    if (! $user) {
        abort(404, 'Dosen tidak ditemukan');
    }

    $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahun_ajaran)->first();
        if (! $tahunAjaranObj) {
            abort(404, 'Tahun ajaran tidak ditemukan.');
        }

        // 4. Inject ke dalam request untuk digunakan oleh RekapUtamaController
        request()->merge([
            'tahun'    => $tahunAjaranObj->tahun_ajaran,
            'semester' => $tahunAjaranObj->semester,
        ]);

    // 3. Ambil data rekap seluruh metrik
    $rekapArray = (new RekapUtamaController)->getRekap($dosenId);

    // 4. Filter hanya key tridharma
    $dosenKeys = [
        'dosen_tetap_pt',
        'dosen_pembimbing_ta',
        'ewmp_dosen',
        'dosen_tidak_tetap',
        'dosen_industri_praktisi'
    ];

    $dosenKeyAliases = [
        'dosen_tetap_pt' => 'Tabel 3.a.1) Dosen Tetap Perguruan Tinggi',
        'dosen_pembimbing_ta' => 'Tabel 3.a.2) Dosen Pembimbing Utama Tugas Akhir',
        'ewmp_dosen' => 'Tabel 3.a.3) Ekuivalen Waktu Mengajar Penuh (EWMP) Dosen Tetap Perguruan Tinggi',
        'dosen_tidak_tetap' => 'Tabel 3.a.4) Dosen Tidak Tetap',
        'dosen_industri_praktisi' => 'Tabel 3.a.5) Dosen Industri/Praktisi'
    ];

    // Gunakan array_map untuk memproses data
    $rows = array_map(function ($key) use ($rekapArray, $dosenKeyAliases) {
        return [
            'label'     => $dosenKeyAliases[$key] ?? ucwords(str_replace('_', ' ', $key)),
            'count'     => $rekapArray[$key]['count'] ?? 0,
            'min'       => $rekapArray[$key]['min'] ?? '-', 
            'keterangan'=> $rekapArray[$key]['status'] ?? 'belum diisi',
        ];
    }, $dosenKeys);

    // Tambahkan rasio ke data rows
    $rasioDosenTetap = $rekapArray['dosen_tetap_pt_ratio'] ?? 'n/a';
    $rows[] = [
        'label'     => 'Rasio Dosen Tetap : Mahasiswa Aktif',
        'count'     => $rasioDosenTetap,
       'min'       => '-', 
        'keterangan'=> 'Rasio dosen tetap terhadap mahasiswa aktif reguler',
    ];

    // Hitung persentase dosen tidak tetap terhadap dosen tetap
    $dosenTetap = $rekapArray['dosen_tetap_pt']['count'] ?? 0;
    $dosenTidakTetap = $rekapArray['dosen_tidak_tetap']['count'] ?? 0;
    $persentaseTidakTetap = $dosenTetap > 0 ? ($dosenTidakTetap / $dosenTetap) * 100 : 0;

    // Tambahkan persentase ke data rows
    $rows[] = [
        'label'     => 'Persentase Dosen Tidak Tetap',
        'count'     => round($persentaseTidakTetap, 2) . '%',
        'min'       => '-', 
        'keterangan'=> $persentaseTidakTetap > 30
            ? 'Jumlah dosen tidak tetap melebihi 30%'
            : 'Jumlah dosen tidak tetap sesuai',
    ];

    // 5. Pass ke view
    return view('pages.admin.rekap-data.dosen.index', [
            'tahun_ajaran'    => $tahun_ajaran,
            'tahunAjaranList' => $tahunAjaranList,
            'dosenId'         => $dosenId,
            'dosen'           => $user,
            'rows'            => $rows,
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}