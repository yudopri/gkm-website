<?php

namespace App\Http\Controllers\Admin\RekapData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaranSemester;
class HkiHakCipta2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($tahun_ajaran)
    {
    $tahunAjaranList = TahunAjaranSemester::all()->map(function ($item) {
        $item->tahun_ajaran = str_replace('&', '-', $item->tahun_ajaran);
        return $item;
    });
        return view('pages.admin.rekap-data.luaran-penelitian-pkm-lainnya-hki-hak-cipta-desain-produk-industri.index', compact('tahun_ajaran', 'tahunAjaranList'));
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
