<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Message;
use App\Review;
use App\Vote;
use App\Specialization;

class HomeController extends Controller
{
    public function index() {
        if (!Auth::user()->info) {
            
            $specializations = Specialization::all();

            return view('admin.infos.create', compact('specializations'));
        } else {
            $messages = Message::where('info_id', Auth::user()->info['id'])->orderBy('created_at', 'desc')->get();
            $reviews = Review::where('info_id', Auth::user()->info['id'])->orderBy('created_at', 'desc')->get();
    
            return view('admin.home', compact('messages', 'reviews'));
        
        }
        
        

        

    }


}
