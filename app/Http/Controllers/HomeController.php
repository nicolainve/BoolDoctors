<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialization;
use App\Info;
use App\Review;
use Illuminate\Support\Facades\DB;

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
        return view('guest.home', compact('specializations'));
    }

    public function show($slug)
    {
        // $info = Info::find($slug);
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

        // dd($info);

        return view('guest.infos.show', compact('info', 'reviews'));
    }

    public function store(Request $request)
    {
        $newReview = new Review();
        $data = $request->all();
        $data['product_id'] = (int)$data['product_id'];
        $data['rating'] = (int)$data['rating'];

        // validation
        $request->validate($this->ruleValidation());
        
        $newReview->fill($data);

        $created = $newReview->save();

        if($created) {
            $product = Product::where('id', $newReview->product_id)->first();
            return redirect()->route('products.show', $product->slug);
        }
        
    }
}
