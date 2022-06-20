<?php

namespace App\Http\Controllers\Doctor;

use App\Model\Patient;
use App\Model\Patients_files;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function show($id)
    {

        $patients = Patient::find($id);
        $patient_files = DB::select(DB::raw("SELECT
  * FROM patients_files
WHERE patient_id = $id"));
        return view('doctor.patient.show', ['title' => trans('admin.show'), 'patients' => $patients, 'patient_files' => $patient_files]);
    }
    public function storeFiles(){
        $this->validate(\request(),[
            'files' =>  'array|min:1',
            'file_name' =>  'required',
            'patient_id' =>  'required',
        ]);
        foreach (\request()->file('files') as $image){
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $extension = $image->getClientOriginalExtension();
            $image->move(public_path('images/patient_files'), $new_name);
            $post = new Patients_files;
            $post->file_name = \request()->file_name;
            $post->patient_id = \request()->patient_id;
            $post->image = $new_name;
            $post->mimtype = $extension;
            $post->user_id = auth()->id();
            $msg = $post->save();
            return back()->withSuccess('تم الاضافة بنجاح');
        }
    }
}
