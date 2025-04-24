<?php

namespace App\Http\Controllers\Admin\KinerjaLulusan;

use App\Http\Controllers\Controller;
use App\Models\MasaStudiLulusan;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MasaStudiLulusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
{
    try {
        $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
        $tahunAjaranId = $tahunAjaranObj->id;
        $tahun = $tahunAjaranObj->tahun_ajaran;
        $diploma = MasaStudiLulusan::with('user')
            ->where('masa_studi', 'Diploma Tiga')
            ->where('tahun', $tahun)
            ->get();

        $sarjana = MasaStudiLulusan::with('user')
            ->where('masa_studi', 'Sarjana/Sarjana Terapan')
            ->where('tahun', $tahun)
            ->get();

        $magister = MasaStudiLulusan::with('user')
            ->where('masa_studi', 'Magister/Magister Terapan')
            ->where('tahun', $tahun)
            ->get();

        $title = 'Hapus Data!';
        $text = "Apakah kamu yakin ingin menghapus?";
        confirmDelete($title, $text);

        return view('pages.admin.kinerja-lulusan.masa-studi-lulusan.index', [
            'diploma' => $diploma,
            'sarjana' => $sarjana,
            'magister' => $magister,
            'tahun_ajaran' => $tahunAjaran,
        ]);
    } catch (\Exception $e) {
        return back()->withErrors($e->getMessage());
    }
}


    public function create(string $tahunAjaran)
{
    try {
        $masaStudiLulusan = new MasaStudiLulusan();
        $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
        $tahunAjaranId = $tahunAjaranObj->id;
        $tahun = $tahunAjaranObj->tahun_ajaran;

        $masaStudi = request()->query('masaStudi'); // ambil dari query string

        return view('pages.admin.kinerja-lulusan.masa-studi-lulusan.form', [
            'MasaStudiLulusan' => $masaStudiLulusan,
            'tahun_ajaran' => $tahunAjaran,
            'tahun' => $tahun,
            'masaStudi' => $masaStudi, // lempar ke view
            'form_title' => 'Tambah Data',
            'form_action' => route('admin.kinerja-lulusan.masa-studi-lulusan.store', $tahunAjaran),
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
                'masa_studi' => 'nullable|string',
                'jumlah_mhs_diterima' => 'required|numeric',
                'jumlah_mhs_lulus_akhir_ts' => 'required|numeric',
                'jumlah_mhs_lulus_akhir_ts_1' => 'required|numeric',
                'jumlah_mhs_lulus_akhir_ts_2' => 'required|numeric',
                'jumlah_mhs_lulus_akhir_ts_3' => 'required|numeric',
                'jumlah_mhs_lulus_akhir_ts_4' => 'required|numeric',
                'jumlah_mhs_lulus_akhir_ts_5' => 'required|numeric',
                'jumlah_mhs_lulus_akhir_ts_6' => 'required|numeric',
                'jumlah_lulusan' => 'required|numeric',
                'mean_masa_studi' => 'required|numeric',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            // dd($validated);

            $create = MasaStudiLulusan::create($validated);
            if ($create) {
                return redirect()->route('admin.kinerja-lulusan.masa-studi-lulusan.index', $tahunAjaran)
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
    public function edit(string $tahunAjaran,string $id)
    {
        try {
            $MasaStudiLulusan = MasaStudiLulusan::with('user')->first();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            $masaStudi = request()->query('masaStudi'); // ambil dari query string


            return view('pages.admin.kinerja-lulusan.masa-studi-lulusan.form', [
                'MasaStudiLulusan' => $MasaStudiLulusan,
                'tahun_ajaran' => $tahunAjaran,
                'masaStudi' => $masaStudi, // lempar ke view
                'tahun' => $tahun,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.kinerja-lulusan.masa-studi-lulusan.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'masastudiId' => $MasaStudiLulusan->id,
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
    public function update(Request $request, string $tahunAjaran,string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'masa_studi' => 'required|string',
                'jumlah_mhs_diterima' => 'required|numeric',
                'jumlah_mhs_lulus_akhir_ts' => 'required|numeric',
                'jumlah_mhs_lulus_akhir_ts_1' => 'required|numeric',
                'jumlah_mhs_lulus_akhir_ts_2' => 'required|numeric',
                'jumlah_mhs_lulus_akhir_ts_3' => 'required|numeric',
                'jumlah_mhs_lulus_akhir_ts_4' => 'required|numeric',
                'jumlah_mhs_lulus_akhir_ts_5' => 'required|numeric',
                'jumlah_mhs_lulus_akhir_ts_6' => 'required|numeric',
                'jumlah_lulusan' => 'required|numeric',
                'mean_masa_studi' => 'required|numeric',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $dosenPraktisi = MasaStudiLulusan::findOrFail($id);
            $update = $dosenPraktisi->update($validated);
            if ($update) {
                return redirect()->route('admin.kinerja-lulusan.masa-studi-lulusan.index', $tahunAjaran)
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
    public function destroy(string $tahunAjaran,string $id)
    {
        try {
            $MasaStudiLulusan = MasaStudiLulusan::findOrFail($id);
            $delete = $MasaStudiLulusan->delete();

            if ($delete) {
                return redirect()->route('admin.kinerja-lulusan.masa-studi-lulusan.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen praktisi berhasil dihapus');
            }

            throw new \Exception('Data dosen praktisi gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
