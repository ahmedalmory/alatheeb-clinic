<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appoint;
use App\Models\Expenses_main;
use App\Models\invoice_main;
use Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Up;
use Carbon\Carbon;

class Reports extends Controller
{

    public function khazina()
    {
      //  $departments = DB::select(DB::raw("SELECT * FROM departments "));
        return view('style.reports.khazina');
    }
public function get_report_khazina(Request $request){
    #### sorry this is a peace of @#$@# .
    $period = $request->period;
     $pay_at = $request->pay_at;
    $from_date = date("Y-m-d", strtotime($request->from_date));;
    $to_date = date("Y-m-d", strtotime($request->to_date));
//    $payment = '';
//    $period2 = '';
//    if($pay_at =="cash"){
//        $payment = 'paid_cash > 0 AND ';
//    }else if($pay_at =="card"){
//        $payment = 'paid_card > 0 AND ';
//    }else{
//        $payment = '';
//    }
//        if($period =="morning"){
//            $period2 = "period = 'morning' AND ";
//        }else if($period =="evening"){
//            $period2 = "period = 'evening' AND ";
//        }else{
//            $period2 = '';
//        }
//    $invoices = DB::select(DB::raw("SELECT * FROM invoice_main WHERE $payment $period2  DATE(in_day) BETWEEN '$from_date' AND '$to_date' AND invoice_type != 2 "));
//    $expenses = DB::select(DB::raw("SELECT * FROM expense_main WHERE  DATE(in_day) BETWEEN '$from_date' AND '$to_date' "));
    ############################################################
    $invoices = invoice_main::query()
        ->where(function ($q) use($request){
            if ($request->period != 3)
                $q->where('period',$request->period);
        })
        ->where(function ($q) use($request){
            if ($request->from_date and $request->to_date)
                $q->whereBetween('in_day',[$request->from_date,$request->to_date]);
        })
        ->where(function ($q) use($request){
            if ($request->pay_at != 3)
                if ($request->pay_at =="cash")
                    $q->where('paid_cash','>',0);
                else
                    $q->where('paid_car','>',0);
        })
        ->get();
    $expenses = \App\Models\expense_main::query()->where(function ($q) use ($request){
        if ($request->from_date and $request->to_date)
            $q->whereBetween('in_day',[$request->from_date,$request->to_date]);
    })->get();
    return view('style.reports.khazina_detail',compact('period','invoices','expenses','from_date','to_date','pay_at','period'));

}
    public function patient_report()
    {
        $departments = DB::select(DB::raw("SELECT * FROM departments "));
        return view('style.reports.patient_report',compact('departments'));
    }
    public function clinic_doctor_report()
    {
        $departments = DB::select(DB::raw("SELECT * FROM departments "));
        $doctors = DB::select(DB::raw("SELECT * FROM users where level = 'dr' "));
        return view('style.reports.clinic_doctor_report',compact('departments','doctors'));
    }
    public function doctor_report()
    {

        return view('style.reports.doctor_report');
    }
    function get_doctors_report(Request $request)
    {
        if($request->id){
            $doctors = DB::select(DB::raw("SELECT * FROM users WHERE dep_id = $request->id AND level = 'dr'"));
            echo '<option value="-5">غير محدد</option>';
            foreach($doctors as $doc){
                echo '<option value="'.$doc->id.'">'.$doc->name.'</option>';
            }
        }

    }
    public function get_report_patient(Request $request){
        $period = $request->period;
        $pay_at = $request->pay_at;
        $doc_id = $request->doctors;
        $dep_id = $request->dep_id;
        $pat_id = $request->pat_id;
        $from_date = date("Y-m-d", strtotime($request->from_date));;
        $to_date = date("Y-m-d", strtotime($request->to_date));
        $payment = '';
        $period2 = '';
        $doctor = '';
        $dept = '';
        $patient = '';
        if($pay_at =="cash"){
            $payment = 'paid_cash > 0 AND ';
        }else if($pay_at =="card"){
            $payment = 'paid_card > 0 AND ';
        }else{
            $payment = '';
        }
        if($period =="morning"){
            $period2 = "period = 'morning' AND ";
        }else if($period =="evening"){
            $period2 = "period = 'evening' AND ";
        }else{
            $period2 = '';
        }

        if($dep_id =="-5"){
            $dept = '';
        }else {
            $dept = "dep_id = $dep_id AND";
        }

        if($doc_id =="-5"){
            $doctor = '';
        }else {
            $doctor = "doc_id = $doc_id AND";
        }
        $invoices = DB::select(DB::raw("SELECT * FROM invoice_main WHERE $payment $period2 $dept $doctor  DATE(in_day) BETWEEN '$from_date' AND '$to_date' AND invoice_type != 2  AND patient_id = $pat_id"));

        return view('style.reports.patient_report_detail',compact('period','invoices','from_date','to_date','pay_at','dep_id','doc_id','pat_id'));

    }

