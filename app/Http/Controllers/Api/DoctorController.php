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

    //reviews
    public function reviews(Request $request) {
        $id = $request->id;
        $reviewNumber = Info::join('reviews', 'infos.id', '=', 'reviews.info_id')
                    ->select('infos.id', 'infos.name', DB::raw('count(reviews.info_id) as count'))
                    ->where('infos.id', '=', $id)
                    ->groupBy('infos.id', 'infos.name')
                    ->with('reviews')
                    ->get();
        return response()->json($reviewNumber);
    }

    //messages
    public function messages(Request $request) {
        $id = $request->id;
        $messagesNumber = Info::join('messages', 'infos.id', '=', 'messages.info_id')
                    ->select('infos.id', 'infos.name', DB::raw('count(messages.info_id) as count'))
                    ->where('infos.id', '=', $id)
                    ->groupBy('infos.id', 'infos.name')
                    ->with('messages')
                    ->get();
        return response()->json($messagesNumber);
    }
}

// $doctors = DB::table('infos')
//         ->join('info_vote', 'infos.id', '=', 'info_vote.info_id')
//         ->join('reviews', 'infos.id', '=', 'reviews.info_id')
//         ->join('info_specialization', 'infos.id', '=', 'info_specialization.info_id')
//         ->select('infos.id', 'infos.name', 'infos.surname', 'infos.slug',
//                 DB::raw('round(avg(info_vote.vote_id), 1) as average'),
//                 DB::raw('count(reviews.info_id) / 3 as count'))
//         ->where('info_specialization.specialization_id', '=', $spec)
//         ->when($avg, function ($query) use ($avg) {
//             return $query->having('average', '>=', $avg);
//         })
//         ->when($count, function ($query) use ($count) {
//             return $query->having('count', '>=', $count);
//         })
//         ->groupBy('infos.id', 'infos.name', 'infos.surname', 'infos.slug')
//         ->get();

// /* ADD SPECIALIZATIONS */
// foreach ($doctors as $doctor) {
//     $specs = DB::table('specializations')
//                 ->select('specializations.type')
//                 ->join('info_specialization', 'specializations.id', '=', 'info_specialization.specialization_id')
//                 ->where('info_specialization.info_id', $doctor->id)
//                 ->get();
//     foreach ($specs as $spec) {
//         $doctor->specializations[] = $spec->type;
//     }
// }

// /* ADD REVIEWS */
// foreach ($doctors as $doctor) {
//     $countInt = DB::table('reviews')
//                 ->select('reviews.info_id', DB::raw('count(reviews.info_id) as countInt'))
//                 ->where('reviews.info_id', $doctor->id)
//                 ->groupBy('reviews.info_id')
//                 ->get();
//     $doctor->countInt = $countInt[0]->countInt;
// }

// /* ADD VOTES */
// foreach ($doctors as $doctor) {
//     $averageInt = DB::table('votes')
//                     ->select(DB::raw('round(avg(info_vote.vote_id), 1) as averageInt'))
//                     ->join('info_vote', 'info_vote.vote_id', '=', 'votes.id')
//                     ->where('info_vote.info_id', $doctor->id)
//                     ->get();
//     $doctor->averageInt = (float)$averageInt[0]->averageInt;
// }

/* OLD METHOD */

// $spec = $request->spec;
// $doctors = DB::table('infos')
// ->join('info_specialization', 'infos.id', '=', 'info_specialization.info_id')
// ->join('specializations', 'info_specialization.specialization_id', '=', 'specializations.id')
// ->select('infos.id','infos.name', 'infos.surname', 'infos.slug')
// ->where('specializations.type', 'like', $spec)
// ->groupBy('infos.id', 'infos.name', 'infos.surname', 'infos.slug')
// ->get();

// /* ADD REVIEWS */
// foreach ($doctors as $doctor) {
//     $tot = DB::table('reviews')
//                 ->select('reviews.info_id', DB::raw('count(reviews.info_id) as tot'))
//                 ->where('reviews.info_id', $doctor->id)
//                 ->groupBy('reviews.info_id')
//                 ->get();
//     $doctor->tot = $tot[0]->tot;
// }

// /* ADD VOTES */
// foreach ($doctors as $doctor) {
//     $average = DB::table('votes')
//                     ->select(DB::raw('round(avg(info_vote.vote_id), 1) as average'))
//                     ->join('info_vote', 'info_vote.vote_id', '=', 'votes.id')
//                     ->where('info_vote.info_id', $doctor->id)
//                     ->get();
//     $doctor->average = (float)$average[0]->average;
// }

// /* ADD SPECIALIZATIONS */
// foreach ($doctors as $doctor) {
//     $specs = DB::table('specializations')
//                 ->select('specializations.type')
//                 ->join('info_specialization', 'specializations.id', '=', 'info_specialization.specialization_id')
//                 ->where('info_specialization.info_id', $doctor->id)
//                 ->get();
//     foreach ($specs as $spec) {
//         $doctor->specializations[] = $spec->type;
//     }
// }

// /* FILTER BY AVERAGE AND/OR TOT */
// $average = $request->avg;
// $tot = $request->tot;

// $doctors = collect($doctors)
//         ->where('average', '>=', $average)
//         ->where('tot', '>=', $tot)
//         ->values();