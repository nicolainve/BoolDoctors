<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Info;
use App\Vote;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index() {
        $doctors = DB::table('infos')
            ->select('infos.surname', 'infos.name', 'infos.id', DB::raw('COUNT(reviews.info_id) as review_tot'))
            ->join('reviews', 'infos.id', '=', 'reviews.info_id')
            ->groupBy('infos.surname', 'infos.name', 'infos.id')
            ->get();
            foreach ($doctors as $doctor) {
                $average = DB::table('votes')
                ->select(DB::raw('avg(info_vote.vote_id) as vote_average'))
                ->join('info_vote', 'info_vote.vote_id', '=', 'votes.id')
                ->where('info_vote.info_id', $doctor->id)
                ->get();
                $doctor->vote_average = $average[0]->vote_average;
            }
        return response()->json($doctors);
    }
}