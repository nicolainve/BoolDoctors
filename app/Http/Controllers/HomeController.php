<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialization;
use App\Info;
use App\Review;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        /**
         * Fake image
         */

        $fakeImg = [
            'avatar/1.png',
            'avatar/2.png',
            'avatar/4.png',
            'avatar/5.png',
            'avatar/6.png',
            'avatar/7.png',
            'avatar/8.png',
            'avatar/9.png',
            'avatar/10.png',
            'avatar/11.png',
            'avatar/12.png',
            'avatar/13.png',
            'avatar/14.png',
            'avatar/15.png',
            'avatar/16.png',
            'avatar/17.png',
        ];
        $now = Carbon::now();

        $doctors = Info::whereHas('sponsors')
                    ->join('info_sponsor', 'infos.id', '=', 'info_sponsor.info_id')
                    ->with('specializations')
                    ->whereDate('info_sponsor.expired_at', '>', $now)
                    ->get();

        return view('guest.home', compact('specializations', 'doctors', 'fakeImg'));
    }

    public function show($slug)
    {
        $info = Info::where('slug', $slug)->first();
        $reviews = Review::where('info_id', $info->id )->orderBy('created_at', 'desc')->get();
        $average = DB::table('votes')
                        ->select(DB::raw('round(avg(info_vote.vote_id), 1) as average'))
                        ->join('info_vote', 'info_vote.vote_id', '=', 'votes.id')
                        ->where('info_vote.info_id', $info->id)
                        ->get();
        
        $info->average = $average[0]->average;

        if (empty($info)){
            abort('404');
        }

        /**
         * FAKE IMG
         */

        $fakeImg = [
            'avatar/1.png',
            'avatar/2.png',
            'avatar/4.png',
            'avatar/5.png',
            'avatar/6.png',
            'avatar/7.png',
            'avatar/8.png',
            'avatar/9.png',
            'avatar/10.png',
            'avatar/11.png',
            'avatar/12.png',
            'avatar/13.png',
            'avatar/14.png',
            'avatar/15.png',
            'avatar/16.png',
            'avatar/17.png',
        ];

        return view('guest.infos.show', compact('info', 'reviews', 'fakeImg'));
    }


}
