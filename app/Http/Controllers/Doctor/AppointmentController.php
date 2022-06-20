<?php

namespace App\Http\Controllers\Doctor;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    public function last(){
        $items = doctor()->appointments()
            ->where(function ($q){
                if (\request()->in_day)
                    $q->where('in_day',\request()->in_day);
                else
                    $q->where('in_day','<=',Carbon::today()->toDateString());
            })
            ->orderByDesc('id')
            ->paginate(10);
        return view('doctor.patient.all_last',compact('items'));
    }
}
