@extends('style.index')
@section('content')
@push('js')
<script>
    $(document).ready(function () {
        $('#appoint_date').datepicker({
            format: 'mm/dd/yyyy',
            todayHighlight: 'TRUE',
            autoclose: true,
        })
    })

    function get_doctors(div_id = "#dep_id") {
        var id = $(div_id).val();
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
                $("#doc_id").html(frm);
            },
            error: function (xhr) {
                alert(xhr.status + ' ' + xhr.statusText);
            }
        });
    };
    function get_appoints() {
        var dep_id = $("#dep_id").val();
        var doc_id = $("#doctors").val();
        var appoint_date = $("#appoint_date").val();
        var period = $("#period").val();

        if (dep_id == '') {
            $.notify("{{__('app.please_choose_department')}}", 'error');
            $("#dep_id").focus();
        }
        else if (doc_id == '') {
            $.notify("{{__('app.please_choose_doctor')}}", 'error');
            $("#doctors").focus();
        }
        // else if (period == '') {
        //     $.notify("فضلا اختر  الفترة", 'error');
        //     $("#period").focus();
        // }
        else {
            $("#appoints").html('<center><img src="images/waiting.gif"></center>');
            $.ajax({
                url: 'get_appoints_new',
                data: {
                    _token: '{!! csrf_token() !!}',
                    dep_id: dep_id, doc_id: doc_id, appoint_date: appoint_date, period: period
                },
                type: 'POST',
                cache: false,
                success: function (frm) {
                    $("#appoints").html(frm);
                },
                error: function (xhr) {
                    alert(xhr.status + ' ' + xhr.statusText);
                }
            });
        }
    };
    function appoint_confirm(time, clinic, doctor, period, appoint_date) {
        $("#addpatient").modal("show");
        $("#box_add").html('<center><img src="images/waiting.gif"></center>');
        $.ajax({
            url: 'patient_select',
            data: {
                _token: '{!! csrf_token() !!}',
                time: time, clinic: clinic, doctor: doctor, period: period, appoint_date: appoint_date
            },
            type: 'POST',
            cache: false,
            success: function (frm) {
                $("#box_add").html(frm);
            },
            error: function (xhr) {
                alert('error');
            }
        });
    };
    function change_status(time, clinic, doctor, period, appoint_date) {
        $("#changestatus").modal("show");
        $("#box_change").html('<center><img src="images/waiting.gif"></center>');
        $.ajax({
            url: 'change_status',
            data: {
                _token: '{!! csrf_token() !!}',
                time: time, clinic: clinic, doctor: doctor, period: period, appoint_date: appoint_date
            },
            type: 'POST',
            cache: false,
            success: function (frm) {
                $("#box_change").html(frm);
            },
            error: function (xhr) {
                alert('error');
            }
        });
    };
    function confirm_booking(time, clinic, doctor, period, appoint_date) {
        var pat_id = $("#pat_id").val();
        var doctor = doctor ?doctor:$("#doc_id").val();
        var clinic = clinic ?clinic:$("#dep_id").val();
        var status = $("#appoint_status_id").val();
        if (pat_id == '') {
            $.notify("{{__('app.please_choose_patient')}}", 'error');
            $("#pat_id").focus();
        } else {
            $.ajax({
                url: 'confirm_booking',
                data: {
                    _token: '{!! csrf_token() !!}',
                    pat_id: pat_id,
                    time: time,
                    clinic: clinic,
                    doctor: doctor,
                    period: period,
                    status: status,
                    appoint_date: appoint_date
                },
                type: 'POST',
                cache: false,
                dataType: 'json',
                success: function (data) {
                    $("#addpatient").modal("hide");
                    get_appoints();
                    $.notify(data.text, data.cls);

                },
                error: function (xhr) {
                    alert('error');
                }
            });
        }
    };
    function confirm_change(time, clinic, doctor, period, appoint_date) {
        var status_id = $("#status_id").val();
        if (status_id == '') {
            $.notify("{{__('app.please_choose_status')}}", 'error');
            $("#status_id").focus();
        } else {
            $.ajax({
                url: 'confirm_change',
                data: {
                    _token: '{!! csrf_token() !!}',
                    status_id: status_id,
                    time: time,
                    clinic: clinic,
                    doctor: doctor,
                    period: period,
                    appoint_date: appoint_date
                },
                type: 'POST',
                cache: false,
                dataType: 'json',
                success: function (data) {
                    $("#changestatus").modal("hide");
                    get_appoints();
                    $.notify(data.text, data.cls);

                },
                error: function (xhr) {
                    alert('error');
                }
            });
        }
    };
    function appoint_cancel(status, time, clinic, doctor, period, appoint_date) {
        if (confirm('{{__('app.are_u_sure_u_want_to_cancel_appointment')}}')) {
            $.ajax({
                url: 'cancel_booking',
                data: {
                    _token: '{!! csrf_token() !!}',
                    status: status, time: time, clinic: clinic, doctor: doctor, period: period, appoint_date: appoint_date
                },
                type: 'POST',
                cache: false,
                dataType: 'json',
                success: function (data) {
                    get_appoints();
                    $.notify(data.text, data.cls);
                },
                error: function (xhr) {
                    alert('error');
                }
            });
        }
    };
    function confirm_call(time, clinic, doctor, period, appoint_date) {
        if (confirm('{{__('app.are_u_sure_u_want_to_call')}}')) {
            $.ajax({
                url: 'confirm_call',
                data: {
                    _token: '{!! csrf_token() !!}',
                    time: time, clinic: clinic, doctor: doctor, period: period, appoint_date: appoint_date
                },
                type: 'POST',
                cache: false,
                dataType: 'json',
                success: function (data) {
                    get_appoints();
                    $.notify(data.text, data.cls);
                },
                error: function (xhr) {
                    alert('error');
                }
            });
        }
    };
