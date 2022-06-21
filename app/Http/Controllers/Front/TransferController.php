<?php

namespace App\Http\Controllers\Front;

use App\Models\Appoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransferController extends Controller
{
    public function edit($id){
        $appointment = Appoint::query()->find($id);
        return view('style.transferred.edit',compact('appointment'));
    }
    public function update($id){
        $appointment = Appoint::query()->find($id);
        $appointment->update(\request()->except('_token','_method'));
        session()->flash('success','تم اعادة تحويل المريض بنجاح');
        return redirect('/transfered_patients');
    }
}
