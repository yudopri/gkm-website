<?php

namespace App\Http\Controllers\Admin\RekapData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use App\Http\Controllers\Admin\RekapData\RekapUtamaController;

class KerjasamaTridharmaPendidikan2Controller extends Controller
{
    /**
     * Tampilkan halaman rekap kerjasama tridharma.
     *
     * @param string $tahun_ajaran (slug format, contoh: 2024-2025-ganjil)
     * @param int $dosenId
     */
    public function index($tahun_ajaran, int $dosenId)
    {
        // 1. Ambil semua tahun ajaran untuk dropdown
        $tahunAjaranList = TahunAjaranSemester::orderBy('id', 'desc')->get();

        // 2. Validasi user (dosen)
        $user = User::find($dosenId);
        if (! $user) {
            abort(404, 'Dosen tidak ditemukan.');
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

        // 5. Ambil rekap berdasarkan user + tahun yang dimasukkan ke request
        $rekapArray = (new RekapUtamaController)->getRekap($dosenId);

        // 6. Definisikan key Tridharma
        $tridharmaKeys = [
            'kerjasama_tridharma_pendidikan',
            'kerjasama_tridharma_penelitian',
            'kerjasama_tridharma_pengmas',
        ];

        $tridharmaKeyAliases = [
            'kerjasama_tridharma_pendidikan' => 'Tabel 1.1 Kerjasama Tridharma - Pendidikan',
            'kerjasama_tridharma_penelitian' => 'Tabel 1.2 Kerjasama Tridharma - Penelitian',
            'kerjasama_tridharma_pengmas'    => 'Tabel 1.3 Kerjasama Tridharma - Pengabdian kepada Masyarakat',
        ];

        // 7. Format data ke bentuk rows
        $rows = array_map(function ($key) use ($rekapArray, $tridharmaKeyAliases) {
            return [
                'label'      => $tridharmaKeyAliases[$key] ?? ucwords(str_replace('_', ' ', $key)),
                'count'      => $rekapArray[$key]['count'] ?? 0,
                'keterangan' => $rekapArray[$key]['status'] ?? 'belum diisi',
            ];
        }, $tridharmaKeys);

        // 8. Kirim ke view
        return view('pages.admin.rekap-data.kerjasama-tridharma.index', [
            'tahun_ajaran'    => $tahun_ajaran,
            'tahunAjaranList' => $tahunAjaranList,
            'dosenId'         => $dosenId,
            'dosen'           => $user,
            'rows'            => $rows,
        ]);
    }

    // Optional: resource methods
    public function create() {}
    public function store(Request $request) {}
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
