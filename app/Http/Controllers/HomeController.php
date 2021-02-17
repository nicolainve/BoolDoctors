<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialization;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $specializations = Specialization::all();
        return view('guest.home', compact('specializations'));
    }
}
