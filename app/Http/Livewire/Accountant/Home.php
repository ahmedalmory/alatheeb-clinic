<?php

namespace App\Http\Livewire\Accountant;

use App\Models\Department;
use App\Models\Patient;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $total_patient =  Patient::all();
        $total_patient = $total_patient->count();
        $total_patient_today =  Patient::whereDate('created_at', date('Y-m-d'))->get();
        $total_patient_today = $total_patient_today->count();
        $total_user =  User::where('group_id', '<>', '1')->get();
        $total_user = $total_user->count();
        $total_doctor =  User::where('group_id', '1')->get();
        $total_doctor = $total_doctor->count();
        $total_departments =  Department::all();
        $total_departments = $total_departments->count();
        return view('livewire.accountant.home', compact('total_patient', 'total_patient_today', 'total_user', 'total_doctor', 'total_departments'))->extends('layouts.app')->section('content');
    }
}
