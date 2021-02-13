<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    // Relation Info Many-To-Many
    public function infos() {
        return $this->belongsToMany('App\Info');
    }
}
