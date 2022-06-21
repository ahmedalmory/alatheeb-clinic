<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Expense_sub extends Model {

protected $table    = 'expense_type';
protected $fillable = [
		'id',
		'exp_name',
		'exp_m_id',
    'created_at',
		'updated_at',
	];

    public function exp_m_id()
    {
        return $this->hasOne(\App\Models\Expenses_main::class, 'id', 'exp_m_id');
    }

}
