<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
   protected $table    = 'departments';
   protected $fillable = [
      'dep_name',
      'parent',
   ];

   public function parents()
   {
      return $this->hasMany('App\Model\Department', 'id', 'parent');
   }
   public function appointments(){
       return $this->hasMany(Appoint::class,'dep_id','id');
   }

}
