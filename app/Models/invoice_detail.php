<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class invoice_detail extends Model {

protected $table    = 'invoice_detail';
protected $fillable = [
		'sno',
		'p_id',
		'created_at',
		'updated_at',
	];

}
