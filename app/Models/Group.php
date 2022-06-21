<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Group extends Model
{

    protected $table = 'groups';
    protected $fillable = [
        'id',
        'admin_id',
        'group_name',
        'created_at',
        'updated_at',
        'permissions'
    ];
    public function getPermissionsAttribute($value){
        return json_decode($value);
    }

}
