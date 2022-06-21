<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appoint;
use Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Up;
use Carbon\Carbon;

class Appoints extends Controller
{

    public function index()
    {
        $departments = DB::select(DB::raw("SELECT * FROM departments "));
        return view('style.appoints.index', compact('departments'));
    }
    public function create()
    {
        return view('style.appointments.create', ['title' => trans('admin.create')]);
    }
    public function appoints_doctor()
    {
        $doctor_id = Auth::user()->id;
        $clinic_id = Auth::user()->dep_id;

        return view('style.appoints.index_doctor', compact('clinic_id', 'doctor_id'));
    }
    public function get_appoints_new(Request $request)
    {
        $period = $request->period;
        $clinic = $request->dep_id;
        $doctor = $request->doc_id;
        $appoint_date = (!empty($request->appoint_date)) ? date("Y-m-d", strtotime($request->appoint_date)) : date("Y-m-d");

        //return $appoint_date;
        return view('style.appoints.appoint_detail', compact('period', 'clinic', 'doctor', 'appoint_date'));
    }
    public function patient_select(Request $request)
    {
        $time = $request->time;
        $clinic = $request->clinic;
        $doctor = $request->doctor;
        $appoint_date = $request->appoint_date;
        $period = $request->period;
        $time = $request->time;
        $patient = DB::select(DB::raw("SELECT * FROM patients "));
        return view('style.appoints.patient_select', compact('time', 'patient', 'clinic', 'doctor', 'appoint_date', 'period'));
    }

    function confirm_booking(Request $request)
    {
        $post = new Appoint;
        $post->patient_id = $request->pat_id;
        $post->in_day = date("Y-m-d", strtotime($request->appoint_date));
        $post->user_id = $request->doctor;
        $post->dep_id = $request->clinic;
        $post->in_time = $request->time;
        $post->period = $request->period;
        $post->appoint_status = $request->attend_status ?? '2';
        if ($request->status)
            $post->appoint_status = $request->status;
        $post->user_id_a = Auth::user()->id;
        $msg = $post->save();
        if ($msg) {
            echo json_encode(array('text' => 'تمت حجز الموعد بنجاح', 'cls' => 'success'));
        } else {
            echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
        }
    }

    function cancel_booking(Request $request)
    {
        if ($request->status == '3') {
            echo json_encode(array('text' => 'الغاء الحجز ليس مسموح في حالة تمت التشخيص فضلا غير الحالة اولا', 'cls' => 'error'));
        } else {


            $date =  date("Y-m-d", strtotime($request->appoint_date));
            $msg = DB::select(DB::raw("DELETE  FROM appoints where in_time = '$request->time' AND dep_id = $request->clinic AND user_id = $request->doctor AND period = '$request->period' AND DATE(in_day) = '$date'"));
            /*  $post->patient_id = $request->pat_id;
          $post->in_day = date("Y-m-d", strtotime($request->appoint_date));
          $post->user_id = $request->doctor;
          $post->dep_id = $request->clinic;
          $post->in_time = $request->time;
          $post->period = $request->period;
          $post->appoint_status = '2';
          $post->user_id_a = Auth::user()->id;*/

            echo json_encode(array('text' => 'تمت الغاء الحجز بنجاح', 'cls' => 'success'));
        }
    }

    function confirm_change(Request $request)
    {
        $date =  date("Y-m-d", strtotime($request->appoint_date));
        $msg = DB::select(DB::raw("UPDATE appoints SET appoint_status = $request->status_id where in_time = '$request->time' AND dep_id = $request->clinic AND user_id = $request->doctor AND period = '$request->period' AND DATE(in_day) = '$date'"));
        echo json_encode(array('text' => 'تمت تغير حالة الحجز بنجاح', 'cls' => 'success'));
    }

    function confirm_call(Request $request)
    {
        $date =  date("Y-m-d", strtotime($request->appoint_date));
        $msg = DB::select(DB::raw("UPDATE appoints SET call_patient = 'تمت الاتصال' WHERE in_time = '$request->time' AND dep_id = $request->clinic AND user_id = $request->doctor AND period = '$request->period' AND DATE(in_day) = '$date'"));
        echo json_encode(array('text' => 'تمت الاتصال بنجاح', 'cls' => 'success'));
    }
    public function change_status(Request $request)
    {
        $time = $request->time;
        $clinic = $request->clinic;
        $doctor = $request->doctor;
        $appoint_date = $request->appoint_date;
        $period = $request->period;
        $time = $request->time;
        return view('style.appoints.change_status', compact('time', 'clinic', 'doctor', 'appoint_date', 'period'));
    }
}
