<?php

namespace App\Http\Controllers\Admin\RekapData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use App\Models\SeleksiMahasiswaBaru;
use App\Models\Rekap; // DTO Rekap
use App\Http\Controllers\Admin\RekapData\RekapUtamaController;

class KerjasamaTridharmaPendidikan2Controller extends Controller
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
        $tridharmaKeys = [
            'kerjasama_tridharma_pendidikan',
            'kerjasama_tridharma_penelitian',
            'kerjasama_tridharma_pengmas',
        ];
    
        $tridharmaKeyAliases = [
            'kerjasama_tridharma_pendidikan' => 'kerjasama tridharma pendidikan',
            'kerjasama_tridharma_penelitian' => 'kerjasama tridharma penelitian',
            'kerjasama_tridharma_pengmas' => 'kerjasama tridharma pengabdian',
            
        ];
    
        // Gunakan array_map untuk memproses data
        $rows = array_map(function ($key) use ($rekapArray, $tridharmaKeyAliases) {
            return [
                'label'     => $tridharmaKeyAliases[$key] ?? ucwords(str_replace('_', ' ', $key)),
                'count'     => $rekapArray[$key]['count'] ?? 0,
                'keterangan'=> $rekapArray[$key]['status'] ?? 'belum diisi',
            ];
        }, $tridharmaKeys);
    
        // 5. Pass ke view
        return view('pages.admin.rekap-data.kerjasama-tridharma.index', [
            'tahun_ajaran'    => $tahun_ajaran,
            'tahunAjaranList' => $tahunAjaranList,
            'dosen'           => $user,
            'rows'            => $rows,
        ]);
    }

    // resource methods lain tidak berubah
    public function create() {}
    public function store(Request $request) {}
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
