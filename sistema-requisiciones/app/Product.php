<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'resource_id',
    ];

    public function resource()
    {
        return $this->belongsTo('App\Resource');
    }

    public function requisicions()
    {
        return $this->belongsToMany('App\Requisicion');
    }
}
