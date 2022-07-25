@extends('style.index')
@section('content')
@php
$appointments = \App\Models\Appoint::query()->where(function ($q){
if (request()->dep_id){
$q->where('dep_id',request('dep_id'));
}
})->whereNotNull('patient_id')->orderByDesc('id')->paginate(10);
@endphp

<style media="screen">
    @media (max-width: 768px) {
        .input-lg {
            width: 118px !important;
            margin-bottom: 15px;
        }

        .input-group {
            margin-bottom: 10px;
        }
    }
</style>
<div class="homepagetable">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="block4">
                <div class="label label-success">{{__('app.transferred_patients')}}</div>

                <br>
                <br>
                <a class="btn btn-success btn-sm " style="margin:5px" href="{{url()->current()}}">
                    {{__('app.departments_all')}}
                    <span class="badge badge-danger btn-sm">{{\App\Models\Appoint::query()->count()}}</span>
                </a>
                @foreach(\App\Models\Department::all() as $department)
                <a class="btn btn-success btn-sm " style="margin:5px" href="?dep_id={{$department->id}}">
                    {{$department->dep_name}}
                    <span class="badge badge-danger btn-sm">{{$department->appointments()->count()}}</span>
                </a>
                @endforeach
                <hr
                    style="padding-top: 2px; padding-bottom: 2px; margin-top: 6px; margin-bottom: 6px; border-color: #ccc;" />
                <div class="content">
                    <form method="get">
                        <div class="row no-gutters">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-addon">{{__("app.search_by_medical_number")}}</span>
                                    <input type="text" class="form-control input-lg" style="width: 100%;" name="id">
                                    <span class="input-group-addon">
                                        <button type="submit" class="btn btn-sm">{{__("app.search")}}</button>
                                    </span>
                                </div>
                            </div><!-- end col-lg-4 -->

                    </form>
                    <form method="get" action="?">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="input-group">
                                <span class="input-group-addon">{{__("app.search_by_id_number")}}</span>
                                <input type="text" class="form-control input-lg" style=" width: 100%;" name="civil">
                                <span class="input-group-addon">
                                    <button type="submit" class="btn btn-sm">{{__("app.search")}}</button>
                                </span>
                            </div>
                        </div><!-- end col-lg-4 -->
                    </form>

                    <form method="get" action="?">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="input-group">
                                <span class="input-group-addon">{{__("app.search_by_phone_number")}}</span>
                                <input type="text" class="form-control input-lg" style=" width: 100%;" name="phone">
                                <span class="input-group-addon">
                                    <button type="submit" class="btn btn-sm">{{__("app.search")}}</button>
                                </span>
                            </div>
                        </div><!-- end col-lg-4 -->
                    </form>
                </div>
                <hr />
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>{{ trans('admin.f_number') }}</th>
                                <th>{{ trans('admin.name') }}</th>
                                <th>{{ trans('admin.nationality') }}</th>
                                <th>{{ trans('admin.mobile') }}</th>
                                <th>{{ trans('admin.clinic') }}</th>
                                <th>{{ trans('admin.dr_id') }}</th>
                                <th>{{ trans('admin.civil') }}</th>
                                <th>تاريخ - وقت</th>
                                <th>{{ __('admin.treatment') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->patient_id }}</td>
                                <td>{{ $appointment->patient->first_name }} {{ $appointment->patient->father_name }}
                                    {{ $appointment->patient->grand_name }}</td>
                                <td>
                                    <?php
                                        $national = \DB::table('nationalities')->where('id', $appointment->patient->nationality)->first();
                                        if($national) echo $national->nat_name;
                                    ?>
                                </td>
                                <td>{{ $appointment->patient->mobile }}</td>
                                <td>{{ $appointment->dep->dep_name ?? ""}}</td>
                                <td>{{ $appointment->user->name ?? ""}}</td>
                                <td>{{ $appointment->patient->civil }}</td>
                                <td>{{ $appointment->in_day }} - {{$appointment->in_time}}</td>
                                <td>{{get_status($appointment->appoint_status)}}</td>
                                <td>
                                    {{-- @user_can("specials-transfer_patients")
                                    <a class="btn btn-primary btn-sm"
                                        href="{{url('transferred/edit/'.$appointment->id)}}">{{__('admin.reconversion')}}</a>
                                    @end_user_can --}}
                                    @include('style.appointments.buttons.actions',['id'=>$appointment->id])
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($appointments->count() < 1) <div class="alert alert-warning">لاتوجد بينات لعرضها .
                </div>

                @endif
            </div> <!-- end table-responsive -->
        </div><!-- end content -->
    </div><!-- end block4 -->
