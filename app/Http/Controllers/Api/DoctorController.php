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

    $spec = '%' . $_GET['spec'] . '%';

    /* INFOS - FILTER BY SPECIALIZATION */
    $doctors = DB::table('infos')
                ->join('info_specialization', 'infos.id', '=', 'info_specialization.info_id')
                ->join('specializations', 'info_specialization.specialization_id', '=', 'specializations.id')
                ->select('infos.id','infos.name', 'infos.surname', 'infos.slug')
                ->where('specializations.type', 'like', $spec)
                ->groupBy('infos.id', 'infos.name', 'infos.surname', 'infos.slug')
                ->get();

    /* ADD REVIEWS */
    foreach ($doctors as $doctor) {
        $tot = DB::table('reviews')
                    ->select('reviews.info_id', DB::raw('count(reviews.info_id) as tot'))
                    ->where('reviews.info_id', $doctor->id)
                    ->groupBy('reviews.info_id')
                    ->get();
        $doctor->tot = $tot[0]->tot;
    }

    /* ADD AVERAGE */
    foreach ($doctors as $doctor) {
        $average = DB::table('votes')
                        ->select(DB::raw('round(avg(info_vote.vote_id), 1) as average'))
                        ->join('info_vote', 'info_vote.vote_id', '=', 'votes.id')
                        ->where('info_vote.info_id', $doctor->id)
                        ->get();
        $doctor->average = $average[0]->average;
    }

    /* ADD SPECIALIZATIONS */
    foreach ($doctors as $doctor) {
        $specs = DB::table('specializations')
                    ->select('specializations.type')
                    ->join('info_specialization', 'specializations.id', '=', 'info_specialization.specialization_id')
                    ->where('info_specialization.info_id', $doctor->id)
                    ->get();
        foreach ($specs as $spec) {
            $doctor->specializations[] = $spec->type;
        }
    }

    return response()->json($doctors);
    }
}