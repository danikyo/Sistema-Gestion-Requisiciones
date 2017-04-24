<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisicion extends Model
{
    protected $fillable = [
        'date', 'area', 'observations', 'status', 'project_id', 'activity_id', 'resource_id', 'user_id'
    ];

    public function project()
    {
    	return $this->belongsTo('App\Project');
    }

    public function activity()
    {
    	return $this->belongsTo('App\Activity');
    }

    public function resource()
    {
        return $this->belongsTo('App\Resource');    
    }

    public function products()
    {
    	return $this->belongsToMany('App\Product');
    }

    public function scopeSearch($query, $dato)
    {
        $query->where('area', 'LIKE', '%'.$dato.'%')
        ->orwhere('id', 'LIKE', '%'.$dato.'%');
    }
}