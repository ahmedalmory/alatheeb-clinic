<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\FormsDataTable;
use App\Http\Controllers\Controller;
use App\Model\Forms;
use Form;
use Illuminate\Http\Request;
use Up;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class FormsController extends Controller
{

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Display a listing of the resource.
    * @return \Illuminate\Http\Response
    */
   public function index(FormsDataTable $forms)
   {
      return $forms->render('admin.forms.index', ['title' => trans('admin.forms')]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Show the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.forms.create', ['title' => trans('admin.create')]);
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
         'form_name' => 'required|string',
         'form'      => 'required|mimes:jpeg,jpg,png,bmp,xls,pdf,doc,docx',

      ];
      $data = $this->validate(request(), $rules, [], [
         'form_name' => trans('admin.form_name'),
         'form'      => trans('admin.form'),

      ]);

      $data['admin_id'] = admin()->user()->id;
      if (request()->hasFile('form')) {
         $data['form'] = it()->upload('form', 'forms');
      }
      Forms::create($data);

      session()->flash('success', trans('admin.added'));
      return redirect(aurl('forms'));
   }

   /**
    * Display the specified resource.
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      $forms = Forms::find($id);
      return view('admin.forms.show', ['title' => trans('admin.show'), 'forms' => $forms]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * edit the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $forms = Forms::find($id);
      return view('admin.forms.edit', ['title' => trans('admin.edit'), 'forms' => $forms]);
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
         'form_name' => 'required|string',
         'form'      => 'required|mimes:jpeg,jpg,png,bmp,xls,pdf,doc,docx',

      ];
      $data = $this->validate(request(), $rules, [], [
         'form_name' => trans('admin.form_name'),
         'form'      => trans('admin.form'),
      ]);
      $data['admin_id'] = admin()->user()->id;
      if (request()->hasFile('form')) {
         it()->delete(Forms::find($id)->form);
         $data['form'] = it()->upload('form', 'forms');
      }
      Forms::where('id', $id)->update($data);

      session()->flash('success', trans('admin.updated'));
      return redirect(aurl('forms'));
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * destroy a newly created resource in storage.
    * @param  \Illuminate\Http\Request  $r
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $forms = Forms::find($id);

      it()->delete($forms->form);
      it()->delete('forms', $id);

      @$forms->delete();
      session()->flash('success', trans('admin.deleted'));
      return back();
   }

   public function multi_delete(Request $r)
   {
      $data = $r->input('selected_data');
      if (is_array($data)) {
         foreach ($data as $id) {
            $forms = Forms::find($id);

            it()->delete($forms->form);
            it()->delete('forms', $id);
            @$forms->delete();
         }
         session()->flash('success', trans('admin.deleted'));
         return back();
      } else {
         $forms = Forms::find($data);

         it()->delete($forms->form);
         it()->delete('forms', $data);

         @$forms->delete();
         session()->flash('success', trans('admin.deleted'));
         return back();
      }
   }
}
