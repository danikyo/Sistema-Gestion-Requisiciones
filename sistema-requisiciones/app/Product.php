<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'quantity', 'resource_id',
    ];

    public function resource()
    {
        return $this->belongsTo('App\Resource');
    }
}
