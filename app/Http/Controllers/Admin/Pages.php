<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\PagesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Form;
use Illuminate\Http\Request;
use Up;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class Pages extends Controller
{

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Display a listing of the resource.
    * @return \Illuminate\Http\Response
    */
   public function index(PagesDataTable $pages)
   {
      return $pages->render('admin.pages.index', ['title' => trans('admin.pages')]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Show the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.pages.create', ['title' => trans('admin.create')]);
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
         'page_title'   => 'required',
         'page_content' => 'nullable|sometimes',

      ];
      $data = $this->validate(request(), $rules, [], [
         'page_title'   => trans('admin.page_title'),
         'page_content' => trans('admin.page_content'),

      ]);

      $data['admin_id'] = admin()->user()->id;
      Page::create($data);

      session()->flash('success', trans('admin.added'));
      return redirect(aurl('pages'));
   }

   /**
    * Display the specified resource.
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      $pages = Page::find($id);
      return view('admin.pages.show', ['title' => trans('admin.show'), 'pages' => $pages]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * edit the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $pages = Page::find($id);
      return view('admin.pages.edit', ['title' => trans('admin.edit'), 'pages' => $pages]);
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
         'page_title'   => 'required',
         'page_content' => 'nullable|sometimes',

      ];
      $data = $this->validate(request(), $rules, [], [
         'page_title'   => trans('admin.page_title'),
         'page_content' => trans('admin.page_content'),
      ]);
      $data['admin_id'] = admin()->user()->id;
      Page::where('id', $id)->update($data);

      session()->flash('success', trans('admin.updated'));
      return redirect(aurl('pages'));
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * destroy a newly created resource in storage.
    * @param  \Illuminate\Http\Request  $r
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      if (1 == $id) {
         return back();
      }
      $pages = Page::find($id);

      @$pages->delete();
      session()->flash('success', trans('admin.deleted'));
      return back();
   }

   public function multi_delete(Request $r)
   {
      $data = $r->input('selected_data');
      if (is_array($data)) {
         foreach ($data as $id) {
            if (1 == $id) {
               return back();
            }
            $pages = Page::find($id);

            @$pages->delete();
         }
         session()->flash('success', trans('admin.deleted'));
         return back();
      } else {
         if (1 == $data) {
            return back();
         }
         $pages = Page::find($data);

         @$pages->delete();
         session()->flash('success', trans('admin.deleted'));
         return back();
      }
   }
}
