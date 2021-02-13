<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Relation User One-To-Many
    public function user() {
        return $this->belongsTo('App\Info');
    }
}
