<?php

namespace App\Http\Controllers\Admin\KinerjaLulusan\EvaluasiLulusan;

use App\Http\Controllers\Controller;
use App\Models\EvalKepuasanPengguna;
use Illuminate\Http\Request;

class KepuasanPenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $kepuasanPengguna = EvalKepuasanPengguna::with('user')->get();

            $title = 'Hapus Data!';
            $text = "Apakah kamu yakin ingin menghapus?";
            confirmDelete($title, $text);

            return view('pages.admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.index', [
                'kepuasan_pengguna' => $kepuasanPengguna,
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
