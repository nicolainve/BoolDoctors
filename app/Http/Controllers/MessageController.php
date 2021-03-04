<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Info;
use App\Message;

class MessageController extends Controller
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
        $newMessage = new Message();
        $data = $request->all();
        $request->validate($this->validationRules());
        $data['info_id'] = (int)$data['info_id'];
        
        $newMessage->fill($data);

        $created = $newMessage->save();

        if($created) {
            $info = Info::where('id', $newMessage->info_id)->first();
            $dottore = $info->surname;
            return redirect()->route('guest.infos.show', $info->slug)->with('message-succesed', $dottore);
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

    private function  validationRules(){
        return [
            'author'=> 'required',
            'mail' => 'required',
            'body' => 'required'
        ];
    }
}
