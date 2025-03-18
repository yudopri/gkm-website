<?php

namespace App\Http\Controllers\Api\Dosen;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaranSemester;
use Illuminate\Http\Request;

class TahunAjaranApiController extends Controller
{
    public function index()
    {
        return response()->json(TahunAjaranSemester::all()->reverse(), Response::HTTP_OK);
    }
}
