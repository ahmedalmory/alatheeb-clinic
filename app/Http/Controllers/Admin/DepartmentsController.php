<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Storage;

class DepartmentsController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return view('admin.departments.index', ['title' => trans('admin.departments')]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.departments.create', ['title' => trans('admin.add')]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store()
   {

      $data = $this->validate(request(),
         [
            'dep_name' => 'required',
            'parent'   => 'sometimes|nullable|numeric',
         ], [], [
            'dep_name' => trans('admin.dep_name'),
            'parent'   => trans('admin.parent'),
         ]);

      Department::create($data);
      session()->flash('success', trans('admin.added'));
      return redirect(aurl('departments'));
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $department = Department::find($id);
      $title      = trans('admin.edit');
      return view('admin.departments.edit', compact('department', 'title'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $r, $id)
   {

      $data = $this->validate(request(),
         [
            'dep_name' => 'required',
            'parent'   => 'sometimes|nullable|numeric',
         ], [], [
            'dep_name' => trans('admin.dep_name'),
            'parent'   => trans('admin.parent'),
         ]);

      Department::where('id', $id)->update($data);
      session()->flash('success', trans('admin.updated'));
      return redirect(aurl('departments'));
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public static function delete_parent($id)
   {
      $department_parent = Department::where('parent', $id)->get();
      foreach ($department_parent as $sub) {
         self::delete_parent($sub->id);
         $subdepartment = Department::find($sub->id);
         if (!empty($subdepartment)) {
            $subdepartment->delete();
         }
      }
      $dep = Department::find($id);
      $dep->delete();
   }

   public function destroy($id)
   {
      self::delete_parent($id);
      session()->flash('success', trans('admin.deleted'));
      return redirect(aurl('departments'));
   }
}
