<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class invoice_main extends Model {

protected $table    = 'invoice_main';
protected $fillable = [
		'id',
		'doc_id',
		'created_at',
		'updated_at',
	];



    public function patient_id()
    {
        return $this->hasOne(\App\Model\Patient::class, 'id', 'patient_id');
    }

    public function dep_id()
    {
        return $this->hasOne(\App\Model\Department::class, 'id', 'dep_id');
    }


    public function dr_id()
    {
        return $this->hasOne(\App\User::class, 'id', 'doc_id');
    }
    public function items(){
        return $this->hasMany(invoice_detail::class,'invoice_main_id','id');
    }



    public function accountant_id()
    {
        return $this->hasOne(\App\User::class, 'id', 'user_id');
    }
}
