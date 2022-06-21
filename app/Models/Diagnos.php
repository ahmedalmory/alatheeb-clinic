<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class Diagnos extends Model
{

   protected $table    = 'diagnos';
   protected $fillable = [
      'id',
      'admin_id',
       'appoint_status',
      'dr_id',
      'appoint_id',
      'patient_id',
      'dr_id',
      'dep_id',
      'treatment',
      'tooth',
      'in_time',
      'in_day',
      'taken',
      'period',
      'group_id',
      'created_at',
      'updated_at',
   ];
   public function appointment(){
       return $this->belongsTo(Appoint::class,'appoint_id','id');
   }
   public function dr_id()
   {
      return $this->hasOne(\App\Models\User::class, 'id', 'dr_id');
   }

   public function dr_id_other()
   {
      return $this->hasOne(\App\Models\User::class, 'id', 'dr_id');
   }

   public function dep_id()
   {
      return $this->hasOne(\App\Models\Department::class, 'id', 'dep_id');
   }

   public function dr()
   {
      return $this->hasOne(\App\Models\User::class, 'id', 'dr_id');
   }

   public function patient_id()
   {
      return $this->hasOne(\App\Models\Patient::class, 'id', 'patient_id');
   }

   public function patient_id_other()
   {
      return $this->hasOne(\App\Models\Patient::class, 'id', 'patient_id');
   }

   public function patient()
   {
      return $this->hasOne(\App\Models\Patient::class, 'id', 'patient_id');
   }

   public function appoint_id()
   {
      return $this->hasOne(\App\Models\Appoint::class, 'id', 'appoint_id');
   }

}
