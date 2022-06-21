<?php
namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class Patients_files extends Model {

protected $table    = 'patients_files';
protected $fillable = [
		'id',
		'admin_id',
		'file_name',
		'created_at',
		'updated_at',
	];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
