<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Info;
use Carbon\Carbon;

class DoctorController extends Controller
{
    public function index(Request $request) {

        /* FILTER BY SPEC */
        $spec = $request->spec;
        $avg = $request->avg;
        $count = $request->count;

        $now = Carbon::now();

        $doctors = Info::leftJoin('info_vote', 'infos.id', '=', 'info_vote.info_id')
                    ->join('info_specialization', 'infos.id', '=', 'info_specialization.info_id')
                    ->leftJoin('info_sponsor', 'infos.id', '=', 'info_sponsor.info_id')
                    ->select('infos.id', 'infos.name', 'infos.surname', 'infos.slug', 'infos.photo',
                            DB::raw('round(avg(info_vote.vote_id), 1) as average'),
                            DB::raw('count(info_vote.info_id) as count'))
                    ->where('info_specialization.specialization_id', '=', $spec)
                    ->when($avg, function ($query) use ($avg) {
                        return $query->havingBetween('average', [$avg, $avg + 0.9]);
                    })
                    ->when($count, function ($query) use ($count) {
                        return $query->having('count', '>=', $count);
                    })
                    ->groupBy('infos.id', 'infos.name', 'infos.surname', 'infos.slug','info_sponsor.expired_at', 'infos.photo')
                    ->when('info_sponsor.expired_at' > $now, function ($query) {
                        return $query->orderBy('info_sponsor.expired_at', 'desc');
                    })
                    ->with('specializations')
                    ->get();

        return response()->json($doctors);
    }

    public function reviews(Request $request) {
        $id = $request->id;

        $now = Carbon::now();

        for ($i = 1; $i < 13; $i++) {
            $reviews = DB::table('reviews')
                    ->select('reviews.info_id', DB::raw('count(reviews.info_id) as count'))
                    ->where('reviews.info_id', '=', $id)
                    ->whereYear('created_at', '=', $now->year)
                    ->whereMonth('created_at', '=', $i)
                    ->groupBy('reviews.info_id')
                    ->get();

            if(!sizeof($reviews)) {
                $reviews = 0;
                $tot1[] = $reviews;
            } else {
                $tot1[] = $reviews[0]->count;
            }
        }

        $totale[] = $tot1;
        $years = ($now->year) - 3;

        for ($i = $years; $i <= $now->year; $i++) {
            $reviews = DB::table('reviews')
                    ->select('reviews.info_id', DB::raw('count(reviews.info_id) as count'))
                    ->where('reviews.info_id', '=', $id)
                    ->whereYear('created_at', '=', $i)
                    ->groupBy('reviews.info_id')
                    ->get();

            if(!sizeof($reviews)) {
                $reviews = 0;
                $tot2[] = $reviews;
            } else {
                $tot2[] = $reviews[0]->count;
            }
        }

        $totale[] = $tot2;
        
        return response()->json($totale);
    }

    public function messages(Request $request) {
        $id = $request->id;

        $now = Carbon::now();

        for ($i = 1; $i < 13; $i++) {
            $messages = DB::table('messages')
                    ->select('messages.info_id', DB::raw('count(messages.info_id) as count'))
                    ->where('messages.info_id', '=', $id)
                    ->whereYear('created_at', '=', $now->year)
                    ->whereMonth('created_at', '=', $i)
                    ->groupBy('messages.info_id')
                    ->get();

            if(!sizeof($messages)) {
                $messages = 0;
                $tot1[] = $messages;
            } else {
                $tot1[] = $messages[0]->count;
            }
        }

        $totale[] = $tot1;
        $years = ($now->year) - 3;

        for ($i = $years; $i <= $now->year; $i++) {
            $messages = DB::table('messages')
                    ->select('messages.info_id', DB::raw('count(messages.info_id) as count'))
                    ->where('messages.info_id', '=', $id)
                    ->whereYear('created_at', '=', $i)
                    ->groupBy('messages.info_id')
                    ->get();

            if(!sizeof($messages)) {
                $messages = 0;
                $tot2[] = $messages;
            } else {
                $tot2[] = $messages[0]->count;
            }
        }

        $totale[] = $tot2;
        
        return response()->json($totale);
    }
}