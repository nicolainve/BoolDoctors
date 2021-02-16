<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Info;

class DoctorController extends Controller
{
    public function index() {

        $doctors = Info::with(['votes', 'specializations'])->get();
        // dd($doctors);

        return response()->json($doctors);
    }
}
