<?php
namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]

class Patient extends Model
{
   use SoftDeletes;
   protected $dates = ['deleted_at'];

   protected $table    = 'patients';
   protected $fillable = [
      'id',
      'admin_id',
      'f_number',
      'record_date',
      'civil',
      'first_name',
      'father_name',
      'grand_name',
      'title',
      'relation_id',
      'gender',
      'nationality',
      'date_birh_hijri',
      'age',
      'mobile',
      'phone',
      'mobile_nearby',
      'comments',
      'last_update_at',
      'user_id',
      'last_update_user_id',
      'purpose_visit',
      'teeth_medicine',
      'heart_disease',
      'high_low_blood',
      'rheumatic_fever',
      'asthma',
      'anemia',
      'thyroid_disease',
      'hepatitis',
      'diabetes',
      'kidney_disease',
      'tics',
      'other_diseases',
      'sensitivity_penicillin',
      'taking_drugs',
      'drugs_names',
      'pregnant',
      'dep_id',
      'created_at',
      'updated_at',
      'deleted_at',
   ];

   public function files()
   {
      return $this->hasMany('App\Files', 'type_id', 'id')->where('type_file', 'patient');
   }

   public function last_update_at()
   {
      return $this->hasOne('App\Admin', 'id', 'last_update_at');
   }

   public function dep_id()
   {
      return $this->hasOne('App\Model\Department', 'id', 'dep_id');
   }

   public function relation()
   {
      return $this->hasOne('App\Model\Relationship', 'id', 'relation_id');
   }

   public function national()
   {
      return $this->hasOne('App\Model\Nationalities', 'id', 'nationality');
   }

   public function user()
   {
      return $this->hasOne('App\User', 'id', 'user_id');
   }

   public function user_id()
   {
      return $this->hasOne('App\User', 'id', 'user_id');
   }

   public function last_update_user_id()
   {
      return $this->hasOne('App\User', 'id', 'last_update_user_id');
   }
   public function last_update_user()
   {
      return $this->belongsTo(User::class, 'last_update_user_id', 'id');
   }

   public function update_user_id()
   {
      return $this->hasOne('App\User', 'id', 'last_update_user_id');
   }
   ###
    public function diagnos(){
       return $this->hasMany(Diagnos::class,'patient_id','id');
    }

}
