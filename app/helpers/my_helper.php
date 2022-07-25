<?php

use App\Models\Appoint;


function modelBox($boxid,$modal_id = '', $boxTitle = '',  $status_msg = '', $form_name = '', $m_id = 'abc')
{
    $data = compact('boxid','modal_id','boxTitle','status_msg','form_name','m_id');
    return view('modals.modal-box',$data);
}
/* Large Modal
*/
function modelBoxLarge($boxid,$modal_id = '', $boxTitle = '',  $status_msg = '', $form_name = '', $m_id = 'abc')
{
    $data = compact('boxid','modal_id','boxTitle','status_msg','form_name','m_id');
    view('modals.modal-box-large',$data);
}
//get patient name
function patient_name($id)
{
    if ($id) {
        return DB::table('patients')->where('id', $id)->first()->first_name;
    } else {
        echo "";
    }
}
function nationality_name($id)
{
    if ($id) {

        return DB::table('nationalities')->where('id', $id)->first()->nat_name;
    } else {
        echo "";
    }
}
//clinic name
//get patient name
function clinic_name($id)
{
    if ($id) {

        $res =  DB::table('departments')->where('id', $id)->first()->dep_name;
        if ($res) {
            return $res;
        } else {
            echo "";
        }
    } else {
        echo "";
    }
}

function doctor_name($id)
{
    if ($id) {

        return DB::table('users')->where('id', $id)->first()->name;
    } else {
        echo "";
    }
}
//get category name based cat id
function category_name($id)
{
    if ($id) {
        return DB::table('category')->where('id', $id)->first()->cat_name;
    } else {
        echo "";
    }
}

function exp_main_name($id)
{
    if ($id) {
        return DB::table('expense_type_main')->where('id', $id)->first()->exp_m_name;
    } else {
        echo "";
    }
}
function get_status($id = null)
{
    if ($id) {
        if ($id == '1') {
            echo ('حضر');
        } else if ($id == '2') {
            echo ('في الانتظار');
        } else if ($id == '3') {
            echo ('تمت التشخيص');
        } else if ($id == '4') {
            echo ('مؤكد');
        } else if ($id == '5') {
            echo ('غير مؤكد');
        } else if ($id == '6') {
            echo ('تم إلغاء الجلسة');
        }else {
            echo ('');
        }
    } else {
        echo "";
    }
}
function attend_status_list(){
    return [
        '1' =>  'حضر',
        '2' =>  'في الانتظار',
        '3' =>  'تمت التشخيص',
        '4' =>  'مؤكد',
        '5' =>  'غير مؤكد',
    ];
}
function get_period_report($id)
{
    if ($id) {
        if ($id == 'morning') {
            echo ('الصباحية');
        } else if ($id == 'evening') {
            echo (' المسائية');
        } else {
            echo ('الصباحية والمسائية');
        }
    } else {
        echo "";
    }
}
function get_pay_report($id)
{
    if ($id) {
        if ($id == 'cash') {
            echo ('نقدا');
        } else if ($id == 'card') {
            echo (' بطاقة الائتمانية');
        } else {
            echo ('نقدا وبطاقة الائتمانية');
        }
    } else {
        echo "";
    }
}
function get_appoint_data($time, $dep_id, $doc_id, $period, $date)
{
    $query = Appoint::where('in_time', $time)
        ->where('user_id', $doc_id)
        ->where('dep_id', $dep_id)
        ->where('in_day', $date)
        ->where('period', $period);

    $otherQuery =   Appoint::where('in_time', $time)
        ->where('user_id', $doc_id)
        ->where('dep_id', $dep_id)
        ->where('in_day', $date);

    return ($period === 'all_period') ?  $otherQuery->get() : $query->get();
}
function doctor(){
    if (auth()->check() and auth()->user()->isDoctor()){
        return \App\Models\User::query()->find(auth()->id());
    }
}

require  __DIR__.'/tofaha.php';
