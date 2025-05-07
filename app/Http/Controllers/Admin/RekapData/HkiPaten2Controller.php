<?php

namespace App\Http\Controllers\Admin\RekapData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use App\Models\SeleksiMahasiswaBaru;
use App\Models\Rekap; // DTO Rekap
use App\Http\Controllers\Admin\RekapData\RekapUtamaController;
class HkiPaten2Controller extends Controller
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
        $hkiKeys = [
            'hki_hakcipta_dosen',
            'hki_paten_dosen',
            'teknologi_karya_dosen',
            'buku_chapter_dosen',
               
        ];
    
        $hkiKeyAliases = [
           'hki_hakcipta_dosen' => 'Tabel 3.b.7| Luaran Penelitian/PkM Lainnya - HKI (Paten, Paten Sederhana)',
            'hki_paten_dosen' => 'Tabel 3.b.8| Luaran Penelitian/PkM Lainnya - HKI (Hak Cipta, Desain Produk Industri, dll.)',
            'teknologi_karya_dosen' => 'Tabel 3.b.9| Luaran Penelitian/PkM Lainnya - Teknologi Tepat Guna, Produk, Karya Seni, Rekayasa Sosial',
            'buku_chapter_dosen' =>'Tabel 3.b.10| Luaran Penelitian/PkM Lainnya - Buku ber-ISBN, Book Chapter',
            
        ];
    
        // Gunakan array_map untuk memproses data
        $rows = array_map(function ($key) use ($rekapArray, $hkiKeyAliases) {
            return [
                'label'     => $hkiKeyAliases[$key] ?? ucwords(str_replace('_', ' ', $key)),
                'count'     => $rekapArray[$key]['count'] ?? 0,
                'keterangan'=> $rekapArray[$key]['status'] ?? 'belum diisi',
            ];
        }, $hkiKeys);
    
        // 5. Pass ke view
        return view('pages.admin.rekap-data.luaran-lainnya.index', [
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
