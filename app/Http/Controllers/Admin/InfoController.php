<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Info;
use App\Specialization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

        // validazione
        $request->validate($this->ruleValidation());
        //cerchiamo la user_id dell'utente loggato
        $data['user_id'] = Auth::id(); 
         // slug
        $slug = $data['name'] . ' ' .  $data['surname']; 
        $data['slug'] = Str::slug($slug, '-');
        // check photo caricata
        if(!empty($data['photo'])) {
            $data['photo'] = Storage::disk('public')->put('images', $data['photo']);
        }

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
        $info = Info::find($id);

        $specializations = Specialization::all();

        $this->errorPages($info);

        return view('admin.infos.edit', compact('info', 'specializations'));
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

        $data = $request->all();
        $info = Info::find($id);
        $request->validate($this->ruleValidation());

        // slug
        $slug = $data['name'] . ' ' .  $data['surname'];
        $data['slug'] = Str::slug($slug, '-');

        // check photo
        if(!empty($data['photo'])) {
            if (!empty($info->photo)) {
                Storage::disk('public')->delete($info->photo);
            }
            $data['photo'] = Storage::disk('public')->put('images', $data['photo']);
        }

        $updated = $info->update($data);

        // check delle tag specializzazioni
        if($updated) {
            if (!empty($data['specializations'])) {
                $info->specializations()->sync($data['specializations']);
            } else {
                $info->specializations()->detach();
            }
            return redirect()->route('admin.infos.show', $info->id);
        } else {
            return redirect()->route('home');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Info $info)
    {
        $name = $info->name;
        $image = $info->photo; //TODO Fai check

        $info->specializations()->detach();
        $deleted = $info->delete();

        //check foto
        if($deleted) {
            if (!empty($info->photo)) {
                Storage::disk('public')->delete($info->photo);
            }
            return redirect()->route('admin.home')->with('info-delete', $name);
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * FUNCTIONS
     */
    

     // Error page
    private function errorPages($var)
    {
        if (empty($var)) {
            abort(404);
        }   
    }
    // Validation
    private function ruleValidation(){
        return [
            'name' => 'required',
            'surname' => 'required',
            // 'photo' => 'mimes:jpeg,bmp,png,jpg',
            'address'=> 'required',
            'specializations' => 'required'
        ];
    }
}
