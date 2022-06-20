<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Model\Forms;
use App\Model\Page;
use App\Model\Patient;
use App\Model\Product;
use App\Model\Appoint;
use App\Model\Diagnos;
use App\Model\invoice_main;
use App\Model\invoice_detail;
use Carbon\Carbon;
use App\Model\Patients_files;
use App\User;
use Validator;

date_default_timezone_set('Asia/Riyadh');

class HomeController extends Controller
{


    public function searchPatient(Request $request)
    {
        if($request->type === "dossier")
            $query = Patient::where("id", $request->value)->first();

        if($request->type === "number_id")
            $query = Patient::where("civil", $request->value)->first();

        if($request->type === "phone")
            $query = Patient::where("mobile", $request->value)->first();

        if($query)
            return Response()->json(["ok" => true, "message" => "تم تحديد {$query->first_name} بنجاح", "data" => $query]);
        else
            return Response()->json(["ok" => false, "message" => "لم يعتر علي نتائج متطابقة للمدخلات"]);
    }

    public function home(Request $request)
    {
         $patients = Patient::orderBy('id', 'desc')->where('status', 'default')->paginate(10);
        if ($request->id) $filter = Patient::where('id', $request->id)->paginate(10);
        if ($request->civil) $filter =  Patient::where('civil', $request->civil)->paginate(10);
        if ($request->phone) $filter =  Patient::where('mobile', $request->phone)->paginate(10);
        return view('style.home', ['title' => trans('admin.patients'), 'patients' => ($request->id || $request->civil || $request->phone) ? $filter : $patients]);
    }


    public function dashboard()
    {
        if (Auth::user()->level == 'dr') {
            $total_patient =  DB::table('patients')->get();
            $total_patient = $total_patient->count();
            $total_patient_today =  DB::table('patients')->whereDate('created_at', DB::raw('CURDATE()'))->get();
            $total_patient_today = $total_patient_today->count();
            $total_user =  DB::table('users')->where('group_id',  '<>', '1')->get();
            $total_user = $total_user->count();
            $total_doctor =  DB::table('users')->where('group_id', '1')->get();
            $total_doctor = $total_doctor->count();
            $total_departments =  DB::table('departments')->get();
            $total_departments = $total_departments->count();
            return view('style.dashboard_doctor', compact('total_patient', 'total_patient_today', 'total_user', 'total_doctor', 'total_departments'));
        } else {
            $total_patient =  DB::table('patients')->get();
            $total_patient = $total_patient->count();
            $total_patient_today =  DB::table('patients')->whereDate('created_at', DB::raw('CURDATE()'))->get();
            $total_patient_today = $total_patient_today->count();
            $total_user =  DB::table('users')->where('group_id',  '<>', '1')->get();
            $total_user = $total_user->count();
            $total_doctor =  DB::table('users')->where('group_id', '1')->get();
            $total_doctor = $total_doctor->count();
            $total_departments =  DB::table('departments')->get();
            $total_departments = $total_departments->count();
            return view('style.dashboard', compact('total_patient', 'total_patient_today', 'total_user', 'total_doctor', 'total_departments'));
        }
    }


    public function instructions()
    {

        return view('style.instructions', ['title' => trans('admin.instructions'), 'page' => Page::find(1)]);
    }

    public function forms()
    {

        return view('style.forms', ['title' => trans('admin.forms'), 'forms' => Forms::orderBy('id', 'desc')->paginate(100)]);
    }

    public function search()
    {
        $patients = Patient::where(function ($q) {
            !empty(request('search_civil')) ? $q->where('id', request('search_civil')) : '';
            return $q;
        })->paginate(10);
        return view('style.search_data', ['title' => trans('admin.result'), 'patients' => $patients]);
    }

