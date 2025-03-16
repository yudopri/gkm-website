<?php

namespace App\Http\Controllers\Admin\DataMahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SeleksiMahasiswaBaru;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SeleksiMabaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranId = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

            $seleksiMaba = SeleksiMahasiswaBaru::with('user')
                ->where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->paginate(5);

            $totals = SeleksiMahasiswaBaru::selectRaw('
                SUM(pendaftar) as total_pendaftar,
                SUM(lulus_seleksi) as total_lulus_seleksi,
                SUM(maba_reguler) as total_maba_reguler,
                SUM(maba_transfer) as total_maba_transfer,
                SUM(COALESCE(mhs_aktif_reguler, 0) + COALESCE(mhs_aktif_transfer, 0)) as total_mhs_aktif
            ')->first();

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return response()->json($seleksiMaba, $totals, Response::HTTP_OK);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $tahunAjaran)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tahun_akademik' => 'required|string',
                'daya_tampung' => 'required|numeric',
                'pendaftar' => 'nullable|numeric',
                'lulus_seleksi' => 'nullable|numeric',
                'maba_reguler' => 'nullable|numeric',
                'maba_transfer' => 'nullable|numeric',
                'mhs_aktif_reguler' => 'nullable|numeric',
                'mhs_aktif_transfer' => 'nullable|numeric',
            ]);



            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $validated['tahun_ajaran_id'] = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;
            $create = SeleksiMahasiswaBaru::create($validated);

            return response()->json($create, Response::HTTP_CREATED);

            throw new \Exception('Data gagal ditambahhkan');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $dosen = User::with('profile', 'mahasiswa_asing')->whereId($id)->firstOrFail();

            $totals = SeleksiMahasiswaBaru::selectRaw('
                SUM(pendaftar) as total_pendaftar,
                SUM(lulus_seleksi) as total_lulus_seleksi,
                SUM(maba_reguler) as total_maba_reguler,
                SUM(maba_transfer) as total_maba_transfer,
                SUM(COALESCE(mhs_aktif_reguler, 0) + COALESCE(mhs_aktif_transfer, 0)) as total_mhs_aktif
            ')->first();

            // dd($dosen);

            return response()->json($dosen, $totals, Response::HTTP_OK);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,string $tahunAjaran)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tahun_akademik' => 'required|string',
                'daya_tampung' => 'required|numeric',
                'pendaftar' => 'nullable|numeric',
                'lulus_seleksi' => 'nullable|numeric',
                'maba_reguler' => 'nullable|numeric',
                'maba_transfer' => 'nullable|numeric',
                'mhs_aktif_reguler' => 'nullable|numeric',
                'mhs_aktif_transfer' => 'nullable|numeric',
            ]);



            $validated = $request->all();

            $seleksiMaba = SeleksiMahasiswaBaru::findOrFail($id);
            $update = $seleksiMaba->update($validated);
            return response()->json($update, Response::HTTP_OK);

            throw new \Exception('Data seleksi maba gagal diupdate');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $tahunAjaran,string $id)
    {
        try {
            $seleksiMaba = SeleksiMahasiswaBaru::findOrFail($id);
            $delete = $seleksiMaba->delete();

            return response()->json(['message' => 'Seleksi Maba deleted'], Response::HTTP_OK);

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
