<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $total_patient =  DB::table('patients')->get();
        $total_patient = $total_patient->count();
        $total_patient_today =  DB::table('patients')->whereDate('created_at', DB::raw('CURDATE()'))->get();
        $total_patient_today = $total_patient_today->count();
        $total_user =  DB::table('users')->where('group_id',  '<>', '1')->get();
        $total_user = $total_user->count();
        $total_doctor =  DB::table('users')->where('group_id', '1')->get();
        $total_doctor = $total_doctor->count();
        $total_departments =  DB::table('departments')->get();
        $total_departments = $total_departments->count();
        return view('doctor.index', compact('total_patient', 'total_patient_today', 'total_user', 'total_doctor', 'total_departments'));
    }
}
