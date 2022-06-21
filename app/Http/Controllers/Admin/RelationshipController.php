<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\RelationshipDataTable;
use App\Http\Controllers\Controller;
use App\Models\Relationship;
use Form;
use Illuminate\Http\Request;
use Up;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class RelationshipController extends Controller
{

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Display a listing of the resource.
    * @return \Illuminate\Http\Response
    */
   public function index(RelationshipDataTable $relationship)
   {
      return $relationship->render('admin.relationship.index', ['title' => trans('admin.relationship')]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Show the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.relationship.create', ['title' => trans('admin.create')]);
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
         're_name' => 'required',

      ];
      $data = $this->validate(request(), $rules, [], [
         're_name' => trans('admin.re_name'),

      ]);

      $data['admin_id'] = admin()->user()->id;
      Relationship::create($data);

      session()->flash('success', trans('admin.added'));
      return redirect(aurl('relationship'));
   }

   /**
    * Display the specified resource.
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      $relationship = Relationship::find($id);
      return view('admin.relationship.show', ['title' => trans('admin.show'), 'relationship' => $relationship]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * edit the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $relationship = Relationship::find($id);
      return view('admin.relationship.edit', ['title' => trans('admin.edit'), 'relationship' => $relationship]);
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
         're_name' => 'required',

      ];
      $data = $this->validate(request(), $rules, [], [
         're_name' => trans('admin.re_name'),
      ]);
      $data['admin_id'] = admin()->user()->id;
      Relationship::where('id', $id)->update($data);

      session()->flash('success', trans('admin.updated'));
      return redirect(aurl('relationship'));
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * destroy a newly created resource in storage.
    * @param  \Illuminate\Http\Request  $r
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $relationship = Relationship::find($id);

      @$relationship->delete();
      session()->flash('success', trans('admin.deleted'));
      return back();
   }

   public function multi_delete(Request $r)
   {
      $data = $r->input('selected_data');
      if (is_array($data)) {
         foreach ($data as $id) {
            $relationship = Relationship::find($id);

            @$relationship->delete();
         }
         session()->flash('success', trans('admin.deleted'));
         return back();
      } else {
         $relationship = Relationship::find($data);

         @$relationship->delete();
         session()->flash('success', trans('admin.deleted'));
         return back();
      }
   }
}