    public function create()
    {
        return view('style.patients.create', ['title' => trans('admin.create')]);
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
            'relation_id'            => 'numeric|nullable|sometimes',
            'gender'                 => 'required',
            'nationality'            => 'numeric|required',
            'date_birh_hijri'        => 'date_format:Y-m-d|nullable',
            'age'                    => 'numeric|nullable|sometimes',
            'mobile'                 => 'numeric|nullable|sometimes',
            'email'                  => 'nullable|sometimes',

            'comments'               => 'nullable|sometimes',
            'civil'                  => 'numeric|required',
            'last_update_at'         => '',
            'purpose_visit'          => '',
            'teeth_medicine'         => '',
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
            'asthma'                 => '',

        ];
        $data = $this->validate(request(), $rules, [], [
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

        $data['user_id']             = auth()->user()->id;
        $data['last_update_user_id'] = auth()->user()->id;
        $hijri                       = explode('-', request('date_birh_hijri'));

        $data['age'] = calculate_age(Hijri2Greg($hijri[2], $hijri[1], $hijri[0], true));
        // return dd($data);
        $patient = Patient::create($data);

        // \App\Files::where('type_id', request('tmpid'))->where('type_file', 'patient')->update(['type_id' => $patient->id]);

        session()->flash('success', trans('admin.added'));
        return redirect(url('add/patient'));
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
        $patient_files = DB::select(DB::raw("SELECT
  * FROM patients_files
WHERE patient_id = $id"));
        return view('style.patients.show', ['title' => trans('admin.show'), 'patients' => $patients, 'patient_files' => $patient_files]);
    }

    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * edit the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patients = Patient::find($id);
        return view('style.patients.edit', ['title' => trans('admin.edit'), 'patients' => $patients]);
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
            'father_name'            => '',
            'grand_name'             => '',
            'title'                  => '',
            'relation_id'            => 'numeric|nullable|sometimes',
            'gender'                 => 'required',
            'nationality'            => 'numeric|required',
            //'date_birh_hijri'        => 'date_format:Y-m-d',
            'age'                    => 'numeric|nullable|sometimes',
            'mobile'                 => 'numeric|nullable|sometimes',
            'phone'                  => 'numeric|nullable|sometimes',
            'email'                  => 'nullable|sometimes',
            'mobile_nearby'          => 'nullable|sometimes',
            'comments'               => 'nullable|sometimes',
            'civil'                  => 'numeric',
            'last_update_at'         => '',
            'purpose_visit'          => '',
            'teeth_medicine'         => '',
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
            'asthma'                 => '',

        ];

        $data = $this->validate(request(), $rules, [], [
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

        $data['user_id']             = auth()->user()->id;
        $data['last_update_user_id'] = auth()->user()->id;
        if(request()->date_birh_hijri){
            $hijri       = explode('-', request('date_birh_hijri'));
            $data['age'] = calculate_age(Hijri2Greg($hijri[2], $hijri[1], $hijri[0], true));
        }
        Patient::where('id', $id)->update($data);

        session()->flash('success', trans('admin.updated'));
        return back();
    }

    public function upload_files()
    {
        if (request()->hasFile('file') and request()->has('tmpid')) {
            $data = it()->upload('file', 'patients/' . time(), 'patient', request('tmpid'), auth()->user()->id, null);

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

    public function destroy(Request $request, $id)
    {
        $patients = Patient::where('id', $id)->update(
            ['status' => 'delete', 'reason' => $request->reason]
        );
        if($patients)
            return Response()->json(["ok" => true, "message" => "تم نقل الملف للمحدوفات"]);
        // // it()->delete($id, 'patient');
        // @$patients->delete();
        // session()->flash('success', trans('admin.deleted'));
        // return back();
    }

    public function multi_delete(Request $r)
    {
        $data = $r->input('selected_data');
        if (is_array($data)) {
            foreach ($data as $id) {
                $patients = Patient::find($id);
                //  it()->delete($id, 'patient');
                @$patients->delete();
            }
            session()->flash('success', trans('admin.deleted'));
            return back();
        } else {
            $patients = Patient::find($data);
            //it()->delete($data, 'patient');
            @$patients->delete();
            session()->flash('success', trans('admin.deleted'));
            return back();
        }
    }

    function company_edit(Request $request)
    {
        if ($request->id) {
            if (Patient::where('civil', $request->id)->exists()) {
                $patient = DB::select(DB::raw("SELECT
  * FROM patients
WHERE civil = $request->id"));
                $departments = DB::select(DB::raw("SELECT * FROM departments "));
                return view('style.patients.exist', compact('patient', 'departments'));
            } else {
                echo "no";
            }
        } else {
            echo "no1";
        }
    }
    function get_doctors(Request $request)
    {
        if ($request->id) {
            // $doctors = DB::select(DB::raw("SELECT * FROM users WHERE dep_id = $request->id AND level = 'dr'"));
            $call = ($request->id === 'all_dep') ? User::where('level', 'dr')->get() : User::where('level', 'dr')->where('dep_id', $request->id)->get();
            foreach ($call as $doc) {
                echo '<option value="' . $doc->id . '">' . $doc->name . '</option>';
            }
        }
    }
    function file_add(Request $request)
    {
        
        if (Patient::where('id', $request->id)->exists()) {
            $patient = DB::select(DB::raw("SELECT
  * FROM patients
WHERE id = $request->id"));
            return view('style.patients.file', compact('patient'));
        } else {
            echo "Record not found";
        }
    }
    function save_tahveel_patient(Request $request)
    {
        if (Appoint::where('patient_id', $request->id)->where('appoint_status', '<>', 3)->exists()) {
            echo json_encode(array('text' => 'المريض قيد التحويل تحقق من صفحة التحويلات ', 'cls' => 'error'));
        }else{
            $post = new Appoint;
            $post->patient_id = $request->id;
            $post->in_day = Carbon::now();
            $post->user_id = $request->doc_id;
            $post->dep_id = $request->dep_id;
            $post->appoint_status = '1';

            $post->in_time = $date = date('H:i');
            $msg = $post->save();
            if ($msg) {
                echo json_encode(array('text' => 'تمت تحويل المريض بنجاح', 'cls' => 'success'));
            } else {
                echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
            }
        }
    }

    function update_tahveel_patient(Request $request)

    {
        $post = Appoint::find($request->appoint_id);
        $post->in_day = Carbon::now();
        $post->user_id = $request->doc_id;
        $post->dep_id = $request->dep_id;
        $post->in_time = $date = date('H:i');
        $msg = $post->save();
        if ($msg) {
            echo json_encode(array('text' => 'تمت تحويل المريض بنجاح', 'cls' => 'success'));
        } else {
            echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
        }
    }
    function savePatient(Request $request)
    {
        
        $new_name = '';
        $validation = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nationality'=>'required'
        ]);
        if ($validation->passes()) {

            $image = $request->file('image');
            if ($image) {
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/patients'), $new_name);
            }
            $post = new Patient;
            $post->first_name = $request->first_name;
            $post->civil = $request->civil;
            $post->mobile = $request->mobile;
            $post->gender = $request->gender;
            $post->age = $request->age;
            $post->city_id = $request->city;
            $post->user_id = Auth::user()->id;
            $post->last_update_user_id = Auth::user()->id;
            $post->nationality = $request->nationality;
            $post->date_birh_hijri = $request->date_birh_hijri;
            $post->image = $new_name;
            $post->comments  = $request->comments;
            $post->purpose_visit = $request->purpose_visit;
            $post->teeth_medicine =  $request->teeth_medicine;
            $post->heart_disease =  $request->heart_disease;
            $post->high_low_blood =        $request->high_low_blood;
            $post->rheumatic_fever =       $request->rheumatic_fever;
            $post->anemia =               $request->anemia;
            $post->thyroid_disease =       $request->thyroid_disease;
            $post->hepatitis =           $request->hepatitis;
            $post->diabetes =       $request->diabetes;
            $post->kidney_disease =        $request->kidney_disease;
            $post->tics =                   $request->tics;
            $post->other_diseases =        $request->other_diseases;
            $post->sensitivity_penicillin = $request->sensitivity_penicillin;
            $post->taking_drugs =           $request->taking_drugs;
            $post->drugs_names =           $request->drugs_names;
            $post->pregnant =              $request->pregnant;
            $post->asthma =  $request->asthma;
            $msg = $post->save();
            if ($msg) {
                $patient = DB::select(DB::raw("SELECT
                * FROM patients
                WHERE civil = $request->civil"));
                $departments = DB::select(DB::raw("SELECT * FROM departments"));
                return view('style.patients.exist', [
                    'patient' => $patient,
                    'departments' => $departments,
                ]);
                //echo json_encode(array('text' => 'تمت حفظ البيانات بنجاح', 'cls' => 'success'));
            } else {
                //echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
            }
        } else {
            echo json_encode(array('text' => $validation->errors()->all(), 'cls' => 'error'));
        }
    }

    function saveFile(Request $request)
    {
        
        $new_name = '';
        $validation = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048'
        ]);
        if ($validation->passes()) {

            $image = $request->file('image');
            if ($image) {
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $extension = $image->getClientOriginalExtension();
                $image->move(base_path('images/patient_files'), $new_name);
                $post = new Patients_files;
                $post->file_name = $request->file_name;
                $post->patient_id = $request->pat_id;
                $post->image = $new_name;
                $post->mimtype = $extension;
                $post->user_id = \auth()->id();
                $msg = $post->save();
                if ($msg) {
                    echo json_encode(array('text' => 'تمت تحميل الملف بنجاح', 'cls' => 'success'));
                }
            } else {
                echo json_encode(array('text' => 'فضلا اختر ملف التحميل', 'cls' => 'error'));
            }
        } else {
            echo json_encode(array('text' => $validation->errors()->all(), 'cls' => 'error'));
        }
    }


public function deleteFile(Request $r){
    $file=Patients_files::findOrFail($r->file_id);
    $file->delete();
    return redirect()->back()->with('success','تم حذف الملف بنجاح');
}

    ///doctor start here
    public function dashboard_doctor()
    {
        $total_patient =  DB::table('patients')->get();
        $total_patient = $total_patient->count();
        $total_patient_today =  DB::table('patients')->whereDate('created_at', DB::raw('CURDATE()'))->get();
        $total_patient_today = $total_patient_today->count();
        $total_user =  DB::table('users')->where('group_id',  '<>', '1')->get();
        $total_user = $total_user->count();
        $total_doctor =  DB::table('users')->where('group_id', '1')->get();
        $total_doctor = $total_doctor->count();
        $total_departments =  DB::table('departments')->get();
        $total_departments = $total_departments->count();
        return view('style.dashboard_doctor', compact('total_patient', 'total_patient_today', 'total_user', 'total_doctor', 'total_departments'));
    }
    public function doctor_layout()
    {


        return view('style.doctor_layout');
    }
    public function doctor_layout_1()
    {
        $doc_id = Auth::user()->id;
        $appoints =  DB::table('appoints')->where('user_id', $doc_id)->where('appoint_status', '1')->whereDate('in_day', DB::raw('CURDATE()'))->get();
        $appoints_waiting =  DB::table('appoints')->where('user_id', $doc_id)->where('appoint_status', '!=', 3)->where('appoint_status', '!=', 1)->whereDate('in_day', DB::raw('CURDATE()'))->get();

        return view('style.doctor_layout_1', compact('appoints', 'appoints_waiting'));
    }

    function get_patient_detail(Request $request)
    {
        if (Patient::where('id', $request->id)->exists()) {
            $patient = DB::select(DB::raw("SELECT * FROM patients
WHERE id = $request->id"));
            $diagnos = DB::select(DB::raw("SELECT * FROM diagnos
WHERE patient_id = $request->id"));
            $appoint_id = $request->appoint_id;
            $doctor_current = Auth::user()->id;
            $category = DB::select(DB::raw("SELECT * FROM category "));
            $departments = DB::select(DB::raw("SELECT * FROM departments "));
            return view('style.patient_detail', compact('patient', 'category', 'appoint_id', 'departments', 'doctor_current', 'diagnos'));
        } else {
            echo "Record not found";
        }
    }
    //get products based on category
    function get_products(Request $request)
    {
        if ($request->id) {
            $products = DB::select(DB::raw("SELECT * FROM product WHERE cat_id = $request->id"));
            echo '<option value="">اختر الخدمة</option>';
            foreach ($products as $product) {


                echo '<option value="' . $product->id . '">' . $product->p_name . '</option>';
            }
        }
    }
    //invoice items
    function invoice_items(Request $request)
    {
        if (Product::where('id', $request->id)->exists()) {
            $product = DB::select(DB::raw("SELECT
  * FROM product
WHERE id = $request->id"));
            return view('style.invoice_items', compact('product'));
        } else {
            echo "Record not found";
        }
    }
    //save tratment by doctor
    function save_treatment(Request $request)
    {
        
        $sum=0;
            for ($i = 0; $i < count($request->p_id); $i++) {
                $p = Product::findOrFail($request->p_id[$i]);
                $sum+=$p->p_price;
            }

        $post = new Diagnos;
        $post->patient_id = $request->patient_id;
        $post->in_day = Carbon::now();
        $post->dr_id = Auth::user()->id;
        $post->group_id = Auth::user()->group_id;
        $post->dep_id = Auth::user()->dep_id;
        $post->appoint_id = $request->appoint_id;
        $post->treatment = $request->treatment;
        $post->taken = $request->taken;
        $post->in_time = $date = date('H:i');
        $msg = $post->save();
        if ($request->t_total > 0) {
            $post = new invoice_main;
            $post->total_amount = $request->t_total;
            $post->due = $request->t_total;
            $post->invoice_type = '2';
            $post->doc_id = Auth::user()->id;
            $post->group_id = Auth::user()->group_id;
            $post->dep_id = Auth::user()->dep_id;
            $post->patient_id = $request->patient_id;
            $post->in_day = Carbon::now();
            $post->in_time = $date = date('H:i');
            $post->appoint_id = $request->appoint_id;
            $post->tax_amount = $request->t_total-$sum;

            $msg = $post->save();
            $id = DB::getPdo()->lastInsertId();
            for ($i = 0; $i < count($request->p_id); $i++) {
                $post = new invoice_detail;
                $post->p_id = $request->p_id[$i];
                $post->p_cat = $request->p_cat[$i];
                $post->p_name = $request->p_name[$i];
                $post->p_price = $request->p_price[$i];
                $post->invoice_main_id = $id;
                $msg = $post->save();
            }
        }
        if ($msg) {
            $post = Appoint::find($request->appoint_id);
            $post->appoint_status = '3';
            $msg = $post->save();
            echo json_encode(array('text' => 'تحت حفظ التشخيص واصدارالفاتورة بنجاح وانهاء الجلسة', 'cls' => 'success'));
        } else {
            echo json_encode(array('text' => 'not saved', 'cls' => 'error'));
        }
    }
    public function tahveel()
    {
        return view('style.patients.tahveel');
    }
    public function tasnefat()
    {
        return view('style.invoices.tasnefat');
    }
    public function tasdeed_count()
    {
        $t_tasdeed =  DB::table('invoice_main')->where('invoice_type', '2')->get();
        $t_tasdeed = $t_tasdeed->count();
        echo ($t_tasdeed);
    }

    public function no_access()
    {
        return view('style.layouts.no_access');
    }
}
