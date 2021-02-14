<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Info;
use App\Specialization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = Info::where('user_id', Auth::id())
            ->get();

        return view('admin.infos.index', compact('infos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specializations = Specialization::all();

        return view('admin.infos.create', compact('specializations'));
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

        //inserire validazione


        $data['user_id'] = Auth::id();  //cerchiamo la user_id dell'utente loggato

        $slug = $data['name'] . ' ' .  $data['surname'];
        $data['slug'] = Str::slug($slug, '-');

        //per salvare un record creiamo un'istanza del modello
        $newInfo = new Info();
        $newInfo->fill($data); //fillable nel model!!
        $saved = $newInfo->save();

        if ($saved) {
            $newInfo->specializations()->attach($data['specializations']);
            return redirect()->route('admin.home');
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
        $info = Info::find($id);

        return view('admin.infos.show', compact('info'));
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
}
