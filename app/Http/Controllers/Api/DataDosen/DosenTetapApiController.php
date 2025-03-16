<?php

namespace App\Http\Controllers\Admin\DataDosen;

use App\Models\DosenTetapPT;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\JabatanFungsional;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaranSemester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DosenTetapApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $userId = Auth::id();
            $tahunAjaranId = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;

            $dosenTetap = DosenTetapPT::with('user')
                ->where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->paginate(8);


            return response()->json($dosenTetap, Response::HTTP_OK);
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
                'nama_dosen' => 'required|string|max:255',
                'nidn_nidk' => 'required|numeric',
                'gelar_magister' => 'required|string',
                'gelar_doktor' => 'nullable|string',
                'bidang_keahlian' => 'nullable|string|max:255',
                'kesesuaian_kompetensi' => 'nullable|boolean',
                'jabatan_akademik' => ['nullable', 'string', Rule::exists(JabatanFungsional::class, 'nama')],
                'sertifikat_pendidik' => 'nullable|string',
                'sertifikat_kompetensi' => 'nullable|string',
                'mk_diampu' => 'nullable|string',
                'kesesuaian_keahlian_mk' => 'nullable|boolean',
                'mk_ps_lain' => 'nullable|string',
            ]);

            $validated = $request->all();
            $validated['user_id'] = Auth::id();
            $validated['tahun_ajaran_id'] = TahunAjaranSemester::where('slug', $tahunAjaran)->firstOrFail()->id;
            $validated['kesesuaian_kompetensi'] = $request->has('kesesuaian_kompetensi') ? 1 : 0;
            $validated['kesesuaian_keahlian_mk'] = $request->has('kesesuaian_keahlian_mk') ? 1 : 0;
            $create = DosenTetapPT::create($validated);

            return response()->json($create, Response::HTTP_CREATED);
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

            return response()->json($dosen, Response::HTTP_OK);
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
                'nama_dosen' => 'required|string|max:255',
                'nidn_nidk' => 'required|numeric',
                'gelar_magister' => 'required|string',
                'gelar_doktor' => 'nullable|string',
                'bidang_keahlian' => 'nullable|string|max:255',
                'kesesuaian_kompetensi' => 'nullable|boolean',
                'jabatan_akademik' => ['nullable', 'string', Rule::exists(JabatanFungsional::class, 'nama')],
                'sertifikat_pendidik' => 'nullable|string',
                'sertifikat_kompetensi' => 'nullable|string',
                'mk_diampu' => 'nullable|string',
                'kesesuaian_keahlian_mk' => 'nullable|boolean',
                'mk_ps_lain' => 'nullable|string',
            ]);


            $validated = $request->all();
            $validated['kesesuaian_kompetensi'] = $request->has('kesesuaian_kompetensi') ? 1 : 0;
            $validated['kesesuaian_keahlian_mk'] = $request->has('kesesuaian_keahlian_mk') ? 1 : 0;

            $dosenTetap = DosenTetapPT::findOrFail($id);
            $update = $dosenTetap->update($validated);
            return response()->json($update, Response::HTTP_OK);
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
            $dosenTetap = DosenTetapPT::findOrFail($id);
            $delete = $dosenTetap->delete();

            return response()->json(['message' => 'Dosen Tetap deleted'], Response::HTTP_OK);

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
