<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class Invoice extends Model
{
   use SoftDeletes;
   protected $dates = ['deleted_at'];

   protected $table    = 'invoices';
   protected $fillable = [
      'id',
      'admin_id',
      'patient_id',
      'dr_id',
      'accountant_id',
      'accountant_group_id',
      'dep_id',
      'dr_group_id',
      'patient_id',
      'dr_id',
      'accountant_id',
      'invoice_date',
      'price_list',
      'content',
      'invoice_status',
      'pay_at',
      'dr_group_id',
      'accountant_group_id',
      'appoint_id',
      'period',
      'in_day',
      'in_time',
      'created_at',
      'updated_at',
      'deleted_at',
   ];

   public function patient_id()
   {
      return $this->hasOne(\App\Model\Patient::class, 'id', 'patient_id');
   }

   public function dep_id()
   {
      return $this->hasOne(\App\Model\Department::class, 'id', 'dep_id');
   }

   public function patient()
   {
      return $this->hasOne(\App\Model\Patient::class, 'id', 'patient_id');
   }

   public function dr_id()
   {
      return $this->hasOne(\App\User::class, 'id', 'dr_id');
   }

   public function dr()
   {
      return $this->hasOne(\App\User::class, 'id', 'dr_id');
   }

   public function accountant_id()
   {
      return $this->hasOne(\App\User::class, 'id', 'accountant_id');
   }

   public function accountant_group_id()
   {
      return $this->hasOne(\App\Model\Group::class, 'id', 'accountant_group_id');
   }

   public function dr_group_id()
   {
      return $this->hasOne(\App\Model\Group::class, 'id', 'dr_group_id');
   }

}
