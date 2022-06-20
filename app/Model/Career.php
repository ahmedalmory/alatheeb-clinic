<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class Career extends Model {

protected $table    = 'careers';
protected $fillable = [
		'id',
		'admin_id',
		'career_name',
		'created_at',
		'updated_at',
	];

}
