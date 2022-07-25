<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Form;
use Illuminate\Http\Request;
use Up;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class UsersController extends Controller
{

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Display a listing of the resource.
    * @return \Illuminate\Http\Response
    */
   public function index(UsersDataTable $users)
   {
      return $users->render('admin.users.index', ['title' => trans('admin.users')]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Show the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.users.create', ['title' => trans('admin.create')]);
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
         'name'     => 'required|string',
         'email'    => 'required|unique:users,email',
         'password' => 'required',
         'group_id' => 'required|numeric',
         'dep_id'   => 'required|numeric',
         'level'    => 'required|in:dr,accountant,recep',
         'salary'    => 'required|numeric',
         'rate_active'   => 'nullable',
         'rate'   => 'nullable|numeric',

      ];
      $data = $this->validate(request(), $rules, [], [
         'name'     => trans('admin.name'),
         'email'    => trans('admin.email'),
         'password' => trans('admin.password'),
         'group_id' => trans('admin.group_id'),
         'dep_id'   => trans('admin.dep_id'),
         'level'    => trans('admin.level'),
         'salary'    => trans('admin.salary'),
         'rate'    => trans('admin.rate'),
         'rate_active'    => trans('admin.rate_active'),

      ]);
      if (request()->has('password')) {
         $data['password'] = bcrypt(request('password'));
      }
      $data['rate_active']=request('rate_active')?true:false;
      User::create($data);

      session()->flash('success', trans('admin.added'));
      return redirect(aurl('users'));
   }

   /**
    * Display the specified resource.
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      $users = User::find($id);
      return view('admin.users.show', ['title' => trans('admin.show'), 'users' => $users]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * edit the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $users = User::find($id);
      return view('admin.users.edit', ['title' => trans('admin.edit'), 'users' => $users]);
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
         'name'     => 'required|string',
         'email'    => 'required',
         //'password' => '',
         'group_id' => 'required|numeric',
         'dep_id'   => 'required|numeric',
         'salary'   => 'required|numeric',
         'rate_active'   => 'nullable',
         'rate'   => 'nullable|numeric',
         'level'    => 'required|in:dr,accountant,recep',

      ];
      $data = $this->validate(request(), $rules, [], [
         'name'     => trans('admin.name'),
         'email'    => trans('admin.email'),
         'password' => trans('admin.password'),
         'group_id' => trans('admin.group_id'),
         'dep_id'   => trans('admin.dep_id'),
         'level'    => trans('admin.level'),
         'salary'    => trans('admin.salary'),
         'rate'    => trans('admin.rate'),
         'rate_active'    => trans('admin.rate_active'),
      ]);
      if (request()->has('password')) {
         $data['password'] = bcrypt(request('password'));
      }
      $data['rate_active']=request('rate_active')?true:false;
      User::where('id', $id)->update($data);

      session()->flash('success', trans('admin.updated'));
      return redirect(aurl('users'));
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * destroy a newly created resource in storage.
    * @param  \Illuminate\Http\Request  $r
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $users = User::find($id);

      @$users->delete();
      session()->flash('success', trans('admin.deleted'));
      return back();
   }

   public function multi_delete(Request $r)
   {
      $data = $r->input('selected_data');
      if (is_array($data)) {
         foreach ($data as $id) {
            $users = User::find($id);

            @$users->delete();
         }
         session()->flash('success', trans('admin.deleted'));
         return back();
      } else {
         $users = User::find($data);

         @$users->delete();
         session()->flash('success', trans('admin.deleted'));
         return back();
      }
   }
}
