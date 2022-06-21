<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\NationalitiesDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Nationalities;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class NationalitiesController extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(NationalitiesDataTable $nationalities)
            {
               return $nationalities->render('admin.nationalities.index',['title'=>trans('admin.nationalities')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
               return view('admin.nationalities.create',['title'=>trans('admin.create')]);
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
             'nat_name'=>'required',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'nat_name'=>trans('admin.nat_name'),

              ]);
		
              $data['admin_id'] = admin()->user()->id; 
              Nationalities::create($data); 

              session()->flash('success',trans('admin.added'));
              return redirect(aurl('nationalities'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $nationalities =  Nationalities::find($id);
                return view('admin.nationalities.show',['title'=>trans('admin.show'),'nationalities'=>$nationalities]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $nationalities =  Nationalities::find($id);
                return view('admin.nationalities.edit',['title'=>trans('admin.edit'),'nationalities'=>$nationalities]);
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
             'nat_name'=>'required',

                         ];
             $data = $this->validate(request(),$rules,[],[
             'nat_name'=>trans('admin.nat_name'),
                   ]);
              $data['admin_id'] = admin()->user()->id; 
              Nationalities::where('id',$id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('nationalities'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $nationalities = Nationalities::find($id);


               @$nationalities->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$nationalities = Nationalities::find($id);

                    	@$nationalities->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $nationalities = Nationalities::find($data);
 

                    @$nationalities->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }

            
}