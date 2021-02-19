<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{   
    public $timestamps = false;

    protected $fillable = [
        'vote',
    ];

    /**
     * DB RELATIONS
     */
    
    // Relation Info Many-To-Many
    public function infos() {
        return $this->belongsToMany('App\Info');
    }
}
