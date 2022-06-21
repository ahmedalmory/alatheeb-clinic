<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetterController extends Controller
{
    public function patients(){
        $patients = Patient::query()->where(function ($q){
            if (\request()->search){
                $q->where('first_name','LIKE','%'.\request()->search.'%')
                    ->orWhere('id','=',\request()->search)
                    ->orWhere('civil','=',\request()->search)
                    ->orWhere('mobile','=',\request()->search);
            }
        })->get();
        return response($patients);
    }
}
