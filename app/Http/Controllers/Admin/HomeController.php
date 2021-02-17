<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Message;
use App\Review;
use App\Vote;
use App\Info;
use App\Specialization;

class HomeController extends Controller
{
    public function index() {
        // No Profile
        if (!Auth::user()->info) {
            
            $specializations = Specialization::all();

            return view('admin.infos.create', compact('specializations'));
        }
        // Profile
         else {
            $messages = Message::where('info_id', Auth::user()->info['id'])->orderBy('created_at', 'desc')->get();
            $reviews = Review::where('info_id', Auth::user()->info['id'])->orderBy('created_at', 'desc')->get();
            $info = Info::find(Auth::user()->info['id']);

            return view('admin.home', compact('messages', 'reviews', 'info'));
        
        }

    }

}
