@extends('doctor.layout.index')
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
            function get_doctor_report(){
                var from_date = $("#from_date").val();
                var to_date = $("#to_date").val();
                var pay_at = $("#pay_at").val();
                var period = $("#period").val();
                if(from_date == ''){
                    $.notify("فضلا اختر  التاريخ",'error');
                    $("#from_date").focus();
                }
                else  if(to_date == ''){
                    $.notify("فضلا اختر  تاريخ",'error');
                    $("#to_date").focus();
                }


                else {
                    $("#appoints").html('<center><img src="images/waiting.gif"></center>');
                    $.ajax({
                        url: 'get_report_doctor',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            from_date: from_date, to_date: to_date, pay_at: pay_at, period: period
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
            </style>

    <div class="datespage">
        <div class="title">كشف حساب فواتير العيادات والدكتور</div>
        <div class="content">
            <div class="toparea">
                <div class="row">

                    <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12"
                          style="margin-bottom: 10px;">

                <div class="col-md-2">{{__("app.from")}}<input type="text" class="form-control" id="from_date">
</div>
                        <div class="col-md-2">ا{{__("app.to")}}
                            <input type="text" class="form-control" id="to_date">
                        </div>
                        <div class="col-md-2">
                             {{__("app.payment_method")}}
                            <select class="form-control" id="pay_at">
                                <option value="3">غير محدد</option>
                                <option value="cash">{{__("app.cash")}}</option>
                                <option value="card">{{__("app.network")}}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            {{__("app.period")}}
                            <select class="form-control" id="period">
                                <option value="3">غير محدد</option>
                                <option value="morning">{{__("app.morning_period")}}</option>
                                <option value="evening">{{__("app.evening_period")}}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-primary" onclick="get_doctor_report();">{{__("app.show")}} </button>
                        </div>
                        <div class="clearfix"></div>




</div>
                    <div id="row" >

                        <div id="appoints" style="min-width:1000px">

                        </div>

                    </div>
</div>

        </div><!-- end content -->
          </div><!-- end block4 -->
        </div><!-- end col-lg-10 -->


        {!! modelBox("box_add","addpatient","حجز موعد / اختيار مريض","status_add","add_patient") !!}
        {!! modelBox("box_change","changestatus","تغير حالة الحجز","status_add","add_change") !!}

@endsection


