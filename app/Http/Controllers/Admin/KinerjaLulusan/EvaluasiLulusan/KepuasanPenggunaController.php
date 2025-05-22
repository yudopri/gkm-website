<?php

namespace App\Http\Controllers\Admin\KinerjaLulusan\EvaluasiLulusan;

use App\Http\Controllers\Controller;
use App\Models\EvalKepuasanPengguna;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KepuasanPenggunaController extends Controller
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

$kepuasanPengguna = EvalKepuasanPengguna::with('user')
    ->where('tahun', $tahun)
    ->get()
    ->groupBy('tahun') // Group berdasarkan tahun
    ->map(function ($group) {
        return [
            'tahun' => $group->first()->tahun,
            'jumlah_lulusan' => $group->sum('jumlah_lulusan'),
            'jumlah_responden' => $group->sum('jumlah_responden'),
            'ids' => $group->pluck('id'), // Jika perlu ID untuk aksi edit/delete
        ];
    })->values(); // Optional: reset keys
    
    $detailkepuasanPengguna = EvalKepuasanPengguna::with('user')
    ->where('tahun', $tahun)
    ->get()
    ->groupBy('jenis_kemampuan')
    ->map(function ($items) {
        return [
            'jenis_kemampuan' => $items->first()->jenis_kemampuan,
            'tingkat_kepuasan_sangat_baik' => $items->sum('tingkat_kepuasan_sangat_baik'),
            'tingkat_kepuasan_baik' => $items->sum('tingkat_kepuasan_baik'),
            'tingkat_kepuasan_cukup' => $items->sum('tingkat_kepuasan_cukup'),
            'tingkat_kepuasan_kurang' => $items->sum('tingkat_kepuasan_kurang'),
            'rencana_tindakan' => $items->first()->rencana_tindakan,
            'id' => $items->first()->id,
        ];
    })->values(); // untuk me-reset key agar bisa di-loop di blade


            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.index', [
                'kepuasan_pengguna' => $kepuasanPengguna,
                'detail_kepuasan_pengguna' => $detailkepuasanPengguna,
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
            $EvalKepuasanPengguna = new EvalKepuasanPengguna();
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.form', [
                'kepuasan_pengguna' => $EvalKepuasanPengguna,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Tambah Data',
                'form_action' => route('admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.store', $tahunAjaran),
                'form_method' => "POST",
            ]);
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
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'jenis_kemampuan' => 'required|string|max:255',
                'tingkat_kepuasan_sangat_baik' => 'required|numeric',
                'tingkat_kepuasan_baik' => 'required|numeric',
                'tingkat_kepuasan_cukup' => 'required|numeric',
                'tingkat_kepuasan_kurang' => 'required|numeric',
                'rencana_tindakan' => 'required|string',
                'jumlah_lulusan' => 'required|integer',
                'jumlah_responden' => 'required|integer',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            // dd($validated);

            $create = EvalKepuasanPengguna::create($validated);
            if ($create) {
                return redirect()->route('admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.index', $tahunAjaran)
                    ->with('toast_success', 'Data kepuasan_pengguna dtps berhasil ditambahkan');
            }

            throw new \Exception('Data kepuasan_pengguna dtps gagal ditambahkan');
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
            $dosen = User::with('profile', 'eval_kepuasan_pengguna')->whereId($id)->firstOrFail();

            return view('pages.admin.petugas.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.detail', [
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
            $kepuasan_pengguna = EvalKepuasanPengguna::with('user')->find($id);
            $tahunAjaranObj = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail();
            $tahunAjaranId = $tahunAjaranObj->id;
            $tahun = $tahunAjaranObj->tahun_ajaran;
            return view('pages.admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.form', [
                'kepuasan_pengguna' => $kepuasan_pengguna,
                'tahun_ajaran' => $tahunAjaran,
                'tahun' => $tahun,
                'form_title' => 'Edit Data',
                'form_action' => route('admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.update', [
                    'tahunAjaran' => $tahunAjaran,
                    'kepuasanId' => $kepuasan_pengguna->id,
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
    public function update(Request $request, string $tahunAjaran, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'jenis_kemampuan' => 'required|string|max:255',
                'tingkat_kepuasan_sangat_baik' => 'required|numeric',
                'tingkat_kepuasan_baik' => 'required|numeric',
                'tingkat_kepuasan_cukup' => 'required|numeric',
                'tingkat_kepuasan_kurang' => 'required|numeric',
                'rencana_tindakan' => 'required|string',
                'jumlah_lulusan' => 'required|integer',
                'jumlah_responden' => 'required|integer',
                'tahun' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->messages()->all()[0])->withInput();
            }

            $validated = $request->all();

            $dosenPraktisi = EvalKepuasanPengguna::findOrFail($id);
            $update = $dosenPraktisi->update($validated);
            if ($update) {
                return redirect()->route('admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.index', $tahunAjaran)
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
            $dosenPraktisi = EvalKepuasanPengguna::findOrFail($id);
            $delete = $dosenPraktisi->delete();

            if ($delete) {
                return redirect()->route('admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.index', $tahunAjaran)
                    ->with('toast_success', 'Data dosen praktisi berhasil dihapus');
            }

            throw new \Exception('Data dosen praktisi gagal dihapus');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
