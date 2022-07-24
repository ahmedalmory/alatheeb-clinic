<?php

namespace App\Models;

use App\Models\Appoint;
use Carbon\Carbon;
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
        'name', 'email', 'password', 'group_id', 'level', 'dep_id','salary','rate','rate_active'
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
    public function todayAppointments(){
        return $this->appointments()->where('appoint_status', '1')
            ->whereDate('in_day', Carbon::today()->toDateString())->get();
    }
    public function waitingAppointments(){
        return $this->appointments()->whereNotIn('appoint_status',[1,3])
            ->whereDate('in_day', Carbon::today()->toDateString())->get();
    }

}
