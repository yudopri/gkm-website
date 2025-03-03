<?php

namespace App\Http\Controllers\Admin\Petugas;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\SeleksiMahasiswaBaru;

class ListDosenController extends Controller
{
    public function index()
    {
        try {
            $listDosen = User::with('profile')->role('dosen')->get();
            return view('pages.admin.petugas.list-dosen.index', [
                'list_dosen' => $listDosen,
            ]);
        } catch (\Exception $e) {
            // return back()->withErrors('Oops something went wrong!');
            return back()->withErrors($e->getMessage());
        }
    }

    public function exportPdf(string $dosenId)
    {
        try {
            $data = User::with([
                'profile',

                /* kerjasama tridharma */
                'kerjasama_tridharma_pendidikan',
                'kerjasama_tridharma_penelitian',
                'kerjasama_tridharma_pengmas',

                /* data mahasiswa */
                'seleksi_maba',
                'mahasiswa_asing',
            ])->whereId($dosenId)->firstOrFail();
            // dd($data);

            $total = SeleksiMahasiswaBaru::selectRaw('
                SUM(pendaftar) as total_pendaftar,
                SUM(lulus_seleksi) as total_lulus_seleksi,
                SUM(maba_reguler) as total_maba_reguler,
                SUM(maba_transfer) as total_maba_transfer,
                SUM(COALESCE(mhs_aktif_reguler, 0) + COALESCE(mhs_aktif_transfer, 0)) as total_mhs_aktif
            ')->first();

            $pdf = Pdf::loadView('pages.admin.petugas.list-dosen.print', compact('data', 'total'))->setPaper('legal', 'landscape');

            $filename = 'laporan-gkm-' . Str::slug($data->name) . '-' . time()  . '.pdf';

            return $pdf->stream($filename);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
