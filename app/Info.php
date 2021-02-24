<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{   
    // Fillable
    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'address',
        'slug',
        'CV',
        'photo',
        'phone',
        'price'
    ];

    /**
     * DB RELATIONS
     */
    
     // Relation User One-To-One
    public function user() {
        return $this->belongsTo('App\User');
    }

    // Relation Message One-To-Many
    public function messages() {
        return $this->hasMany('App\Message');
    }

    // Relation Message One-To-Many
    public function reviews() {
        return $this->hasMany('App\Review');
    }

    // Relation Specialization Many-To-Many
    public function specializations() {
        return $this->belongsToMany('App\Specialization');
    }

    // Relation Info Many-To-Many
    public function votes() {
        return $this->belongsToMany('App\Vote');
    }

    // Relation Sponsor Many-To-Many
    public function sponsors() {
        return $this->belongsToMany('App\Sponsor')->withTimestamps();
    }

    protected $casts = [
        'average' => 'float',
        'count' => 'integer'
    ];
}
