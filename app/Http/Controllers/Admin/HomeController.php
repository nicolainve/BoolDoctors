<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Message;
use App\Review;
use App\Vote;

class HomeController extends Controller
{
    public function index() {
        // $messages = Message::all();
        // $reviews = Review::all();

        // return view('admin.home');
        $messages = Message::where('info_id', Auth::user()->info['id'])->get();
        $reviews = Review::where('info_id', Auth::user()->info['id'])->get();
        dd($messages, $reviews);
        // dd($reviews);
        return view('admin.home', compact('messages', 'reviews'));

    }


}
