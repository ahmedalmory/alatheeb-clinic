@extends('style.index')
@section('content')
    @push('js')
        <script>
            function get_clinic_doctor_report() {

                var pay_at = $("#pay_at").val();
                var period = $("#period").val();
                var dep_id = $("#dep_id").val();
                var doctors = $("#doctors").val();
                var date_inv = $("#date_inv").val();

                $("#appoints").html('<center><img src="images/waiting.gif"></center>');
                $.ajax({
                    url: 'get_report_clinic_doctor',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        pay_at: pay_at,
                        period: period,
                        dep_id: dep_id,
                        doctors: doctors,
                        date_inv: date_inv,
                        date_from: $("#date_from").val(),
                        date_to: $("#date_to").val(),
                    },
                    type: 'POST',
                    cache: false,
                    success: function(frm) {
                        $("#appoints").html(frm);
                    },
                    error: function(xhr) {
                        alert(xhr.status + ' ' + xhr.statusText);
                    }
                });

            };

            function get_doctors() {
                var id = $("#dep_id").val();
                $.ajax({
                    url: 'get_doctors_report',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        id: id
                    },
                    type: 'POST',
                    cache: false,
                    success: function(frm) {
                        $("#doctors").html(frm);
                    },
                    error: function(xhr) {
                        alert(xhr.status + ' ' + xhr.statusText);
                    }
                });
            };
        </script>
        <style media="screen">
            #popoverr {
                display: none !important;
            }

            #popoverr {
                display: none;
            }

            .datespage .toparea .col-md-1 button {
                background-color: #34c5d1;
    color: #fff;
    border: 0;
    margin-top: 10px;
    width: fit-content;
    margin-right: auto;
    height: fit-content;
    margin-left: 0 !important;
    padding: 1rem;
    margin-bottom: 5px;
    border-radius: 4px;
            }
            select,input {
                height: 40px !important;
            }
        </style>
        <div class="datespage">
            <div class="title">{{__('admin.clinics_and_doctor_invoices_statement')}}</div>
            <div class="content">
                <div class="toparea">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="col-md-2">
                                {{ __('admin.from') }}
                                <input class="form-control" id="date_from" name="date_from" type="date">
                            </div>
                            <div class="col-md-2">
                                {{ __('admin.to') }}
                                <input class="form-control" id="date_to" name="date_to" type="date">
                            </div>
                            <div class="col-md-2">
                                {{ __('admin.pay_at') }}
                                <select class="form-control" id="pay_at">
                                    <option value="3">{{ __('admin.undefined') }}</option>
                                    <option value="cash">{{ __('admin.cash') }}</option>
                                    <option value="card">{{ __('admin.visa') }}</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                {{ __('admin.period') }}
                                <select class="form-control" id="period">
                                    <option value="3">{{ __('admin.undefined') }}</option>
                                    <option value="morning">{{ __('admin.morning') }}</option>
                                    <option value="evening">{{ __('admin.evening') }}</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                {{ __('admin.clinic') }}
                                <select name="dep_id" id="dep_id" class="form-control">
                                    <option value="-5">{{ __('admin.undefined') }}</option>
                                    @foreach ($departments as $dep)
                                        <option value="{{ $dep->id }}">{{ $dep->dep_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                {{ __('app.doctor') }}
                                <select class="form-control" id="doctors">
                                    <option value="-5">   {{ __('admin.undefined') }}</option>
                                    @foreach ($doctors as $doc)
                                        <option value="{{ $doc->id }}">{{ $doc->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-xs-12 d-flex justify-content-center">
                            <div class="col-md-2">
                                <br>
                                <button class="btn btn-primary" onclick="get_clinic_doctor_report();">{{ __('admin.show') }}</button>
                            </div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                        <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <div id="appoints">

                            </div>

                        </div>
                    </div>

                </div><!-- end content -->
            </div><!-- end block4 -->
        </div><!-- end col-lg-10 -->
        {!! modelBox('box_add','addpatient', 'حجز موعد / اختيار مريض',  'status_add', 'add_patient') !!}
        {!! modelBox('box_change','changestatus', 'تغير حالة الحجز',  'status_add', 'add_change') !!}
    @endsection


