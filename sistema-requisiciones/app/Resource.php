<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'type', 'activity_id',
    ];

    public function activity()
    {
    	return $this->belongsTo('App\Activity');
    }

    public function requisicion()
    {
        return $this->hasMany('App\Requisicion');
    }

    public function products()
    {
    	return $this->hasMany('App\Product');
    }
}
