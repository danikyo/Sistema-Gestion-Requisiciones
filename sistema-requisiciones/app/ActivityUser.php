<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityUser extends Model
{
    protected $fillable = [
        'activity_id', 'user_id',
    ];
}
