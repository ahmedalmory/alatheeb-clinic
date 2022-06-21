<?php
namespace App\Http\Controllers;

use App\DatatableFrontEnd\TasdeedDataTable;
use App\Http\Controllers\Controller;
use App\Models\Appoint;
use App\Models\Diagnos;
use App\Models\invoice_detail;
use App\Models\invoice_main;
use App\Models\Patient;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Up;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class Tasdeed extends Controller
{

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Display a listing of the resource.
    * @return \Illuminate\Http\Response
    */
   public function index(TasdeedDataTable $tasdeed)
   {
      $drs = User::where('level', 'dr')->pluck('name', 'id');

      return $tasdeed->render('style.tasdeed.index', ['title' => trans('admin.tasdeed'), 'drs' => $drs]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Show the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('style.invoices.create', ['title' => trans('admin.create')]);
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
         'dep_id'              => 'required|numeric',
         'patient_id'          => 'required|numeric',
         'dr_id'               => 'numeric|nullable|sometimes',
         'accountant_id'       => 'numeric|nullable|sometimes',
         'invoice_date'        => 'required|string|date|date_format:Y-m-d',
         'price_list.*'        => 'required|numeric',
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
         'dep_id'              => trans('admin.dep_id'),
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

      ]);

      // $data['admin_id']   = admin()->user()->id;
      if (in_array(auth()->user()->level, ['accountant', 'recep'])) {
         $data['accountant_id']       = auth()->user()->id;
         $data['accountant_group_id'] = auth()->user()->group_id;
      } elseif (in_array(auth()->user()->level, ['dr', 'recep'])) {
         $data['dr_id']       = auth()->user()->id;
         $data['dr_group_id'] = auth()->user()->group_id;
      }
      $data['price_list'] = implode('|', request('price_list'));
      $data['content']    = implode('|', request('content'));
      Invoice::create($data);

      session()->flash('success', trans('admin.added'));
      return redirect(url('invoices'));
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
      return view('style.invoices.show', ['title' => trans('admin.show'), 'invoices' => $invoices]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * edit the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $invoices = Invoice::find($id);
      return view('style.invoices.edit', ['title' => trans('admin.edit'), 'invoices' => $invoices]);
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
         'dep_id'              => 'required|numeric',
         'patient_id'          => 'required|numeric',
         'dr_id'               => 'numeric|nullable|sometimes',
         'accountant_id'       => 'numeric|nullable|sometimes',
         'invoice_date'        => 'required|string|date|date_format:Y-m-d',
         'price_list.*'        => 'required|numeric',
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
         'dep_id'              => trans('admin.dep_id'),
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

      ]);

      //$data['admin_id']   = admin()->user()->id;
      if (in_array(auth()->user()->level, ['accountant', 'recep'])) {
         $data['accountant_id']       = auth()->user()->id;
         $data['accountant_group_id'] = auth()->user()->group_id;
      } elseif (in_array(auth()->user()->level, ['dr', 'recep'])) {
         $data['dr_id']       = auth()->user()->id;
         $data['dr_group_id'] = auth()->user()->group_id;
      }
      $data['price_list'] = implode('|', request('price_list'));
      $data['content']    = implode('|', request('content'));

      Invoice::where('id', $id)->update($data);

      session()->flash('success', trans('admin.updated'));
      return redirect(url('invoices'));
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
            $invoices = invoice_main::find($id);

            @$invoices->delete();
         }
         session()->flash('success', trans('admin.deleted'));
         return back();
      } else {
         $invoices = invoice_main::find($data);

         @$invoices->delete();
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

   public function get_accountant()
   {
      if (request()->has('group_id')) {
         $select = request('select');
         return Form::select('accountant_id', \App\Models\User::where('group_id', request('group_id'))->pluck('name', 'id'), $select, ['class' => 'form-control', 'placeholder' => trans('admin.accountant_id')]);
      }
   }

   public function get_period()
   {
      if (request()->has('period') and request()->has('day')) {
         $appoint_id  = request('appoint_id');
         $period_list = Appoint::whereDate('in_day', request('day'))->where('period', request('period'))->where('patient_id', request('patient_id'))->get();
         $select      = request('select');
         return view('style.invoices.in_time_list', [
            'day'         => request('day'),
            'period_list' => $period_list,
            'select'      => $select,
            'day'         => request('day'),
         ])->render();
      }
   }

   public function create_invoice(){
       $departments = DB::select(DB::raw("SELECT * FROM departments "));
       $category = DB::select(DB::raw("SELECT * FROM category "));
       return view('style.invoices.create_invoice',compact('departments','category'));
   }
    function get_patient_detail_invoice (Request $request)
    {
        if (Patient::where('id', $request->id)->exists()) {
            $patient = DB::select(DB::raw("SELECT * FROM patients
WHERE id = $request->id"));
            return view('style.invoices.patient_detail', compact('patient'));
        }
        else
        {
            echo "no";
        }


    }

    //invoice items
    function invoice_items_inv(Request $request)
    {
        if (Product::where('id', $request->id)->exists()) {
            $product = DB::select(DB::raw("SELECT 
  * FROM product
WHERE id = $request->id"));
            return view('style.invoices.invoice_items_inv', compact('product'));
        }
        else { echo "Record not found";}


    }

    function update_invoice(Request $request)
    {
        $post = invoice_main::find($request->invoice_id);
            $post->user_id = Auth::user()->id;
            $post->due = $request->due;
            $post->paid_cash = $request->cash_hand;
            $post->paid_card = $request->cash_card;
            $post->comments = $request->comments;
            $post->period = $request->period;
            $post->total_amount = $request->total_amount;
            $post->invoice_type = '1';
                if($request->cash_hand > 0 || $request->cash_card >0){
                    $post->invoice_status = 'paid';
                }else{
                $post->invoice_status = 'unpaid';
            }
            $msg = $post->save();
        $msg = invoice_detail::where('invoice_main_id',$request->invoice_id)->delete();
        for ($i = 0; $i < count($request->p_id); $i++) {
            $post = new invoice_detail;
            $post->p_id = $request->p_id[$i];
            $post->p_cat = $request->p_cat[$i];
            $post->p_name = $request->p_name[$i];
            $post->p_price = $request->p_price[$i];
            $post->invoice_main_id = $request->invoice_id;
            $msg = $post->save();
        }
            if ($msg) {
                echo json_encode(array('text' => 'تحت حفظ الفاتورة بنجاح', 'cls' => 'success','status' => '1'));
            } else {
                echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
            }





    }

   public function invoice_print($id)
    {
        $invoice_main = DB::select(DB::raw("SELECT 
  * FROM invoice_main
WHERE id = $id"));
        $invoice_detail = DB::select(DB::raw("SELECT 
  * FROM invoice_detail
WHERE invoice_main_id = $id"));
            return view('style.invoices.invoice_print',compact('invoice_main','invoice_detail'));



    }
    public function tasdeed_invoice($id){
        $invoice = DB::select(DB::raw("SELECT * FROM invoice_main WHERE id = $id "));
        $invoice_detail = DB::select(DB::raw("SELECT * FROM invoice_detail WHERE invoice_main_id = $id "));
        $patient_id = DB::table('invoice_main')->where('id', $id)->first()->patient_id;
        $patient_detail = DB::select(DB::raw("SELECT * FROM patients WHERE id = $patient_id "));
        $departments = DB::select(DB::raw("SELECT * FROM departments "));
        $category = DB::select(DB::raw("SELECT * FROM category "));
        return view('style.tasdeed.tasdeed_invoice',compact('departments','category','invoice','patient_detail','invoice_detail'));
    }
    function get_doctors_tasdeed(Request $request)
    {
        if($request->id){
            $doctors = DB::select(DB::raw("SELECT * FROM users WHERE dep_id = $request->id AND level = 'dr'"));
            foreach($doctors as $doc){
                echo '<option value="'.$doc->id.'" >'.$doc->name.'</option>';
            }
        }

    }

}
