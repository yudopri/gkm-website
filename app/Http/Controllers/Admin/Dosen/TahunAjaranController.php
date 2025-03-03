<?php

namespace App\Http\Controllers\Admin\Dosen;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaranSemester;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        try {
            $tahunAjaran = TahunAjaranSemester::all()->reverse();
            return view('pages.admin.dosen.tahun-ajaran.index', [
                'tahun_ajaran' => $tahunAjaran,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
