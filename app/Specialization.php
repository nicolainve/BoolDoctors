<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    public $timestamps = false;

    /**
     * DB RELATIONS
     */
    
    // Relation Info Many-To-Many
    public function infos() {
        return $this->belongsToMany('App\Info');
    }
}
