<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Specialization;

class SpecializationController extends Controller
{
    public function index(){
        $specializations = Specialization :: all();
        return response()-> json($specializations);
    }
}
