<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class expense_detail extends Model {

protected $table    = 'expense_detail';
protected $fillable = [
		'id',
		'exp_m_id',
		'created_at',
		'updated_at',
	];

}
