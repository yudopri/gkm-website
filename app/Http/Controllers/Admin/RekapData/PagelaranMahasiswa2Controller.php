<?php

namespace App\Http\Controllers\Admin\RekapData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use App\Models\SeleksiMahasiswaBaru;
use App\Models\Rekap; // DTO Rekap
use App\Http\Controllers\Admin\RekapData\RekapUtamaController;

class PagelaranMahasiswa2Controller extends Controller
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
    // 3. Ambil objek tahun ajaran berdasarkan slug
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
        $luaranMHSKeys = [
        'publikasi_mahasiswa',
        'sitasi_karya_mahasiswa',
        'produk_jasa_mahasiswa',
        'hki_paten_mahasiswa',
        'hki_hakcipta_mahasiswa',
        'teknologi_karya_mahasiswa',
        'buku_chapter_mahasiswa'
              
        ];
    
        $luaranMHSKeyAliases = [
            'publikasi_mahasiswa' => 'Tabel 8.f.1| Pagelaran/Pameran/Presentasi/Publikasi Ilmiah Mahasiswa	',
        'sitasi_karya_mahasiswa' => 'Tabel 8.f.2| Karya Ilmiah Mahasiswa yang Disitasi	',
        'produk_jasa_mahasiswa' => 'Tabel 8.f.3| Produk/Jasa Mahasiswa yang Diadopsi oleh Industri/Masyarakat',
        'hki_paten_mahasiswa'=>'Tabel 8.f.4| Luaran Penelitian yang Dihasilkan Mahasiswa - HKI (Paten, Paten Sederhana)	',
        'hki_hakcipta_mahasiswa'=>'Tabel 8.f.5| Luaran Penelitian yang Dihasilkan Mahasiswa - HKI (Hak Cipta, Desain Produk Industri, dll.)	',
        'teknologi_karya_mahasiswa'=>'Tabel 8.f.6| Luaran Penelitian yang Dihasilkan Mahasiswa - Teknologi Tepat Guna, Produk, Karya Seni, Rekayasa Sosial	',
        'buku_chapter_mahasiswa' =>'Tabel 8.f.7| Luaran Penelitian yang Dihasilkan Mahasiswa - Buku ber-ISBN, Book Chapter	'
              
        ];
    
        // Gunakan array_map untuk memproses data
        $rows = array_map(function ($key) use ($rekapArray, $luaranMHSKeyAliases) {
            return [
                'label'     => $luaranMHSKeyAliases[$key] ?? ucwords(str_replace('_', ' ', $key)),
                'count'     => $rekapArray[$key]['count'] ?? 0,
                'keterangan'=> $rekapArray[$key]['status'] ?? 'belum diisi',
            ];
        }, $luaranMHSKeys);
    
        // 5. Pass ke view
        return view('pages.admin.rekap-data.pagelaran-pameran-presentasi-publikasi-ilmiah-mahasiswa.index', [
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
