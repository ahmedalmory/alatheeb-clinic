<?php
foreach ($patient as $item) { ?>
<div class="col-md-3">
        <input type="hidden" class="form-control" id="natio"  value="<?=$item->nationality;?>" disabled>
</div>
<h5 style="padding: 5px;">
    {{trans('admin.patient_name')}}: <span
        style="font-size: 14px;border: none;padding: 3px; background: #36c6d3 !important;color: #fff;font-weight: bold;"> <?=$item->first_name;?></span>
</h5>
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'tashkhees')">{{trans('admin.Current diagnosis')}}</button>
    <button class="tablinks" onclick="openCity(event, 'isdar')">{{trans('admin.Issuing an invoice')}}</button>
    <button class="tablinks" onclick="openCity(event, 'bayanat')">{{trans('admin.Patient data')}}</button>
{{--    <button class="tablinks" onclick="openCity(event, 'sabiqa')">تشخيصات سابقة</button>--}}
    <a class="tablinks" target="_blank" href="{{route('doctor.diagnosis')}}?patient_id={{$item->id}}">{{trans('admin.previous diagnoses')}}</a>
    <button class="tablinks" onclick="openCity(event, 'tahweel')">{{trans('admin.Transfer the patient')}}</button>
{{--    <button class="tablinks" onclick="openCity(event, 'files')">اضف ملفات للمريض</button>--}}
</div>
<div id="files" class="tabcontent">
    <h4>اضف ملفات للمريض</h4>
    <form class="form-body" action="{{url("doctor/patient/$item->id/files")}}" method="post"
          enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="patient_id" value="{{$item->id}}">
        <div class="form-group">
            <label for="">المسمي</label>
            <input class="form-control" name="file_name" type="text">
        </div>
        <div class="form-group">
            <label for="">الملفات</label>
            <input class="form-control" name="files[]" type="file">
        </div>
        <button class="btn btn-primary">اضافة</button>
    </form>
</div>
<div id="tashkhees" class="tabcontent">
    التشخيص : <textarea class="form-control" name="tratment" id="tratment"
                        placeholder="يعنى من الم في الاسنان....."></textarea>
    الاجراء المتخذ : <textarea class="form-control" id="taken" name="taken"></textarea></br>
    <button type="button" class="btn btn-danger btn-lg pull-left">الغاء الجلسة</button>
</div>

<div id="isdar" class="tabcontent">
    <div class="row">
        <div class="col-md-3">
            التصنيف :
            <select class="form-control" id="cat_id" onclick="get_products()">
                <option value="">اختر التصنيف</option>
                @foreach($category AS $cat)
                    <option value="{{ $cat->id }}">{{ $cat->cat_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            الخدمة :
            <select class="form-control" id="product_id" onchange="add_item_invoice()">

            </select>
        </div>
        <div class="col-md-2">
            الالإجمالي <h1 id="t_total">0</h1>
        </div>
        <div class="col-md-3">
            <button class="btn btn-success" onclick="save_treatment('<?=$item->id;?>','<?=$appoint_id;?>')">حفظ التشخيص
                وانهاء الجلسة
            </button>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>اسم التصنيف</th>
                    <th>اسم الخدمة</th>
                    <th>السعر</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="msg">

                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="bayanat" class="tabcontent">
    <table class="table table-bordered">
        <tr>
            <th>رقم السجل</th>
            <th>رقم الهوية / الاقامة</th>
            <th>اسم المريض</th>
            <th>رقم الجوال</th>
            <th></th>
        </tr>
        <tr>
            <td><?=$item->id;?></td>
            <td><?=$item->civil;?></td>
            <td><?=$item->first_name;?></td>
            <td><?=$item->mobile;?></td>
            <td><a href="{{url('/doctor/patients/'.$item->id)}}" class="btn btn-info btn-sm">كامل البيانات</a></td>
        </tr>
    </table>
</div>
{{--<div id="sabiqa" class="tabcontent">--}}
{{--    @php--}}
{{--    $table = new \App\DataTables\DiagnosisDataTable();--}}
{{--    @endphp--}}
{{--    {!! $table->render('doctor.datatables_show',['title'=>"اخر التشخيصات"]) !!}--}}

{{--</div>--}}
<div id="tahweel" class="tabcontent">

    <div class="col-md-12">
        تحويل الي طبيب آخر
        <table class="table table-bordered">
            <tr>
                <th>العيادة</th>
                <th>الطبيب</th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <select name="dep_id" id="dep_id" class="form-control" onchange="get_doctors()">
                        <option value="">اختر العيادة</option>
                        @foreach($departments AS $dep)
                            <option value="{{ $dep->id }}">{{ $dep->dep_name }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td><select class="form-control" id="doctors">

                    </select></td>
                <td>
                    @user_can("specials-transfer_patients")
                    <button type="button" class="btn btn-primary"
                            onclick="tahweel_patient('<?=$item->id;?>','<?=$appoint_id;?>','<?=$doctor_current;?>');">
                        تحويل
                    </button>
                    @end_user_can
                </td>


            </tr>
        </table>
    </div>

</div>
<?php
	 }
	 ?>
