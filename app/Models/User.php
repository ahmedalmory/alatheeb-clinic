<?php

namespace App\Models;

use App\Models\Appoint;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'group_id', 'level', 'dep_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group_id()
    {
        return $this->hasOne('App\Models\Group', 'id', 'group_id');
    }
    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }


    ### doctor
    public function appointments()
    {
        return $this->hasMany(Appoint::class, 'user_id', 'id');
    }
    ##


    public function isDoctor()
    {
        return $this->level === 'dr';
    }

    public function isAccountant()
    {
        return $this->level === 'accountant';
    }

    public function isReceptionist()
    {
        return $this->level === 'recep';
    }
}
