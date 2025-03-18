<?php

namespace App\Http\Controllers\Api\Dosen;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaranSemester;
use Illuminate\Http\Response;

class TahunAjaranApiController extends Controller
{
    public function index()
    {
        return response()->json(TahunAjaranSemester::all()->reverse(), Response::HTTP_OK);
    }
}
