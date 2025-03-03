<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            return view('pages.admin.petugas.index');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
