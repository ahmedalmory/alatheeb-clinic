<?php

use App\Models\Appoint;


function modelBox($modal_id = '', $boxTitle = '', $boxid, $status_msg = '', $form_name = '', $m_id = 'abc')
{
    try {

        $drawBox = '
        <div class="modal fade" id="' . $modal_id . '" tabindex="-1">
       <div class="modal-dialog modal-lg" role="document" id="' . $m_id . '">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">' . $boxTitle . '</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body p-b-0">
                   <form id="' . $form_name . '">
                       <div  id="' . $boxid . '">

                           </div>

               </div>
               <div class="modal-footer"> <span id="' . $status_msg . '" class="float-left"></span>

               </div>
           </div>
           </form>
       </div>
   </div>';
        return $drawBox;
    } catch (Exception $exc) {
        // $this->tempVar = $exc->getMessage();
        return false;
    }
}
/* Large Modal
*/
function modelBoxLarge($modal_id = '', $boxTitle = '', $boxid, $status_msg = '', $form_name = '', $m_id = 'abc')
{
    try {

        $drawBox = '
        <div class="modal fade" id="' . $modal_id . '" tabindex="-1">
       <div class="modal-dialog modal-lg" role="document" id="' . $m_id . '">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">' . $boxTitle . '</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body p-b-0">
                   <form id="' . $form_name . '">
                       <div  id="' . $boxid . '">

                           </div>

               </div>
               <div class="modal-footer"> <span id="' . $status_msg . '" class="float-left"></span>
                   <button type="submit" class="btn btn-primary">save</button>
                   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
               </div>
           </div>
           </form>
       </div>
   </div>';
        return $drawBox;
    } catch (Exception $exc) {
        // $this->tempVar = $exc->getMessage();
        return false;
    }
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
        } else {
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
