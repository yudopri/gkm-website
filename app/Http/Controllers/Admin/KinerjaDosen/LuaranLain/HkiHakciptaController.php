<?php

namespace App\Http\Controllers\Admin\KinerjaDosen\LuaranLain;

use App\Http\Controllers\Controller;
use App\Models\HkiHakciptaDosen;
use Illuminate\Http\Request;

class HkiHakciptaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tahunAjaran)
    {
        try {
            $hki = HkiHakciptaDosen::with('user')->get();

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.kinerja-dosen.luaran-lain.hki-hakcipta.index', [
                'hki_hakcipta' => $hki,
                'tahun_ajaran' => $tahunAjaran,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
