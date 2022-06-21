@extends('doctor.layout.index') @section('content') @push('js')
<script type="text/javascript" src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css" />
@endpush
<script>
    function add_file(id) {
        $("#status_msg").html("");
        try {
            $("#addcompany").modal("show");
            $.ajax({
                url: "/file_add",
                data: {
                    _token: "{!! csrf_token() !!}",
                    id: id
                },
                type: "POST",
                cache: false,
                success: function(frm) {
                    $("#box").html(frm);
                },
                error: function(xhr) {
                    $("#box").html(xhr.status + " " + xhr.statusText);
                }
            });
        } catch (e) {
            alert(e.message);
        }
    }

    $(document).ready(function() {
        $("#save_company").on("submit", function(e) {
            var file_name = $("#file_name").val();
            if (file_name === "") {
                $.notify("فضلا اكتب اسم الملف");
                $("#file_name").focus();
                e.preventDefault();
            } else {
                e.preventDefault();
                var fd = new FormData(this);
                $.ajax({
                    url: "/saveFile",
                    data: fd,
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token()}}"
                    },
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: "json",
                    success: function(data) {
                        $.notify(data.text, data.cls);
                        $("#save_company")[0].reset();
                        $("#file_name").focus();
                    },
                    error: function(xhr) {
                        alert("Error: - " + xhr.status + " " + xhr.statusText);
                    }
                });
            }
        });
    });
