@extends('style.index')
@section('content')
    @push('js')
        <script>

            function get_khazina(){

                var pay_at = $("#pay_at").val();
                var period = $("#period").val();
                var date_inv = $("#date_inv").val();
                    $("#appoints").html('<center><img src="images/waiting.gif"></center>');
                    $.ajax({
                        url: 'get_report_khazina',
                        data: {
                            _token: '{!! csrf_token() !!}',
                           pay_at: pay_at, period: period,date_inv:date_inv,
                            from_date:$("#date_from").val(),to_date:$("#date_to").val()
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

            };


            </script>

            <style media="screen">
              #popoverr {
                display: none;
              }
              .datespage .toparea .col-md-1 button {
                background-color: #34c5d1; color: #fff; border: 0;margin-top: 10px
              }
            </style>
    <div class="datespage">
        <div class="title">{{__('admin.account_statement_khazina')}}</div>
        <div class="content">
            <div class="toparea">
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-md-2">
                            {{__('admin.from')}}
                            <input type="date"  name="date_from" id="date_from" class="form-control">
                        </div>
                        <div class="col-md-2">{{__('admin.to')}}
                            <input type="date"  name="date_to" id="date_to" class="form-control">
                        </div>
                        <div class="col-md-2">
                            {{__('admin.select_day')}}
                            <select class="form-control" id="date_inv">
                                <option value="3">{{__('admin.undefined')}}</option>
                                <option value="1">{{__('admin.in_day')}}</option>
                                <option value="2"> {{__('admin.yesterday')}}</option>
                            </select>
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
                            <br>
                            <button class="btn btn-primary" onclick="get_khazina();">{{__('admin.show')}} </button>
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

{!! modelBox("addpatient","حجز موعد / اختيار مريض","box_add","status_add","add_patient") !!}
{!! modelBox("changestatus","تغير حالة الحجز","box_change","status_add","add_change") !!}
