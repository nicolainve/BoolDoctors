<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Specialization;

class DoctorController extends Controller
{
    public function index() {

       if (!empty($_GET['type'])){

        $searchName = $_GET['type'];
        $doctors = Specialization::where('type','like', "%$searchName%")->with('infos')->get();

        };

        return response()->json($doctors);
    }
}