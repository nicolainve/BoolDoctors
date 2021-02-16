<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Info;

class DoctorController extends Controller
{
    public function index() {
        // $doctors = Info::specializations()->all();

        $doctors = Info::join('info_specialization', 'infos.id', '=', 'info_specialization.info_id')
                            ->join('specializations', 'info_specialization.info_id', '=', 'specializations.id')
                            ->get();
        
        return response()->json($doctors);
    }
}
