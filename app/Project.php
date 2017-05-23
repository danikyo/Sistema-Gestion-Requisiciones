<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'id', 'caname', 'clave', 'name', 'startDate', 'endDate', 'description', 'currentAmount',
    ];

    public function activities()
    {
    	return $this->hasMany('App\Activity');
    }

    public function requisicion()
    {
        return $this->hasMany('App\Requisicion');
    }

    public function scopeSearch($query, $dato)
    {
    	$query->where('name', 'LIKE', '%'.$dato.'%')
    	->orwhere('id', 'LIKE', '%'.$dato.'%');
    }
}