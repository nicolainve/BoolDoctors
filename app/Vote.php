<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /**
     * DB RELATIONS
     */
    
    // Relation Info Many-To-Many
    public function infos() {
        return $this->belongsToMany('App\Info');
    }
}
