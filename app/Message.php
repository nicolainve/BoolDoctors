<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{   
    protected $fillable = [
        'info_id',
        'author',
        'mail',
        'body',
    ];
    /**
     * DB RELATIONS
     */

    // Relation User One-To-Many
    public function user() {
        return $this->belongsTo('App\Info');
    }
}
