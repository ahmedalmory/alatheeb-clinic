<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class invoice_main extends Model {

protected $table    = 'invoice_main';
protected $fillable = [
		'id',
		'doc_id',
		'created_at',
		'updated_at',
        'discount'
	];



    public function patient_id()
    {
        return $this->hasOne(\App\Models\Patient::class, 'id', 'patient_id');
    }
    public function new_patient()
    {
        return $this->belongsTo(\App\Models\Patient::class,'patient_id');
    }

    public function dep_id()
    {
        return $this->hasOne(\App\Models\Department::class, 'id', 'dep_id');
    }


    public function dr_id()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'doc_id');
    }
    public function new_dr()
    {
        return $this->belongsTo(\App\Models\User::class, 'doc_id');
    }
    public function items(){
        return $this->hasMany(invoice_detail::class,'invoice_main_id','id');
    }



    public function accountant_id()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
    }
    public function new_accountant()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
