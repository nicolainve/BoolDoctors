<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Info;

class DoctorController extends Controller
{
    public function index() {
        $doctors = Info::all();
        
        return response()->json($doctors);
    }
}
