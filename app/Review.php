<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Relation Message One-To-Many
    public function info() {
        return $this->belongsTo('App\Info');
    }
}
