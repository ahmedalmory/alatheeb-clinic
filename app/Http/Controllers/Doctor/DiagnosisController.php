<?php

namespace App\Http\Controllers\Doctor;

use App\DataTables\DoctorDiagnosisDataTable;
use App\Model\Diagnos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiagnosisController extends Controller
{
    public function index(DoctorDiagnosisDataTable $dataTable){
        return $dataTable->render('doctor.diagnosis.index',['title'=>'تشخصيات سابقة']);
    }
    public function show($id){
        $diagnosis = Diagnos::query()->find($id);
        $title = 'عرض تشخيص';
        return view('doctor.diagnosis.show',compact('diagnosis','title'));
    }
}
