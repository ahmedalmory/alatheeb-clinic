<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\PatientsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Appoint;
use App\Models\Patient;
use Form;
use Illuminate\Http\Request;
use Up;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class PatientsController extends Controller
{

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Display a listing of the resource.
    * @return \Illuminate\Http\Response
    */
   public function index(PatientsDataTable $patients)
   {
      return $patients->render('admin.patients.index', ['title' => trans('admin.patients')]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * Show the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.patients.create', ['title' => trans('admin.create')]);
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
         'f_number'               => 'numeric|nullable|sometimes',
         'record_date'            => 'nullable|sometimes|date|date_format:Y-m-d',
         'first_name'             => 'required|string',
         'father_name'            => 'required|string',
         'grand_name'             => 'required|string',
         'title'                  => 'required|string',
         'dep_id'                 => 'required|numeric',
         'relation_id'            => 'numeric|nullable|sometimes',
         'gender'                 => 'required',
         'nationality'            => 'numeric|nullable|sometimes',
         'date_birh_hijri'        => 'required|date_format:Y-m-d',
         'age'                    => 'numeric|nullable|sometimes',
         'mobile'                 => 'numeric|nullable|sometimes',
         'phone'                  => 'nullable|sometimes|string',
         'email'                  => 'nullable|sometimes',
         'mobile_nearby'          => 'nullable|sometimes',

         'comments'               => 'nullable|sometimes',
         'civil'                  => '',
         'last_update_at'         => '',
         'purpose_visit'          => '',
         'teeth_medicine'         => '',
         'heart_disease'          => '',
         'asthma'                 => '',
         'high_low_blood'         => '',
         'rheumatic_fever'        => '',
         'anemia'                 => '',
         'thyroid_disease'        => '',
         'hepatitis'              => '',
         'diabetes'               => '',
         'kidney_disease'         => '',
         'tics'                   => '',
         'other_diseases'         => '',
         'sensitivity_penicillin' => '',
         'taking_drugs'           => '',
         'drugs_names'            => '',
         'pregnant'               => '',

      ];
      $data = $this->validate(request(), $rules, [], [
         'dep_id'          => trans('admin.dep_id'),
         'f_number'        => trans('admin.f_number'),
         'civil'           => trans('admin.civil'),
         'record_date'     => trans('admin.record_date'),
         'first_name'      => trans('admin.first_name'),
         'father_name'     => trans('admin.father_name'),
         'grand_name'      => trans('admin.grand_name'),
         'title'           => trans('admin.title'),
         'relation_id'     => trans('admin.relation_id'),
         'gender'          => trans('admin.gender'),
         'nationality'     => trans('admin.nationality'),
         'date_birh_hijri' => trans('admin.date_birh_hijri'),
         'age'             => trans('admin.age'),
         'mobile'          => trans('admin.mobile'),
         'phone'           => trans('admin.phone'),
         'email'           => trans('admin.email'),
         'mobile_nearby'   => trans('admin.mobile_nearby'),
         'comments'        => trans('admin.comments'),
         'last_update_at'  => trans('admin.last_update_at'),
      ]);

      $data['admin_id'] = admin()->user()->id;
      $hijri            = explode('-', request('date_birh_hijri'));

      $data['age'] = calculate_age(Hijri2Greg($hijri[2], $hijri[1], $hijri[0], true));
      $patient     = Patient::create($data);

      // \App\Files::where('type_id', request('tmpid'))->where('type_file', 'patient')->update(['type_id' => $patient->id]);

      session()->flash('success', trans('admin.added'));
      return redirect(aurl('patients'));
   }

   /**
    * Display the specified resource.
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      $patients = Patient::find($id);
      $appoints = Appoint::where('patient_id', $patients->id)->orderBy('id', 'desc')->paginate(10);
      return view('admin.patients.show', ['title' => trans('admin.show'), 'patients' => $patients, 'appoints' => $appoints]);
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * edit the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $patients = Patient::find($id);
      return view('admin.patients.edit', ['title' => trans('admin.edit'), 'patients' => $patients]);
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
         'f_number'               => 'numeric|nullable|sometimes',
         'record_date'            => 'nullable|sometimes|date|date_format:Y-m-d',
         'first_name'             => 'required|string',
         'father_name'            => 'required|string',
         'grand_name'             => 'required|string',
         'dep_id'                 => 'required|numeric',
         'title'                  => 'required|string',
         'relation_id'            => 'numeric|nullable|sometimes',
         'gender'                 => 'required',
         'nationality'            => 'numeric|nullable|sometimes',
         'date_birh_hijri'        => 'required|date_format:Y-m-d',
         'age'                    => 'numeric|nullable|sometimes',
         'mobile'                 => 'numeric|nullable|sometimes',
         'phone'                  => 'nullable|sometimes|string',
         'email'                  => 'nullable|sometimes',
         'mobile_nearby'          => 'nullable|sometimes',

         'comments'               => 'nullable|sometimes',
         //'last_update_at'         => '',
         'civil'                  => '',
         'purpose_visit'          => '',
         'teeth_medicine'         => '',
         'asthma'                 => '',
         'heart_disease'          => '',
         'high_low_blood'         => '',
         'rheumatic_fever'        => '',
         'anemia'                 => '',
         'thyroid_disease'        => '',
         'hepatitis'              => '',
         'diabetes'               => '',
         'kidney_disease'         => '',
         'tics'                   => '',
         'other_diseases'         => '',
         'sensitivity_penicillin' => '',
         'taking_drugs'           => '',
         'drugs_names'            => '',
         'pregnant'               => '',

      ];
      $data = $this->validate(request(), $rules, [], [
         'civil'           => trans('admin.civil'),
         'dep_id'          => trans('admin.dep_id'),
         'f_number'        => trans('admin.f_number'),
         'record_date'     => trans('admin.record_date'),
         'first_name'      => trans('admin.first_name'),
         'father_name'     => trans('admin.father_name'),
         'grand_name'      => trans('admin.grand_name'),
         'title'           => trans('admin.title'),
         'relation_id'     => trans('admin.relation_id'),
         'gender'          => trans('admin.gender'),
         'nationality'     => trans('admin.nationality'),
         'date_birh_hijri' => trans('admin.date_birh_hijri'),
         'age'             => trans('admin.age'),
         'mobile'          => trans('admin.mobile'),
         'phone'           => trans('admin.phone'),
         'email'           => trans('admin.email'),
         'mobile_nearby'   => trans('admin.mobile_nearby'),
         'comments'        => trans('admin.comments'),
         'last_update_at'  => trans('admin.last_update_at'),
      ]);
      // $data['last_update_at'] = admin()->user()->id;
      $hijri = explode('-', request('date_birh_hijri'));

      $data['age'] = calculate_age(Hijri2Greg($hijri[2], $hijri[1], $hijri[0], true));
      Patient::where('id', $id)->update($data);

      session()->flash('success', trans('admin.updated'));
      return redirect(aurl('patients'));
   }

   public function upload_files()
   {
      if (request()->hasFile('file') and request()->has('tmpid')) {
         $data = it()->upload('file', 'patients/' . time(), 'patient', request('tmpid'), null, admin()->user()->id);

         $file = \App\Files::where('file', explode('100_', $data)[1])->first()->id;

         return response(['status' => true, 'data' => $data, 'id' => $file], 200);
      }
   }

   public function delete_files()
   {
      if (request()->has('fid') and request()->has('tmpid')) {
         $tmp = \App\Files::where('id', request('fid'))->where('type_id', request('tmpid'))->first();
         if (!empty($tmp)) {
            //  return $tmp;
            it()->delete(null, null, $tmp->id);
            return response(['status' => true, 'data' => 'file Deleted'], 200);
         }
      }
   }

   /**
    * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
    * destroy a newly created resource in storage.
    * @param  \Illuminate\Http\Request  $r
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $patients = Patient::find($id);
      it()->delete($id, 'patient');
      @$patients->forceDelete();
      session()->flash('success', trans('admin.deleted'));
      return back();
   }

   public function multi_delete(Request $r)
   {
      $data = $r->input('selected_data');
      if (is_array($data)) {
         foreach ($data as $id) {
            $patients = Patient::find($id);
            it()->delete($id, 'patient');
            @$patients->forceDelete();
         }
         session()->flash('success', trans('admin.deleted'));
         return back();
      } else {
         $patients = Patient::find($data);
         it()->delete($data, 'patient');
         @$patients->forceDelete();
         session()->flash('success', trans('admin.deleted'));
         return back();
      }
   }
}