</div><!-- end col-lg-10 -->
</div><!-- end row -->


{!! $appointments->appends(request()->all())->render() !!}
</div><!-- end homepagetable -->
<script>
    function add_file(id) {
        $("#status_msg").html('');
        try {

            $("#addcompany").modal("show");
            $.ajax({
                url: 'file_add',
                data: {
                    _token: '{!! csrf_token() !!}',
                    id: id
                },
                type: 'POST',
                cache: false,
                success: function (frm) {
                    $("#box").html(frm);
                },
                error: function (xhr) {
                    $("#box").html(xhr.status + ' ' + xhr.statusText);
                }
            });
        } catch (e) {
            alert(e.message);
        }
    };
    $(document).ready(function () {
        $("#save_company").on('submit', (function (e) {
            var file_name = $('#file_name').val();
            if (file_name === '') {
                $.notify("فضلا اكتب اسم الملف");
                $("#file_name").focus();
                e.preventDefault();
            }
            else {
                e.preventDefault();
                var fd = new FormData(this);
                $.ajax({
                    url: 'saveFile',
                    data: fd,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token()}}'
                    },
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                        $.notify(data.text, data.cls);
                        $('#save_company')[0].reset();
                        $("#file_name").focus();
                    },
                    error: function (xhr) {
                        alert("Error: - " + xhr.status + " " + xhr.statusText);
                    }
                });
            }

        }));
    })

    function search_patient(id) {
        $("#editcompany").modal("show");

        $.ajax({
            url: 'company_edit',
            data: {
                _token: '{!! csrf_token() !!}',
                id: id
            },
            type: 'POST',
            cache: false,
            success: function (frm) {
                $("#box_edit").html(frm);

            },
            error: function (xhr) {
                alert('error');
            }
        });


    };

    function tahweel_patient(id) {
        var doc_id = $("#doctors").val();
        var dep_id = $("#dep_id").val();
        if (dep_id === '') {
            $.notify("فضلا اختر العيادة");
            $("#dep_id").focus();
        }
        else if (doc_id === '') {
            $.notify("فضلا اختر دكتور");
            $("#doctors").focus();
        }

        else {

            $.ajax({
                url: 'save_tahveel_patient',
                data: {
                    _token: '{!! csrf_token() !!}',
                    id: id, doc_id: doc_id, dep_id: dep_id
                },
                type: 'POST',
                dataType: 'json',
                cache: false,
                success: function (data) {
                    $.notify(data.text, data.cls);
                    $('#update_company')[0].reset();
                },
                error: function (xhr) {
                    alert(xhr.status + ' ' + xhr.statusText);
                }
            });
        }
    };
    function get_doctors() {
        var id = $("#dep_id").val();
        $.ajax({
            url: 'get_doctors',
            data: {
                _token: '{!! csrf_token() !!}',
                id: id
            },
            type: 'POST',
            cache: false,
            success: function (frm) {
                $("#doctors").html(frm);
            },
            error: function (xhr) {
                alert(xhr.status + ' ' + xhr.statusText);
            }
        });
    };
</script>
{!! modelBox("box","addcompany","اضافة ملف","status_msg","save_company") !!}
{!! modelBox("box_edit","editcompany","تحويل المريض الي طبيب","status_update","update_company") !!}


@endsection