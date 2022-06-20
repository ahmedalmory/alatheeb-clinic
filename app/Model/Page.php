<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class Page extends Model {

protected $table    = 'pages';
protected $fillable = [
		'id',
		'admin_id',
		'page_title',
'page_content',
		'created_at',
		'updated_at',
	];

}
