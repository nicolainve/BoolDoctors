<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Info;
use App\Vote;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $request->validate($this->validationRules());
               

        $newReview = new Review();

        $data = $request->all();
        // dd($data);
        $data['info_id'] = (int)$data['info_id'];
        
        $newReview->fill($data);
        // $newVote->fill($data);
        
        $created = $newReview->save();
        // $created = $newVote->save();

        $info = Info::where('id', $newReview->info_id)->first();
        $info->votes()->attach($data['vote']);

        if($created) {
            return redirect()->route('guest.infos.show', $info->slug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // FUNCTION VALIDATION
    private function  validationRules(){
        return [
            'author'=> 'required',
            'body' => 'required',
            'vote' => 'required'
        ];
    }
}
