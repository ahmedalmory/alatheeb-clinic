<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class Forms extends Model {

protected $table    = 'forms';
protected $fillable = [
		'id',
		'admin_id',
		'form_name',
'form',
		'created_at',
		'updated_at',
	];

}
