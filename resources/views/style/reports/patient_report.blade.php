@extends('style.index')
@section('content')
    @push('js')
        <script>
            $(document).ready(function() {

                $('#from_date').datepicker({
                    format: 'mm/dd/yyyy',
                    todayHighlight: 'TRUE',
                    autoclose: true,
                })
                $('#to_date').datepicker({
                    format: 'mm/dd/yyyy',
                    todayHighlight: 'TRUE',
                    autoclose: true,
                })
            })
            function get_patient(){
                var id = $("#pat_id").val();
                $.ajax({
                    url: 'get_patient_detail_invoice',
                    data:{
                        _token: '{!! csrf_token() !!}',
                        id:id
                    },
                    type: 'POST',
                    cache:false,
                    success: function(frm){
                        if(frm == 'no'){
                            $("#pat_id").focus;
                            $.notify("رقم ملف المريض غير مسجل",'warn');
                            $("#pat_name").val('');
                            $("#pat_mobile").val('');
                        }else {
                            $("#pat_detail").html(frm);
                            $("#cat_id").focus;
                        }
                    },
                    error: function(xhr){
                        alert(xhr.status+' '+xhr.statusText);
                    }
                });

            };
            function get_patient_report(){
                var from_date = $("#from_date").val();
                var to_date = $("#to_date").val();
                var pay_at = $("#pay_at").val();
                var period = $("#period").val();
                var dep_id = $("#dep_id").val();
                var doctors = $("#doctors").val();
                var pat_id = $("#pat_id").val();
                var pat_name = $("#pat_name").val();
                if(from_date == ''){
                    $.notify("فضلا اختر  التاريخ",'error');
                    $("#from_date").focus();
                }
                else  if(to_date == ''){
                    $.notify("فضلا اختر  تاريخ",'error');
                    $("#to_date").focus();
                }
                else  if(pat_id == ''){
                    $.notify("فضلا اكتب ملف المريض",'error');
                    $("#pat_id").focus();
                }
                else  if(pat_name == ''){
                    $.notify("فضلا اكتب ملف مريض المسجل رقمك المطلوب غير مسجل",'error');
                    $("#pat_id").focus();
                }

                else {
                    $("#appoints").html('<center><img src="images/waiting.gif"></center>');
                    $.ajax({
                        url: 'get_report_patient',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            from_date: from_date, to_date: to_date, pay_at: pay_at, period: period,dep_id:dep_id,
                            doctors:doctors,pat_id:pat_id
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

            function get_doctors(){
                var id = $("#dep_id").val();
                $.ajax({
                    url: 'get_doctors_report',
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
            </script>
            <style media="screen">
              #popoverr {
                display: none;
              }
              .datespage .toparea .col-md-1 button {
                background-color: #34c5d1 !important;
    color: #fff !important;
    border: 0 !important;
    margin-top: 10px !important;
    width: fit-content !important;
    margin-right: auto !important;
    height: fit-content !important;
    margin-left: 0 !important;
    padding: 1rem !important;
    margin-bottom: 5px !important;
    border-radius: 4px !important;              }
    select,input {
                height: 40px !important;
            }
            </style>
    <div class="datespage">
        <div class="title">{{__('admin.patient_invoices_statement')}}</div>
        <div class="content">
            <div class="toparea">
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="col-md-2"> {{__('admin.from')}}
    <input type="text" class="form-control" id="from_date">
</div>
                        <div class="col-md-2">{{__('admin.to')}}
                            <input type="text" class="form-control" id="to_date">
                        </div>
                        <div class="col-md-2">
                            {{__('admin.pay_at')}}
                            <select class="form-control" id="pay_at">
                                <option value="3">{{__('admin.undefined')}}</option>
                                <option value="cash">{{__('admin.cash')}}</option>
                                <option value="card">{{__('admin.visa')}}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            {{__('admin.period')}}
                            <select class="form-control" id="period">
                                <option value="3">{{__('admin.undefined')}}</option>
                                <option value="morning">{{__('admin.morning')}}</option>
                                <option value="evening">{{__('admin.evening')}}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            {{__('admin.clinic')}}
                            <select name="dep_id" id="dep_id" class="form-control" onchange="get_doctors()">
                                <option value="-5">{{__('admin.undefined')}}</option>
                                @foreach($departments AS $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->dep_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            {{__('app.doctor')}}
                            <select class="form-control" id="doctors">
                                <option value="-5">   {{__('admin.undefined')}}</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-md-4">
                             {{__('admin.patient_file_number')}}
                            <input type="text" class="form-control" id="pat_id" name="pat_id" onchange="get_patient()">
                        </div>
                        <div id="pat_detail">
                            <div class="col-md-4">
                                {{__('admin.patient_name')}}
                                <input type="text" class="form-control" id="pat_name" name="pat_name" disabled>
                            </div>
                            <div class="col-md-4">
                                {{__('admin.mobile')}}
                                <input type="text" class="form-control" id="pat_mobile" name="pat_mobile" disabled>
                            </div>

                        </div>
                        <div class="col-xs-12 d-flex justify-content-center">
                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-primary" onclick="get_patient_report();">{{__('admin.show')}} </button>
                        </div>
                        </div>
</div>
                    <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <div id="appoints">

                        </div>

                    </div>
</div>

        </div><!-- end content -->
          </div><!-- end block4 -->
        </div><!-- end col-lg-10 -->



        {!! modelBox("box_add","addpatient","حجز موعد / اختيار مريض","status_add","add_patient") !!}
        {!! modelBox("box_change","changestatus","تغير حالة الحجز","status_add","add_change") !!}

@endsection

