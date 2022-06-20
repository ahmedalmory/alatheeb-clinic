<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class expense_main extends Model {

protected $table    = 'expense_main';
protected $fillable = [
		'id',
		'comments',
		'created_at',
		'updated_at',
	];

}
