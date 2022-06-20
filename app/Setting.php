<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
   protected $table = 'settings';
   //protected $dates    = ['deleted_at'];
   protected $fillable = [
      'sitename',
      'email',
      'logo',
      'icon',
      'status',
      'message_status',
      'url',
      'phones',
      'sms_status',
      'sms_username',
      'sms_password',
      'sms_sender',
      'from_morning',
      'to_morning',
      'from_evening',
      'to_evening',
      'patient_exposure',
      'address',
      'postal_code',
      'build_num',
      'extra_number',
      'unit_num'
   ];
}
