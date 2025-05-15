<?php

namespace App\Http\Controllers\Admin\RekapData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use App\Models\SeleksiMahasiswaBaru;
use App\Models\Rekap; // DTO Rekap
use App\Http\Controllers\Admin\RekapData\RekapUtamaController;
class SeleksiMahasiswa2Controller extends Controller
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
    $tahunAjaranList = TahunAjaranSemester::all()->map(function ($item) {
        $item->tahun_ajaran = str_replace('&', '-', $item->tahun_ajaran);
        return $item;
    });

    // 2. Validasi dosen_id
    $user = User::find($dosenId);
    if (! $user) {
        abort(404, 'Dosen tidak ditemukan');
    }

    // 3. Ambil data rekap seluruh metrik
    $rekapArray = (new RekapUtamaController)->getRekap($dosenId);

    // 4. Filter hanya key tridharma
    $mhsKeys = [
            'seleksi_mahasiswa_baru',
            'mahasiswa_asing',
            
            
              
        ];
    
        $mhsKeysAliases = [
            'seleksi_mahasiswa_baru' => 'Tabel 2.a Seleksi Mahasiswa',
            'mahasiswa_asing' => 'Tabel 2.b Mahasiswa Asing',
            
              
        ];
    
        // Gunakan array_map untuk memproses data
        $rows = array_map(function ($key) use ($rekapArray, $mhsKeysAliases) {
            return [
                'label'     => $mhsKeysAliases[$key] ?? ucwords(str_replace('_', ' ', $key)),
                'count'     => $rekapArray[$key]['count'] ?? 0,
                'keterangan'=> $rekapArray[$key]['status'] ?? 'belum diisi',
            ];
        }, $mhsKeys);

    // 5. Pass ke view
    return view('pages.admin.rekap-data.mahasiswa.index', [
        'tahun_ajaran'    => $tahun_ajaran,
        'tahunAjaranList' => $tahunAjaranList,
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