<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class BloodType extends Model {

protected $table    = 'blood_types';
protected $fillable = [
		'id',
		'admin_id',
		'blood_name',
		'created_at',
		'updated_at',
	];

}
