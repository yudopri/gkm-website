<?php

namespace App\Http\Controllers\Admin\KinerjaDosen;

use App\Http\Controllers\Controller;
use App\Models\PublikasiIlmiahDosen;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PublikasiIlmiahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
{
    try {
        // Fetch the Year Object and ensure it's valid
        $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
        $tahunAjaranId = $tahunAjaranObj->id;
        $tahun = $tahunAjaranObj->tahun_ajaran;

        $userId = Auth::id();

        // Get the totals grouped by 'jenis_artikel' for the given year and user
        $totals = PublikasiIlmiahDosen::where('user_id', $userId)
            ->whereNull('deleted_at')  // Soft delete check
            ->where('tahun', $tahun)
            ->groupBy('jenis_artikel')
            ->selectRaw('jenis_artikel, COUNT(judul_artikel) as total')
            ->get();  // Get results as a collection

        // Return the view with just the total counts and unique 'jenis_artikel'
        return view('pages.admin.kinerja-dosen.publikasi-ilmiah.index', [
            'totals' => $totals,
            'tahun_ajaran' => $tahunAjaran,
            'tahun' => $tahun,
        ]);
    } catch (\Exception $e) {
        // Log the error for debugging purposes
        \Log::error('Error fetching Publikasi Ilmiah Dosen data: ' . $e->getMessage());

        // Return back with the error message
        return back()->withErrors($e->getMessage());
    }
}
public function detail(string $tahunAjaran,string $jenisArtikel)
{
    try {
        // Fetch the Year Object and ensure it's valid
        $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
        $tahunAjaranId = $tahunAjaranObj->id;
        $tahun = $tahunAjaranObj->tahun_ajaran;

        $userId = Auth::id();

        // Get the publication details
        $publikasi = PublikasiIlmiahDosen::where('user_id', $userId)
            ->whereNull('deleted_at')
            ->where('tahun', $tahun)
            ->where('jenis_artikel', $jenisArtikel)
            ->get();  // Fetch the publication details



        // Return the view with the fetched data
        return view('pages.admin.kinerja-dosen.publikasi-ilmiah.detail', [
            'publikasi' => $publikasi,
            'tahun_ajaran' => $tahunAjaran,
            'tahun' => $tahun,
        ]);
    } catch (\Exception $e) {
        // Log the error for debugging purposes
        \Log::error('Error fetching Publikasi Ilmiah Dosen data: ' . $e->getMessage());

        // Return back with the error message
        return back()->withErrors('There was an error fetching the publication details. Please try again.');
    }
}



    /**
     * Show the form for creating a new resource.
     */
    public function create(string $tahunAjaran)
    {
        try {
            $publikasi = new PublikasiIlmiahDosen();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.kinerja-dosen.publikasi-ilmiah.form', [
                'publikasi_ilmiah' => $publikasi,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.kinerja-dosen.publikasi-ilmiah.store', $tahunAjaran),
                'form_method' => "POST",
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,string $tahunAjaran)
    {
        try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'nama_dosen' => 'required|string',
                'judul_artikel' => 'required|string',
                'jenis_artikel' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            // dd($validated);

            $create = PublikasiIlmiahDosen::create($validated);
            if ($create) {
                return redirect()->route('admin.kinerja-dosen.publikasi-ilmiah.index', $tahunAjaran)
                    ->with('toast_success', 'Data rekognisi dtps berhasil ditambahkan');
            }

            throw new \Exception('Data rekognisi dtps gagal ditambahkan');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
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
    public function edit(string $id,string $tahunAjaran)
    {
        try {
            $publikasi = PublikasiIlmiahDosen::with('user')->first();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;

            return view('pages.admin.kinerja-dosen.publikasi-ilmiah.form', [
                'publikasi_ilmiah' => $publikasi,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.kinerja-dosen.publikasi-ilmiah.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'publikasiId' => $publikasi->id,
                ]),
                'form_method' => "PUT",
            ]);
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
                'nama_dosen' => 'required|string',
                'judul_artikel' => 'required|string',
                'jenis_artikel' => 'required|string',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $dosenPraktisi = PublikasiIlmiahDosen::findOrFail($id);
            $update = $dosenPraktisi->update($validated);
            if ($update) {
                return redirect()->route('admin.kinerja-dosen.publikasi-ilmiah.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen praktisi berhasil diupdate');
            }

            throw new \Exception('Data dosen praktisi gagal diupdate');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,string $tahunAjaran)
    {
        try {
            $publikasi = PublikasiIlmiahDosen::findOrFail($id);
            $delete = $dosenPraktisi->delete();

            if ($delete) {
                return redirect()->route('admin.kinerja-dosen.publikasi-ilmiah.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen praktisi berhasil dihapus');
            }

            throw new \Exception('Data dosen praktisi gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
