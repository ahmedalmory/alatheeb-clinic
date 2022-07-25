<?php
namespace App\Http\Controllers;

use App\DatatableFrontEnd\AppointmentsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Appoint;
use App\Models\Diagnos;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Form;
use Illuminate\Http\Request;
use Up;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class Appointments extends Controller
{


   public function index(AppointmentsDataTable $appointments)
   {
      return $appointments->render('style.appointments.index', ['title' => trans('admin.appointments')]);
   }

   public function create()
   {
      return view('style.appointments.create', ['title' => trans('admin.create')]);
   }


   public function store()
   {
      if (Appoint::whereDate('in_day', request('in_day'))->where('in_time', request('in_time'))->count() > 0) {
         session()->flash('error', trans('admin.not_available_time'));
         return back();
      }
      $rules = [
         'dep_id'        => 'required|numeric',
         'patient_id'    => 'required|numeric',
         'period'        => 'required|string',
         'in_day'        => 'required|date|date_format:Y-m-d',
         'in_time'       => 'required|string',
         'user_id'       => 'required|numeric',
         'appoint_status' => 'required|string',

      ];
      $data = $this->validate(request(), $rules, [], [
         'dep_id'        => trans('admin.dep_id'),
         'patient_id'    => trans('admin.patient_id'),
         'period'        => trans('admin.period'),
         'in_day'        => trans('admin.in_day'),
         'in_time'       => trans('admin.in_time'),
         'user_id'       => trans('admin.user_id'),
         'appoint_status' => trans('admin.attend_status'),

      ]);
      $data["user_id_a"] = auth()->id();
      // $data['admin_id'] = admin()->user()->id;
      Appoint::create($data);

      session()->flash('success', trans('admin.added'));
      return redirect(url('appoints'));
   }

   public function show($id)
   {
      $appointments = Appoint::find($id);
      $invoices     = Invoice::where('patient_id', $appointments->patient_id)->where('in_day', $appointments->in_day)->where('in_time', $appointments->in_time)->where('period', $appointments->period)->get();
      $diagnosis    = Diagnos::where('appoint_id', $id)->where('patient_id', $appointments->patient_id)->get();
      return view('style.appointments.show', [
         'title'        => trans('admin.show'),
         'appointments' => $appointments,
         'diagnosis'    => $diagnosis,
         'invoices'     => $invoices,
      ]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * edit the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $appointments = Appoint::find($id);
      return view('style.appointments.edit', ['title' => trans('admin.edit'), 'appointments' => $appointments]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * update a newly created resource in storage.
    * @param  \Illuminate\Http\Request  $r
    * @return \Illuminate\Http\Response
    */
   public function update($id)
   {
      $rules = [
         'dep_id'        => 'required|numeric',
         'patient_id'    => 'required|numeric',
         'period'        => 'required|string',
         'in_day'        => 'required|date|date_format:Y-m-d|before:' . Carbon::now()->addDays(0)->toDateString() . '',
         'in_time'       => 'required|string',
         'group_id'      => 'required|numeric',
         'user_id'       => 'required|numeric',
         'attend_status' => 'required|string',

      ];
      $data = $this->validate(request(), $rules, [], [
         'dep_id'        => trans('admin.dep_id'),
         'patient_id'    => trans('admin.patient_id'),
         'period'        => trans('admin.period'),
         'in_day'        => trans('admin.in_day'),
         'in_time'       => trans('admin.in_time'),
         'group_id'      => trans('admin.group_id'),
         'user_id'       => trans('admin.user_id'),
         'attend_status' => trans('admin.attend_status'),
      ]);
      //$data['admin_id'] = admin()->user()->id;
      Appoint::where('id', $id)->update($data);

      session()->flash('success', trans('admin.updated'));
      return redirect(url('appointments'));
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * destroy a newly created resource in storage.
    * @param  \Illuminate\Http\Request  $r
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $appointments = Appoint::find($id);

      @$appointments->delete();
      session()->flash('success', trans('admin.deleted'));
      return back();
   }

   public function multi_delete(Request $r)
   {
      $data = $r->input('selected_data');
      if (is_array($data)) {
         foreach ($data as $id) {
            $appointments = Appoint::find($id);

            @$appointments->delete();
         }
         session()->flash('success', trans('admin.deleted'));
         return back();
      } else {
         $appointments = Appoint::find($data);

         @$appointments->delete();
         session()->flash('success', trans('admin.deleted'));
         return back();
      }
   }

   public function get_patient()
   {
      if (request()->has('text')) {
         $s        = request('text');
         $patients = Patient::selectRaw('id as id')
            ->selectRaw('CONCAT("' . trans('admin.name') . ': ",first_name,"  ",father_name,"  ",grand_name,"  - ' . trans('admin.civil') . ': ",civil)  as text')
            ->selectRaw('first_name as first_name')
            ->selectRaw('f_number as f_number')
            ->selectRaw('civil as civil')
            ->selectRaw('father_name as father_name')
            ->selectRaw('grand_name as grand_name')
            ->selectRaw('title as title')
            ->selectRaw('mobile as mobile')
            ->selectRaw('phone as phone')
            ->selectRaw('mobile_nearby as mobile_nearby')
            ->where(function ($q) use ($s) {
               $q->where('civil', 'LIKE', '%' . $s . '%');
               $q->orWhere('f_number', 'LIKE', '%' . $s . '%');
               $q->orWhere('first_name', 'LIKE', '%' . $s . '%');
               $q->orWhere('father_name', 'LIKE', '%' . $s . '%');
               $q->orWhere('grand_name', 'LIKE', '%' . $s . '%');
               $q->orWhere('title', 'LIKE', '%' . $s . '%');
               $q->orWhere('mobile', 'LIKE', '%' . $s . '%');
               $q->orWhere('phone', 'LIKE', '%' . $s . '%');
               $q->orWhere('mobile_nearby', 'LIKE', '%' . $s . '%');
            })->get();
         return response(['users' => $patients, 'count' => count($patients)], 200);
      } else {
      }
   }

   public function get_users()
   {
      if (request()->has('group_id')) {
         $select = request('select');
         return Form::select('user_id', \App\Models\User::where('group_id', request('group_id'))->pluck('name', 'id'), $select, ['class' => 'form-control', 'placeholder' => trans('admin.user_id')]);
      }
   }

   public function get_period()
   {
      if (request()->has('period') and request()->has('day')) {
         $period_select = request('period');
         $select        = request('select');
         $period        = in_array($period_select, ['morning', 'evening']) ? calc_time(request('period')) : '';
         if (!empty($period) and $period > 0) {
            $last_period = Appoint::whereDate('in_day', request('day'))->pluck('in_time');
            return view('style.appointments.in_time_list', [
               'patient_id'   => \request('patient_id'),
               'dep_id'   => \request('dep_id'),
               'user_id'   => \request('user_id'),
               'period'   => $period,
               'select'   => $select,
               'selected' => $period_select,
               'day'      => request('day'),
            ])->render();
         }
      }
   }
}
