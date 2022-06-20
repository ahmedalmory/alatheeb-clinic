<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\InvoicesDataTable;
use App\Http\Controllers\Controller;
use App\Model\Appoint;
use App\Model\Invoice;
use Form;
use Illuminate\Http\Request;
use Up;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class Invoices extends Controller
{

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Display a listing of the resource.
    * @return \Illuminate\Http\Response
    */
   public function index(InvoicesDataTable $invoices)
   {
      return $invoices->render('admin.invoices.index', ['title' => trans('admin.invoices')]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Show the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.invoices.create', ['title' => trans('admin.create')]);
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
         'patient_id'          => 'required|numeric',
         'dr_id'               => 'numeric|nullable|sometimes',
         'accountant_id'       => 'numeric|nullable|sometimes',
         'invoice_date'        => 'required|string|date|date_format:Y-m-d',
         'price_list.*'        => 'required|numeric',
         'dep_id'              => 'required|numeric',
         'content'             => 'required',
         'invoice_status'      => 'required',
         'pay_at'              => 'required',
         'dr_group_id'         => 'numeric|nullable|sometimes',
         'accountant_group_id' => 'numeric|nullable|sometimes',
         'appoint_id'          => 'numeric|nullable|sometimes',
         'period'              => 'nullable|sometimes',
         'in_day'              => 'nullable|sometimes',
         'in_time'             => 'nullable|sometimes',

      ];
      $data = $this->validate(request(), $rules, [], [
         'patient_id'          => trans('admin.patient_id'),
         'dr_id'               => trans('admin.dr_id'),
         'accountant_id'       => trans('admin.accountant_id'),
         'invoice_date'        => trans('admin.invoice_date'),
         'price_list'          => trans('admin.price_list'),
         'content'             => trans('admin.content'),
         'invoice_status'      => trans('admin.invoice_status'),
         'pay_at'              => trans('admin.pay_at'),
         'dr_group_id'         => trans('admin.dr_group_id'),
         'accountant_group_id' => trans('admin.accountant_group_id'),
         'appoint_id'          => trans('admin.appoint_id'),
         'period'              => trans('admin.period'),
         'in_day'              => trans('admin.in_day'),
         'in_time'             => trans('admin.in_time'),
         'dep_id'              => trans('admin.dep_id'),

      ]);

      $data['admin_id']   = admin()->user()->id;
      $data['price_list'] = implode('|', request('price_list'));
      $data['content']    = implode('|', request('content'));
      Invoice::create($data);

      session()->flash('success', trans('admin.added'));
      return redirect(aurl('invoices'));
   }

   /**
    * Display the specified resource.
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      $invoices = Invoice::find($id);
      return view('admin.invoices.show', ['title' => trans('admin.show'), 'invoices' => $invoices]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * edit the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $invoices = Invoice::find($id);
      return view('admin.invoices.edit', ['title' => trans('admin.edit'), 'invoices' => $invoices]);
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
         'patient_id'          => 'required|numeric',
         'dr_id'               => 'numeric|nullable|sometimes',
         'accountant_id'       => 'numeric|nullable|sometimes',
         'invoice_date'        => 'required|string|date|date_format:Y-m-d',
         'price_list.*'        => 'required|numeric',
         'dep_id'              => 'required|numeric',
         'content'             => 'required',
         'invoice_status'      => 'required',
         'pay_at'              => 'required',
         'dr_group_id'         => 'numeric|nullable|sometimes',
         'accountant_group_id' => 'numeric|nullable|sometimes',
         'appoint_id'          => 'numeric|nullable|sometimes',
         'period'              => 'nullable|sometimes',
         'in_day'              => 'nullable|sometimes',
         'in_time'             => 'nullable|sometimes',

      ];
      $data = $this->validate(request(), $rules, [], [
         'patient_id'          => trans('admin.patient_id'),
         'dr_id'               => trans('admin.dr_id'),
         'accountant_id'       => trans('admin.accountant_id'),
         'invoice_date'        => trans('admin.invoice_date'),
         'price_list'          => trans('admin.price_list'),
         'content'             => trans('admin.content'),
         'invoice_status'      => trans('admin.invoice_status'),
         'pay_at'              => trans('admin.pay_at'),
         'dr_group_id'         => trans('admin.dr_group_id'),
         'accountant_group_id' => trans('admin.accountant_group_id'),
         'appoint_id'          => trans('admin.appoint_id'),
         'period'              => trans('admin.period'),
         'in_day'              => trans('admin.in_day'),
         'in_time'             => trans('admin.in_time'),
         'dep_id'              => trans('admin.dep_id'),

      ]);

      $data['admin_id']   = admin()->user()->id;
      $data['price_list'] = implode('|', request('price_list'));
      $data['content']    = implode('|', request('content'));

      Invoice::where('id', $id)->update($data);

      session()->flash('success', trans('admin.updated'));
      return redirect(aurl('invoices'));
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * destroy a newly created resource in storage.
    * @param  \Illuminate\Http\Request  $r
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $invoices = Invoice::find($id);

      @$invoices->delete();
      session()->flash('success', trans('admin.deleted'));
      return back();
   }

   public function multi_delete(Request $r)
   {
      $data = $r->input('selected_data');
      if (is_array($data)) {
         foreach ($data as $id) {
            $invoices = Invoice::find($id);

            @$invoices->delete();
         }
         session()->flash('success', trans('admin.deleted'));
         return back();
      } else {
         $invoices = Invoice::find($data);

         @$invoices->delete();
         session()->flash('success', trans('admin.deleted'));
         return back();
      }
   }

   public function get_doctors()
   {
      if (request()->has('group_id')) {
         $select = request('select');
         return Form::select('dr_id', \App\User::where('group_id', request('group_id'))->pluck('name', 'id'), $select, ['class' => 'form-control', 'placeholder' => trans('admin.dr_id')]);
      }
   }

   public function get_accountant()
   {
      if (request()->has('group_id')) {
         $select = request('select');
         return Form::select('accountant_id', \App\User::where('group_id', request('group_id'))->pluck('name', 'id'), $select, ['class' => 'form-control', 'placeholder' => trans('admin.accountant_id')]);
      }
   }

   public function get_period()
   {
      if (request()->has('period') and request()->has('day')) {
         $appoint_id  = request('appoint_id');
         $period_list = Appoint::whereDate('in_day', request('day'))->where('period', request('period'))->where('patient_id', request('patient_id'))->get();
         $select      = request('select');
         return view('admin.invoices.in_time_list', [
            'day'         => request('day'),
            'period_list' => $period_list,
            'select'      => $select,
            'day'         => request('day'),
         ])->render();
      }
   }
}