</script>
@user_can("appointments-create")
<a class="btn btn-success btn-sm" href="{{url()->current().'/create'}}">
    {{__('app.make_appointment')}}
</a>
@end_user_can
<div class="datespage">
    <div class="title">{{__('app.appointments')}}</div>
    <div class="content">
        <div class="toparea">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="col-md-2" style="margin-bottom:10px">{{__('app.date')}}
                        <input type="text" class="form-control" id="appoint_date">
                    </div>
                    <div class="col-md-3" style="margin-bottom:10px">
                        {{__('app.department')}}
                        <select name="dep_id" id="dep_id" class="form-control" onchange="get_doctors()">
                            <option selected>{{__('app.choose_department')}}</option>
                            @foreach($departments AS $dep)
                            <option value="{{ $dep->id }}">{{ $dep->dep_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3" style="margin-bottom:10px">
                        {{__('app.doctor')}}
                        <select class="form-control" id="doctors">

                        </select>
                    </div>
                    <div class="col-md-2" style="margin-bottom:10px">
                        {{__('app.period')}}
                        <select class="form-control" id="period">
                            <option selected>{{__('app.choose_period')}}</option>
                            <option value="all_period" class="text-success">{{__('app.all_periods')}} </option>
                            <option value="morning">{{__('app.morning_period')}}</option>
                            <option value="evening">{{__('app.evening_period')}}</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="margin-bottom:10px">
                        <br>
                        <button class="btn btn-primary" onclick="get_appoints();">{{__('app.show_appointments')}} </button>
                    </div>
                </div>
                <hr />
                <div id="row" >

                    <div id="appoints" class="col-12">

                    </div>

                </div>
            </div>

        </div><!-- end content -->
    </div><!-- end block4 -->
</div><!-- end col-lg-10 -->

{!! modelBox("addpatient",__('app.choose_patient').' / '.__('app.make_appointment'),"box_add","status_add","add_patient") !!}
{!! modelBox("changestatus",__('app.change_appointment_statue'),"box_change","status_add","add_change") !!}


@endsection
