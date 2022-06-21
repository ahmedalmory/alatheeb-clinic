<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class Nationalities extends Model
{

   protected $table    = 'nationalities';
   protected $fillable = [
      'id',
      'admin_id',
      'nat_name',
      'created_at',
      'updated_at',
   ];

}
