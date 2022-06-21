<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\DiagnosisDataTable;
use App\Http\Controllers\Controller;
use App\Models\Appoint;
use App\Models\Diagnos;
use Form;
use Illuminate\Http\Request;
use Up;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class Diagnosis extends Controller
{

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Display a listing of the resource.
    * @return \Illuminate\Http\Response
    */
   public function index(DiagnosisDataTable $diagnosis)
   {
      return $diagnosis->render('admin.diagnosis.index', ['title' => trans('admin.diagnosis')]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Show the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.diagnosis.create', ['title' => trans('admin.create')]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Store a newly created resource in storage.
    * @param  \Illuminate\Http\Request  $r
    * @return \Illuminate\Http\Response
    */
   public function store()
   {
      $rules = [
         'appoint_id' => 'required|numeric',
         'patient_id' => 'required|numeric',
         'group_id'   => 'required|numeric',
         'dr_id'      => 'required|numeric',
         'dep_id'     => 'required|numeric',
         'treatment'  => 'nullable|sometimes',
         'tooth'      => 'nullable|sometimes',
         'in_time'    => 'required',
         'in_day'     => 'date|date_format:Y-m-d',
         'taken'      => 'nullable|sometimes',
         'period'     => 'required|string',

      ];
      $data = $this->validate(request(), $rules, [], [
         'appoint_id' => trans('admin.appoint_id'),
         'patient_id' => trans('admin.patient_id'),
         'dr_id'      => trans('admin.dr_id'),
         'treatment'  => trans('admin.treatment'),
         'tooth'      => trans('admin.tooth'),
         'in_time'    => trans('admin.in_time'),
         'dep_id'     => trans('admin.dep_id'),
         'in_day'     => trans('admin.in_day'),
         'taken'      => trans('admin.taken'),
         'period'     => trans('admin.period'),
         'group_id'   => trans('admin.group_id'),

      ]);

      $data['admin_id'] = admin()->user()->id;
      Diagnos::create($data);

      session()->flash('success', trans('admin.added'));
      return redirect(aurl('diagnosis'));
   }

   /**
    * Display the specified resource.
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      $diagnosis = Diagnos::find($id);
      return view('admin.diagnosis.show', ['title' => trans('admin.show'), 'diagnosis' => $diagnosis]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * edit the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $diagnosis = Diagnos::find($id);
      return view('admin.diagnosis.edit', ['title' => trans('admin.edit'), 'diagnosis' => $diagnosis]);
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
         'appoint_id' => 'required|numeric',
         'patient_id' => 'required|numeric',
         'dr_id'      => 'required|numeric',
         'treatment'  => 'nullable|sometimes',
         'tooth'      => 'nullable|sometimes',
         'in_time'    => 'required',
         'in_day'     => 'date|date_format:Y-m-d',
         'taken'      => 'nullable|sometimes',
         'period'     => 'required|string',
         'group_id'   => 'required|numeric',
         'dep_id'     => 'required|numeric',

      ];
      $data = $this->validate(request(), $rules, [], [
         'appoint_id' => trans('admin.appoint_id'),
         'patient_id' => trans('admin.patient_id'),
         'dr_id'      => trans('admin.dr_id'),
         'treatment'  => trans('admin.treatment'),
         'tooth'      => trans('admin.tooth'),
         'in_time'    => trans('admin.in_time'),
         'in_day'     => trans('admin.in_day'),
         'taken'      => trans('admin.taken'),
         'period'     => trans('admin.period'),
         'group_id'   => trans('admin.group_id'),
         'dep_id'     => trans('admin.dep_id'),
      ]);
      $data['admin_id'] = admin()->user()->id;
      Diagnos::where('id', $id)->update($data);

      session()->flash('success', trans('admin.updated'));
      return redirect(aurl('diagnosis'));
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * destroy a newly created resource in storage.
    * @param  \Illuminate\Http\Request  $r
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $diagnosis = Diagnos::find($id);

      @$diagnosis->delete();
      session()->flash('success', trans('admin.deleted'));
      return back();
   }

   public function multi_delete(Request $r)
   {
      $data = $r->input('selected_data');
      if (is_array($data)) {
         foreach ($data as $id) {
            $diagnosis = Diagnos::find($id);

            @$diagnosis->delete();
         }
         session()->flash('success', trans('admin.deleted'));
         return back();
      } else {
         $diagnosis = Diagnos::find($data);

         @$diagnosis->delete();
         session()->flash('success', trans('admin.deleted'));
         return back();
      }
   }

   public function get_doctors()
   {
      if (request()->has('group_id')) {
         $select = request('select');
         return Form::select('dr_id', \App\Models\User::where('group_id', request('group_id'))->pluck('name', 'id'), $select, ['class' => 'form-control', 'placeholder' => trans('admin.dr_id')]);
      }
   }

   public function get_period()
   {
      if (request()->has('period') and request()->has('day')) {
         $appoint_id  = request('appoint_id');
         $period_list = Appoint::whereDate('in_day', request('day'))->where('period', request('period'))->where('patient_id', request('patient_id'))->get();
         $select      = request('select');
         return view('admin.diagnosis.in_time_list', [
            'day'         => request('day'),
            'period_list' => $period_list,
            'appoint_id'  => $appoint_id,
            'select'      => $select,
            'day'         => request('day'),
         ])->render();
      }
   }
}
