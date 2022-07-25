<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDiscount extends Model
{
    use HasFactory;
    protected $table='salary_discounts';
    protected $guarded=[];
    public function user(){
        return  $this->belongsTo(User::class,'user_id');
    }
}
