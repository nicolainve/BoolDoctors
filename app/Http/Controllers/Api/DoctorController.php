<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Info;

class DoctorController extends Controller
{
    public function index() {
        $doctors = info::all();
       if (!empty($_GET['type'])){
        // get Data search from Axios
           $searchName = '%'. $_GET['type'] . '%';
        //    get doctors who has specializations like query with Many-to-many relation
           $doctors = Info::whereHas('specializations', function($query) use($searchName){
               return $query->where('type', 'like', $searchName);
            })->with('specializations', 'votes', 'reviews')->get();
        };
        return response()->json($doctors);
    }
}