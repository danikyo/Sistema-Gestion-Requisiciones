<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'description', 'project_id',
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function users()
    {
    	return $this->belongsToMany('App\User');
    }

    public function resources()
    {
        return $this->hasMany('App\Resource');
    }
}
