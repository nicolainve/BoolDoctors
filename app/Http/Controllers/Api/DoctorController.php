<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Info;

class DoctorController extends Controller
{
    public function index(Request $request) {

        /* FILTER BY SPEC */
        $spec = $request->spec;
        $avg = $request->avg;
        $count = $request->count;

        $doctors = Info::join('info_vote', 'infos.id', '=', 'info_vote.info_id')
                    ->join('reviews', 'infos.id', '=', 'reviews.info_id')
                    ->join('info_specialization', 'infos.id', '=', 'info_specialization.info_id')
                    ->select('infos.id', 'infos.name', 'infos.surname', 'infos.slug',
                            DB::raw('round(avg(info_vote.vote_id), 1) as average'),
                            DB::raw('count(reviews.info_id) / 3 as count'))
                    ->where('info_specialization.specialization_id', '=', $spec)
                    ->when($avg, function ($query) use ($avg) {
                        return $query->having('average', '>=', $avg);
                    })
                    ->when($count, function ($query) use ($count) {
                        return $query->having('count', '>=', $count);
                    })
                    ->groupBy('infos.id', 'infos.name', 'infos.surname', 'infos.slug')
                    ->with('specializations')
                    ->get();

        return response()->json($doctors);
    }

    public function reviews(Request $request) {
        $id = $request->id;

        for ($i = 1; $i < 13; $i++) {
            $reviews = DB::table('reviews')
                    ->select('reviews.info_id', DB::raw('count(reviews.info_id) as count'))
                    ->where('reviews.info_id', '=', 1)
                    ->whereYear('created_at', '=', 2021)
                    ->whereMonth('created_at', '=', $i)
                    ->groupBy('reviews.info_id')
                    ->get();

            if(!sizeof($reviews)) {
                $reviews = 0;
                $tot[] = $reviews;
            } else {
                $tot[] = $reviews[0]->count;
            }
        }
        // for ($i = 2018; $i < 2022; $i++) {
        //     $reviews = DB::table('reviews')
        //             ->select('reviews.info_id', DB::raw('count(reviews.info_id) as count'))
        //             ->where('reviews.info_id', '=', 1)
        //             ->whereYear('created_at', '=', $i)
        //             ->groupBy('reviews.info_id')
        //             ->get();

        //     if(!sizeof($reviews)) {
        //         $reviews = 0;
        //         $tot[] = $reviews;
        //     } else {
        //         $tot[] = $reviews[0]->count;
        //     }
        // }
        return response()->json($tot);
    }

    public function messages(Request $request) {
        $id = $request->id;

        for ($i = 1; $i < 13; $i++) {
            $messages = DB::table('messages')
                    ->select('messages.info_id', DB::raw('count(messages.info_id) as count'))
                    ->where('messages.info_id', '=', 1)
                    ->whereYear('created_at', '=', 2021)
                    ->whereMonth('created_at', '=', $i)
                    ->groupBy('messages.info_id')
                    ->get();

            if(!sizeof($messages)) {
                $messages = 0;
                $tot[] = $messages;
            } else {
                $tot[] = $messages[0]->count;
            }
        }
        // for ($i = 2018; $i < 2022; $i++) {
        //     $messages = DB::table('messages')
        //             ->select('messages.info_id', DB::raw('count(messages.info_id) as count'))
        //             ->where('messages.info_id', '=', 1)
        //             ->whereYear('created_at', '=', $i)
        //             ->groupBy('messages.info_id')
        //             ->get();

        //     if(!sizeof($messages)) {
        //         $messages = 0;
        //         $tot[] = $messages;
        //     } else {
        //         $tot[] = $messages[0]->count;
        //     }
        // }
        return response()->json($tot);
    }
}