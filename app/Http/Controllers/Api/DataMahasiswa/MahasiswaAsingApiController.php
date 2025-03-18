<?php

namespace App\Http\Controllers\Api\DataMahasiswa;

use App\Http\Controllers\Controller;
use App\Models\MahasiswaAsing;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MahasiswaAsingApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
{
    try {
        // Get the logged-in user's ID
        $userId = Auth::id();

        // Fetch the `tahun_ajaran_id` using the provided slug, or fail if not found
        $tahunAjaranId = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

        // Fetch MahasiswaAsing records for the logged-in user and the provided tahun_ajaran_id
        $mhsAsing = MahasiswaAsing::with('user')
            ->where('user_id', $userId)
            ->where('tahun_ajaran_id', $tahunAjaranId)
            ->paginate(5);

        $totals = MahasiswaAsing::selectRaw('
            SUM(mhs_aktif) as total_mhs_aktif,
            SUM(mhs_asing_fulltime) as total_mhs_asing_fulltime,
            SUM(mhs_asing_parttime) as total_mhs_asing_parttime
        ')->first();

        // Set title and text for delete confirmation (Ensure this JS function exists and works on the front-end)
        $title = 'Hapus Data!';
        $text = "Apakah kamu yakin ingin menghapus?";
        confirmDelete($title, $text); // Assuming this is a custom JS function for delete confirmation

        // Return the view with the fetched data
        return response()->json($mhsAsing,$totals, Response::HTTP_OK);
    } catch (\Exception $e) {
        // In case of any error, return with error message
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
                'mhs_aktif' => 'nullable|numeric',
                'mhs_asing_fulltime' => 'nullable|numeric',
                'mhs_asing_parttime' => 'nullable|numeric',
            ]);



            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $validated['tahun_ajaran_id'] = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;
            $create = MahasiswaAsing::create($validated);


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
            $dosen = User::with('profile', 'seleksi_maba')->whereId($id)->firstOrFail();

            return response()->json($dosen, Response::HTTP_OK);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'mhs_aktif' => 'nullable|numeric',
                'mhs_asing_fulltime' => 'nullable|numeric',
                'mhs_asing_parttime' => 'nullable|numeric',
            ]);



            $validated = $request->all();

            $mhsAsing = MahasiswaAsing::findOrFail($id);
            $update = $mhsAsing->update($validated);
            return response()->json($update, Response::HTTP_OK);

            throw new \Exception('Data mahasiswa asing gagal diupdate');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $tahunAjaran, string $id)
    {
        try {
            $mhsAsing = MahasiswaAsing::findOrFail($id);
            $delete = $mhsAsing->delete();

            return response()->json(['message' => 'Mahasiswa Asing deleted'], Response::HTTP_OK);

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