    public function get_report_clinic_doctor(Request $request){
        $period = $request->period;
        $pay_at = $request->pay_at;
        $doc_id = $request->doctors;
        $dep_id = $request->dep_id;
        $from_date = date("Y-m-d", strtotime($request->from_date));;
        $to_date = date("Y-m-d", strtotime($request->to_date));
//        $payment = '';
//        $period2 = '';
//        $doctor = '';
//        $dept = '';
//        if($pay_at =="cash"){
//            $payment = 'paid_cash > 0 AND ';
//        }else if($pay_at =="card"){
//            $payment = 'paid_card > 0 AND ';
//        }else{
//            $payment = '';
//        }
//        if($period =="morning"){
//            $period2 = "period = 'morning' AND ";
//        }else if($period =="evening"){
//            $period2 = "period = 'evening' AND ";
//        }else{
//            $period2 = '';
//        }
//
//        if($dep_id =="-5"){
//            $dept = '';
//        }else {
//            $dept = "dep_id = $dep_id AND";
//        }
//
//        if($doc_id =="-5"){
//            $doctor = '';
//        }else {
//            $doctor = "doc_id = $doc_id AND";
//        }
//        $invoices = DB::select(DB::raw("SELECT * FROM invoice_main WHERE $payment $period2 $dept $doctor  DATE(in_day) = DATE($request->date_inv) AND invoice_type != 2"));
        $invoices = invoice_main::query()
            ->where(function ($q) use($request) {
                if ($request->period != 3)
                    $q->wherePeriod($request->period);
            })
            ->where(function ($q) use($request) {
                if ($request->doctors != -5)
                    $q->whereDocId($request->doctors);
            })
            ->where(function ($q) use($request) {
                if ($request->dep_id != -5)
                    $q->whereDepId($request->dep_id);
            })
            ->where(function ($q) use($request) {
                if ($request->date_from)
                    $q->whereDate('in_day','>=',Carbon::parse($request->date_from)->toDateString());
            })
            ->where(function ($q) use($request) {
                if ($request->date_to)
                    $q->whereDate('in_day','<=',Carbon::parse($request->date_to)->toDateString());
            })
            ->where(function ($q) use($request) {
                if ($request->pay_at != 3)
                    if($request->pay_at =="cash"){
                        $q->where('paid_cash','>',0);
                    }else {
                        $q->where('paid_card','>',0);
                    }
            })
            ->get();
        return view('style.reports.clinic_doctor_report_detail',compact('period','invoices','from_date','to_date','pay_at','dep_id','doc_id'));

    }
    public function get_report_doctor(Request $request){
        $period = $request->period;
        $pay_at = $request->pay_at;
        $doc_id =  Auth::user()->id;
        $dep_id =  Auth::user()->dep_id;
        $from_date = date("Y-m-d", strtotime($request->from_date));;
        $to_date = date("Y-m-d", strtotime($request->to_date));
        $payment = '';
        $period2 = '';
        $doctor = '';
        $dept = '';
        if($pay_at =="cash"){
            $payment = 'paid_cash > 0 AND ';
        }else if($pay_at =="card"){
            $payment = 'paid_card > 0 AND ';
        }else{
            $payment = '';
        }
        if($period =="morning"){
            $period2 = "period = 'morning' AND ";
        }else if($period =="evening"){
            $period2 = "period = 'evening' AND ";
        }else{
            $period2 = '';
        }

        if($dep_id =="-5"){
            $dept = '';
        }else {
            $dept = "dep_id = $dep_id AND";
        }

        if($doc_id =="-5"){
            $doctor = '';
        }else {
            $doctor = "doc_id = $doc_id AND";
        }
        $invoices = DB::select(DB::raw("SELECT * FROM invoice_main WHERE $payment $period2 $dept $doctor  DATE(in_day) BETWEEN '$from_date' AND '$to_date' AND invoice_type != 2"));

        return view('style.reports.clinic_doctor_report_detail',compact('period','invoices','from_date','to_date','pay_at','dep_id','doc_id'));

    }
}