</script>
<div id="patientsshow">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <div class="sidebar">
                <ul>
                    <li class="{{
                            request('data') == 'main' || empty(request('data'))
                                ? 'active'
                                : ''
                        }}">
                        <a href="{{ url()->current() }}?data=main">{{
                            trans("admin.main_info")
                            }}</a>
                    </li>
                    <li class="{{
                            request('data') == 'facture' ? 'active' : ''
                        }}">
                        <a href="{{ url()->current() }}?data=facture">فواتير المريض</a>
                    </li>
                    <li class="{{
                            request('data') == 'appoints' ? 'active' : ''
                        }}">
                        <a href="{{ url()->current() }}?data=appoints">مواعيد المريض</a>
                    </li>
                    <li class="{{
                            request('data') == 'diagnosis' ? 'active' : ''
                        }}">
                        <a href="{{ url()->current() }}?data=diagnosis">تشخيصات</a>
                    </li>
                    <li class="{{ request('data') == 'files' ? 'active' : '' }}">
                        <a href="{{ url()->current() }}?data=files">{{
                            trans("admin.files")
                            }}</a>
                    </li>
                    <li class="{{
                            request('data') == 'contact' ? 'active' : ''
                        }}">
                        <a href="{{ url()->current() }}?data=contact">{{
                            trans("admin.contact_info")
                            }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
            <div class="tablearea">
                @if(request('data') === 'appoints')
                <table class="table table-condensed table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>رقم الموعد</th>
                            <th>الفترة</th>
                            <th>اليوم</th>
                            <th>الوقت</th>
                            <th>العيادة</th>
                            <th>الطبيب</th>
                            <th>حالة الحضور</th>
                        </tr>
                    </thead>
                    @foreach(App\Models\Appoint::where('patient_id',$patients->id)->orderBy('id',
                    'desc')->get() as $appoint)
                    <tr>

                        <td>{{ $appoint->id }}</td>
                        <td>{{ trans('admin.'.$appoint->period) }}</td>
                        <td>{{ $appoint->in_day }}</td>
                        <td>{{ $appoint->in_time }}</td>
                        <td>{{ $appoint->dep->dep_name ?? "" }}</td>
                        <td>{{ $appoint->user->name ?? "" }}</td>
                        <td>{{ trans('admin.'.$appoint->attend_status) }}</td>
                    </tr>
                    @endforeach
                </table>

                @endif
                @if(request('data') === 'facture')
                <a href="?data=facture" class="btn btn-success btn-sm">الكل</a>
                <a href="?data=facture&status=paid" class="btn btn-info btn-sm">مسددة</a>
                <a href="?data=facture&status=unpaid" class="btn btn-danger btn-sm">غير مسددة</a>
                <table class="table table-condensed table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>رقم الفاتورة</th>
                            <th>المريض</th>
                            <th>الدكتور</th>
                            <th>المحاسب</th>
                            <th>تاريخ الفاتورة</th>
                            <th>الاجمالى</th>
                            <th>حالة الفاتورة</th>
                            <th>إدارة</th>
                        </tr>
                    </thead>
                    @foreach(App\Models\invoice_main::where('patient_id',$patients->id)->where(function($q){
                    if (request()->status){
                    $q->where('invoice_status',request('status'));
                    }
                    })->with('patient_id')
                    ->with('accountant_id')->with('accountant_id')->with('dr_id')->orderBy('id',
                    'desc')->get() as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>
                            {!! $patients->first_name !!} {!!
                            $patients->father_name !!} {!! $patients->grand_name
                            !!}
                        </td>
                        <td>{{$invoice->dr_id->name}}</td>
                        <td>{{$invoice->accountant_id->name ?? "غير محدد"}}</td>
                        <td>{{ $invoice->in_day}}</td>
                        <td>{{$invoice->total_amount}}</td>
                        <td>
                            {{ ($invoice->invoice_status === 'paid') ? "مسددة" : "غير مسددة" }}
                        </td>
                        <td>
                            <p>
                                <a href="{{
                                    url('/tasdeed_invoice/'.$invoice->id.'')
                                }}" style="display: inline;" class="btn btn-sm btn-info" title="تعديل"><i
                                        class="fa fa-pencil-square-o"></i>
                                </a>
                            </p>
                        </td>
                    </tr>
                    @endforeach
                </table>

                @endif
                @if(request('data') === 'diagnosis')
                <table class="table table-condensed table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>المريض</th>
                            <th>الدكتور</th>
                            <th>الساعة</th>
                            <th>اليوم</th>
                            <th>الفترة</th>
                            <th>العيادة</th>
                            <th>ادارة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(App\Models\Diagnos::where('patient_id',
                        $patients->id)->with('dr_id_other')->with('patient_id_other')
                        ->orderBy('id', 'desc')->select('diagnos.*')->get() as
                        $diagnos)
                        <tr>
                            <th>
                                {{ $diagnos->patient_id_other->first_name }}
                            </th>
                            <th>{{ $diagnos->dr_id_other->name }}</th>
                            <th>{{ $diagnos->in_time }}</th>
                            <th>{{ $diagnos->in_day }}</th>
                            <th>
                                {{ ($diagnos->period === 'morning') ? 'صباحية' : 'مسائية' }}
                            </th>
                            <td>
                                {{$diagnos->appointment->dep->dep_name}}
                            </td>
                            <th>
                                <a href="{{ url('diagnosis/'.$diagnos->id.'/edit') }}" class="btn btn-info btn-sm"><i
                                        class="fa fa-pencil-square-o"></i>
                                    تعديل</a>
                                <a href="{{ url('diagnosis/'.$diagnos->id.'') }}" class="btn btn-default btn-sm"><i
                                        class="fa fa-eye"></i> عرض</a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @endif

                <div class="table-responsive">
                    <table class="table table-condensed  {{
                            !empty(request('data')) && request('data') != 'main'
                                ? 'hidden'
                                : ''
                        }}
                            table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans("admin.f_number") }}</th>

                                <th>{{ trans("admin.name") }}</th>
                                <th>{{ trans("admin.civil") }}</th>
                                <th>{{ trans("admin.nationality") }}</th>
                                <th>{{ trans("admin.gender") }}</th>
                                <th>{{ trans("admin.date_birh_hijri") }}</th>
                                <th>{{ trans("admin.age") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{!! $patients->id !!}</td>

                                <td>
                                    {!! $patients->first_name !!} {!!
                                    $patients->father_name !!} {!!
                                    $patients->grand_name !!}
                                </td>
                                <td>{!! $patients->civil !!}</td>
                                <td>{!! @$patients->national->nat_name !!}</td>
                                <td>
                                    {!! trans('admin.'.$patients->gender) !!}
                                </td>
                                <td>{!! $patients->date_birh_hijri !!}</td>
                                <td>{!! $patients->age !!}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-condensed  {{
                            request('data') != 'contact' ? 'hidden' : ''
                        }} table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans("admin.mobile") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{!! @$patients->mobile !!}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-condensed  {{
                            request('data') != 'file_health' ? 'hidden' : ''
                        }} table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans("admin.u_number") }}</th>
                                <th>{{ trans("admin.vr") }}</th>
                                <th>{{ trans("admin.record_date") }}</th>
                                <th>{{ trans("admin.last_visit") }}</th>
                                <th>{{ trans("admin.case_id") }}</th>
                                <th>{{ trans("admin.comments") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{!! @$patients->u_number !!}</td>
                                <td>{!! trans('admin.'.$patients->vr) !!}</td>
                                <td>{!! @$patients->record_date !!}</td>
                                <td>{!! @$patients->updated_at !!}</td>
                                <td>{!! @$patients->case->case_name !!}</td>
                                <td>{!! @$patients->comments !!}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-condensed  {{
                            request('data') != 'health' ? 'hidden' : ''
                        }} table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans("admin.smoking") }}</th>
                                <th>{{ trans("admin.blood_id") }}</th>
                                <th>{{ trans("admin.chronic_id") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {!! trans('admin.'.$patients->smoking) !!}
                                </td>
                                <td>{!! @$patients->blood->blood_name !!}</td>
                                <td>
                                    {!! @$patients->chronic->disease_name !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table {{
                            request('data') != 'files' ? 'hidden' : ''
                        }}  table-condensed table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <td colspan="4">
                                    <button type="button" class="btn btn-primary"
                                        onclick="add_file({{$patients->id}});">
                                        تحميل ملفات +
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 5%;">م</th>
                                <th style="text-align: right;">اسم الملف</th>
                                <th style="width: 8%;">معاينة</th>
                                <th style="width: 8%;">طباعة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patient_files as $file)
                            <tr>
                                <td>{{ $file->id }}</td>
                                <td style="text-align: right;">
                                    {{ $file->file_name }}
                                </td>
                                <td>
                                    <a href="{{ url('storage/images/patient_files/'.$file->image) }}" target="_blank"
                                        class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                </td>
                                <td>
                                    <button
                                        onclick="printJS({printable:'{{ url('storage/images/patient_files/'.$file->image) }}', type:'{{ preg_match('/image/i',$file->mimtype)?'image':'' }}{{ preg_match('/pdf/i',$file->mimtype)?'pdf':'' }}{{ !preg_match('/image|pdf/i',$file->mimtype)?'html':'' }}', showModal:false})"
                                        class="btn btn-warning">
                                        <i class="fa fa-print"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
                <div class="clearfix"></div>

                <div class="showuserpage">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <span>{{ trans("admin.id") }} :
                                <p>{{$patients->id}}</p>
                            </span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <span>{{ trans("admin.user_id") }} :
                                <p>{{ @$patients->user->name }}</p>
                            </span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <span>{{ trans("admin.last_update_user_id") }} :
                                <p>
                                    {{ @$patients->update_user_id->name }}
                                </p>
                            </span>
                        </div>
                        @if(!empty($patients->last_update_at_id))
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <span>{{ trans("admin.last_update_at") }} :
                                <p>
                                    {!!
                                    @$patients->last_update_at()->first()->name
                                    !!}
                                </p>
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                @endsection
            </div>
        </div>
    </div>
    <!-- end container -->
    {!! modelBox("addcompany","اضافة ملف","box","status_msg","save_company") !!}
</div>