@extends('doctor.layout.index')
@section('content')
    @push('js')
        <script>
            $(document).ready(function() {
                $('#appoint_date').datepicker({
                    format: 'mm/dd/yyyy',
                    todayHighlight: 'TRUE',
                    autoclose: true,
                })
            })

            function get_doctors(){
                var id = $("#dep_id").val();
                $.ajax({
                    url: 'get_doctors',
                    data:{
                        _token: '{!! csrf_token() !!}',
                        id:id
                    },
                    type: 'POST',
                    cache:false,
                    success: function(frm){
                        $("#doctors").html(frm);
                    },
                    error: function(xhr){
                        alert(xhr.status+' '+xhr.statusText);
                    }
                });
            };
            function get_appoints(){
                var dep_id = $("#dep_id").val();
                var doc_id = $("#doctors").val();
                var appoint_date = $("#appoint_date").val();
                var period = $("#period").val();
                if(appoint_date == ''){
                    $.notify("فضلا اختر  التاريخ",'error');
                    $("#appoint_date").focus();
                }
                else  if(dep_id == ''){
                    $.notify("فضلا اختر  العيادة",'error');
                    $("#dep_id").focus();
                }
                else if(doc_id == ''){
                    $.notify("فضلا اختر  الدكتور",'error');
                    $("#doctors").focus();
                }
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
            function appoint_confirm(time,clinic,doctor,period,appoint_date){
                $("#addpatient").modal("show");
                $("#box_add").html('<center><img src="images/waiting.gif"></center>');
                $.ajax({
                    url: 'patient_select',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        time:time,clinic:clinic,doctor:doctor,period:period,appoint_date:appoint_date
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
            function change_status(time,clinic,doctor,period,appoint_date){
                $("#changestatus").modal("show");
                $("#box_change").html('<center><img src="images/waiting.gif"></center>');
                $.ajax({
                    url: 'change_status',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        time:time,clinic:clinic,doctor:doctor,period:period,appoint_date:appoint_date
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
            function confirm_booking(time,clinic,doctor,period,appoint_date){
               var pat_id = $("#pat_id").val();
                var status = document.getElementById("status_id").value;
                console.log(status);
                if(pat_id == ''){
                    $.notify("فضلا اختر  المريض",'error');
                    $("#pat_id").focus();
                }else {
                    $.ajax({
                        url: 'confirm_booking',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            pat_id: pat_id,
                            time: time,
                            clinic: clinic,
                            doctor: doctor,
                            period: period,
                            appoint_date: appoint_date,
                            attend_status:status,
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
            function confirm_change(time,clinic,doctor,period,appoint_date){
                var status_id = $("#status_id").val();
                if(status_id == ''){
                    $.notify("فضلا اختر  الحالة",'error');
                    $("#status_id").focus();
                }else {
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
            function appoint_cancel(status,time,clinic,doctor,period,appoint_date){
                if (confirm('هل انت متاكد من الغاء الحجز ؟')) {
                    $.ajax({
                        url: 'cancel_booking',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            status:status,time: time, clinic: clinic, doctor: doctor, period: period, appoint_date: appoint_date
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
            function confirm_call(time,clinic,doctor,period,appoint_date){
                if (confirm('هل انت متاكد من اتصال  ؟')) {
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


    <div class="datespage">
        <div class="title">{{__('app.appointments')}}</div>
        <div class="content">
            <div class="toparea">
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 16px;">

                <div class="col-md-2">{{__('app.date')}}
    <input type="text" class="form-control" id="appoint_date">
</div>
<input type="hidden" id="dep_id" value="<?=$clinic_id?>">
<input type="hidden" id="doctors" value="<?=$doctor_id?>">

                        <div class="col-md-2">
                            {{__('app.period')}}
                            <select class="form-control" id="period">
                                <option value="all_period">{{__('app.all_periods')}}</option>
                                <option value="morning">{{__('app.morning_period')}}</option>
                                <option value="evening">{{__('app.evening_period')}}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-primary" onclick="get_appoints();">{{__('app.show_appointments')}}</button>
                        </div>
</div>
                    <div id="row">

                        <div id="appoints">

                        </div>

                    </div>
</div>

        </div><!-- end content -->
          </div><!-- end block4 -->
        </div><!-- end col-lg-10 -->




@endsection
{!! modelBox("box_add","addpatient","حجز موعد / اختيار مريض","status_add","add_patient") !!}
{!! modelBox("box_change","changestatus","تغير حالة الحجز","status_add","add_change") !!}
