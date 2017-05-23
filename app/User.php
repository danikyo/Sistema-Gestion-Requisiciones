<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tel', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getIsAdminAttribute()
    {
        return $this->role < 4;
    }

    //tipos de usuario
    public function getIsSecretarioAttribute()
    {
        return $this->role == 1;
    }

    public function getIsPlaneacionAttribute()
    {
        return $this->role == 2;
    }

    public function getIsFinanzasAttribute()
    {
        return $this->role == 3;
    }

    public function getIsComprasAttribute()
    {
        return $this->role == 4;
    }

    public function getIsProfesorAttribute()
    {
        return $this->role == 5;
    }
    //

    public function requisicions()
    {
        return $this->hasMany('App\Requisicion');
    }

    public function activities()     
    {
        return $this->belongstoMany('App\Activity');     
    }

    public function scopeSearch($query, $dato)
    {
        $query->where('name', 'LIKE', '%'.$dato.'%')
        ->orwhere('id', 'LIKE', '%'.$dato.'%');
    }
}
