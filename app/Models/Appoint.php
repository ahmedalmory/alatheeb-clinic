<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class Appoint extends Model
{

   protected $table    = 'appoints';
   protected $fillable = [
      'id',
      'admin_id',
      'patient_id',
      'group_id',
      'user_id',
      'user_id_a',
      'period',
      'in_day',
      'dep_id',
      'in_time',
      'attend_status',
      'appoint_status',
      'sms_sent',
      'created_at',
      'updated_at',
   ];

   public function patient_id()
   {
      return $this->hasOne(\App\Models\Patient::class, 'id', 'patient_id');
   }

   public function dep_id()
   {
      return $this->hasOne(\App\Models\Department::class, 'id', 'dep_id');
   }
    public function dep()
    {
        return $this->belongsTo(\App\Models\Department::class, 'dep_id','id');
    }

   public function patient()
   {
      return $this->hasOne(\App\Models\Patient::class, 'id', 'patient_id');
   }

   public function group()
   {
      return $this->hasOne(\App\Models\Group::class, 'id', 'group_id');
   }

   public function group_id()
   {
      return $this->hasOne(\App\Models\Group::class, 'id', 'group_id');
   }

   public function user_id()
   {
      return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
   }

   public function user()
   {
      return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
   }

   public function invoice_count()
   {

      return $this->hasMany('App\Models\Invoice', 'patient_id', 'patient_id')->where('in_day', $this->in_day)->where('in_time', $this->in_time)->count();
   }

   public function diagnos_count()
   {
      return $this->hasMany('App\Models\Diagnos', 'appoint_id', 'id')->where('patient_id', $this->patient_id)->count();
   }

}
