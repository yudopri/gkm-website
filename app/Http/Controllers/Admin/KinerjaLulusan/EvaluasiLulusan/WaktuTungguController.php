<?php

namespace App\Http\Controllers\Admin\KinerjaLulusan\EvaluasiLulusan;

use App\Http\Controllers\Controller;
use App\Models\EvalWaktuTunggu;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WaktuTungguController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $waktuTunggu = EvalWaktuTunggu::with('user')->get();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
        $tahunAjaranId = $tahunAjaranObj->id;
        $tahun = $tahunAjaranObj->tahun_ajaran;
            $diploma = EvalWaktuTunggu::with('user')
            ->where('masa_studi', 'Diploma Tiga')
            ->where('tahun', $tahun)
            ->get();

        $sarjana = EvalWaktuTunggu::with('user')
            ->where('masa_studi', 'Sarjana/Sarjana Terapan')
            ->where('tahun', $tahun)
            ->get();
            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.kinerja-lulusan.evaluasi-lulusan.waktu-tunggu.index', [
                'waktu_tunggu' => $waktuTunggu,
                'diploma' => $diploma,
                'sarjana' => $sarjana,
                'tahun_ajaran' => $tahunAjaran,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */


    public function create(string $tahunAjaran)
{
    try {
        $EvalWaktuTunggu = new EvalWaktuTunggu();
        $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
        $tahunAjaranId = $tahunAjaranObj->id;
        $tahun = $tahunAjaranObj->tahun_ajaran;

        $masaStudi = request()->query('masaStudi'); // ambil dari query string

        return view('pages.admin.kinerja-lulusan.evaluasi-lulusan.waktu-tunggu.form', [
            'EvalWaktuTunggu' => $EvalWaktuTunggu,
            'tahun_ajaran' => $tahunAjaran,
            'tahun' => $tahun,
            'masaStudi' => $masaStudi, // lempar ke view
            'form_title' => 'Tambah Data',
            'form_action' => route('admin.kinerja-lulusan.evaluasi-lulusan.waktu-tunggu.store', $tahunAjaran),
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
                'jumlah_lulusan' => 'required|numeric',
                'jumlah_lulusan_terlacak' => 'required|numeric',
                'jumlah_lulusan_terlacak_dipesan' => 'nullable|numeric',
                'jumlah_lulusan_waktu_tiga_bulan' => 'required|numeric',
                'jumlah_lulusan_waktu_enam_bulan' => 'required|numeric',
                'jumlah_lulusan_waktu_sembilan_bulan' => 'required|numeric',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            // dd($validated);

            $create = EvalWaktuTunggu::create($validated);
            if ($create) {
                return redirect()->route('admin.kinerja-lulusan.evaluasi-lulusan.waktu-tunggu.index', $tahunAjaran)
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
        try {
            $dosen = User::with('profile', 'dosen_tetap')->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.data-dosen.detail-dosen-tetap', [
                'data_dosen' => $dosen,
                'dosenId' => $dosen->id,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $tahunAjaran,string $id)
    {
        try {
            $EvalWaktuTunggu = EvalWaktuTunggu::with('user')->first();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            $masaStudi = request()->query('masaStudi'); // ambil dari query string


            return view('pages.admin.kinerja-lulusan.evaluasi-lulusan.waktu-tunggu.form', [
                'EvalWaktuTunggu' => $EvalWaktuTunggu,
                'tahun_ajaran' => $tahunAjaran,
                'masaStudi' => $masaStudi, // lempar ke view
                'tahun' => $tahun,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.kinerja-lulusan.evaluasi-lulusan.waktu-tunggu.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'waktuId' => $EvalWaktuTunggu->id,
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
                'masa_studi' => 'nullable|string',
                'jumlah_lulusan' => 'required|numeric',
                'jumlah_lulusan_terlacak' => 'required|numeric',
                'jumlah_lulusan_terlacak_dipesan' => 'nullable|numeric',
                'jumlah_lulusan_waktu_tiga_bulan' => 'required|numeric',
                'jumlah_lulusan_waktu_enam_bulan' => 'required|numeric',
                'jumlah_lulusan_waktu_sembilan_bulan' => 'required|numeric',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $dosenPraktisi = EvalWaktuTunggu::findOrFail($id);
            $update = $dosenPraktisi->update($validated);
            if ($update) {
                return redirect()->route('admin.kinerja-lulusan.evaluasi-lulusan.waktu-tunggu.index', $tahunAjaran)
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
            $EvalWaktuTunggu = EvalWaktuTunggu::findOrFail($id);
            $delete = $EvalWaktuTunggu->delete();

            if ($delete) {
                return redirect()->route('admin.kinerja-lulusan.evaluasi-lulusan.waktu-tunggu.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen praktisi berhasil dihapus');
            }

            throw new \Exception('Data dosen praktisi gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
}
}
