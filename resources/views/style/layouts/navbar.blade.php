@if(auth()->user())
    <?php if (Auth::user()->level == "dr") {
        header("Location: no_access");
        die();
    }  ?>
@endif

{{$url1 = ''}}

@if(auth()->user())
    <!-- style="background: linear-gradient(180deg, #1e195f 0%, #130f40 100%);" -->
    <style>
        .nav li:hover {
            background: #36c6d3;
        }

        .nav li.active a {
            background: #36c6d3 !important;
        }

        .navbar-nav > li > a {
            padding-top: 15px;
            padding-bottom: 15px;
            font-size: 12px;
        }

        #homepagearea nav ul li a {
            display: block;
            margin: 0 auto;
            padding: 4px 16px 4px 16px;
        }

        .bg-transparent {
            background-color: transparent !important
        }

        .border-0 {
            border-radius: 0
        }

        .border-0:focus {
            border: 0 !important;
        }
    </style>
    <nav class="navbar navbar-inverse not-print" dir="rtl">
        <div class="container" style="">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <style>.white {
                    color: white !important;
                }</style>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    @if(auth()->user())
                        @foreach(\App\Models\Page::all() as $page)
                            <li class="">
                                <a href="{{ url('page/'.$page->id) }}" class="white">{{$page->page_title}}</a>
                            </li>
                        @endforeach
                        @user_can("categories-read")
                        <li class="{{ Request::segment(1) === 'tasnefat' ? 'active' : ' ' }}">
                            <a href="{{ url('tasnefat') }}" class="white">{{__('app.categories')}}</a>
                        </li>
                        @end_user_can
                        @user_can("discounts-read")
                        <li class="{{ Request::segment(1) === 'discounts' ? 'active' : ' ' }}">
                            <a href="{{ url('discounts') }}" class="white">{{__('app.discounts')}}</a>
                        </li>
                        @end_user_can
                        <li class="{{ Request::segment(1) === 'forms' ? 'active' : ' ' }}">
                            <a href="{{ url('forms') }}" class="white">{{__('app.medical_forms')}}</a>
                        </li>
                        @user_can("products-read")
                        <li class="{{ Request::segment(1) === 'product' ? 'active' : ' ' }}">
                            <a href="{{ url('product') }}" class="white">{{__('app.products')}}</a>
                        </li>
                        @end_user_can
                        @user_can("invoices-create")
                        <li class="{{ Request::segment(1) === 'create_invoice' ? 'active' : ' ' }}">
                            <a href="{{ url('create_invoice') }}" class="white">{{__('app.new_invoice')}}</a>
                        </li>
                        @end_user_can
                        @user_can("expenses-read")
                        <li>
                            <div class="dropdown" style="padding-top: 15px; padding-bottom: 15px; font-size: 12px;">
                                <button class="border-0 btn dropdown-toggle bg-transparent" type="button"
                                        id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true"
                                        style="color:#fff;padding:0;    font-size: 12px;">
                                    {{__('app.expenses')}}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2"
                                    style="">
                                    <li><a href="{{url('expense_main')}}"
                                           style="font: 13px 'Droid Arabic Kufi','play',Arial,Helvetica,sans-serif !important;color: #000; font-weight: bold;">{{__('app.expenses_categories')}}</a></li>
                                    <li><a href="{{url("expense")}}"
                                           style="font: 13px 'Droid Arabic Kufi','play',Arial,Helvetica,sans-serif !important;color: #000; font-weight: bold;">{{__('app.all').' '.__('app.expenses')}}</a></li>
                                </ul>
                            </div>
                        </li>
                        @end_user_can
                        <li style="margin-right:10px">
                            <div class="dropdown" style="padding-top: 15px; padding-bottom: 15px; font-size: 12px;">
                                <button class="border-0 btn dropdown-toggle bg-transparent" type="button"
                                        id="dropdownMenu2" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="true"
                                        style="color:#fff;padding:0;    font-size: 12px;">
                                    {{__('app.reports')}}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    @user_can("specials-treasury_reports")
                                    <li class="">
                                        <a
                                            style="font: 13px 'Droid Arabic Kufi','play',Arial,Helvetica,sans-serif !important;color: #000; font-weight: bold;"
                                            href="{{ url('khazina') }}">{{__('app.treasury_report')}}</a>
                                    </li>
                                    @end_user_can
                                    @user_can("specials-patients_reports")
                                    <li class="{{ Request::segment(1) === 'patient_report' ? 'active' : ' ' }}">
                                        <a
                                            style="font: 13px 'Droid Arabic Kufi','play',Arial,Helvetica,sans-serif !important;color: #000; font-weight: bold;"
                                            href="{{ url('patient_report') }}">{{__('app.patients_report')}} </a>
                                    </li>
                                    @end_user_can
                                    @user_can("specials-clinic_doctor_reports")
                                    <li class="{{ Request::segment(1) === 'clinic_doctor_report' ? 'active' : ' ' }}">
                                        <a
                                            style="font: 13px 'Droid Arabic Kufi','play',Arial,Helvetica,sans-serif !important;color: #000; font-weight: bold;"
                                            href="{{ url('clinic_doctor_report') }}">{{__('app.clinic_doctor_report')}}</a>
                                    </li>
                                    @end_user_can
                                    @user_can("specials-general_reports")
                                    <li class="">
                                        <a
                                            style="font: 13px 'Droid Arabic Kufi','play',Arial,Helvetica,sans-serif !important;color: #000; font-weight: bold;"
                                            href="{{url('report')}}">{{__('app.general_report')}} </a>
                                    </li>
                                    @end_user_can
                                </ul>
                            </div>
                        </li>
                        @user_can("specials-transferred_patients")
                        <li class="{{ Request::segment(1) === 'transfered_patients' ? 'active' : ' ' }}">
                            <a href="{{ url('transfered_patients') }}" class="white">{{__('app.transferred_patients')}}</a>
                        </li>
                        @end_user_can
                        <li>
                            <a href="{{url('lang?loc='.(app()->getLocale() == "ar"?"en":"ar"))}}" title="{{app()->getLocale() == "ar"?"English":"العربية"}}" style="color:#1c7d7e">
                                <i class="" style="font-size:30px;color: white"></i>
                            </a>
                        </li>
                    @endif

                </ul>
                <ul class="nav navbar-nav navbar-nav-2" style="float: left; margin-left: 6%;">
                    <li class="text-white" style="color:#fff">
                        <a style="color:#fff;font-size:16px;background: #36c6d3;" href="#">
                            <i class="fas fa-user-circle"></i>
                            <span>{{ Auth::user()->name }}</span></a>
                    </li>
                    <!-- -->
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
@endif

<div class="container not-print">
    <div class="logo2 hidden">
        @if(auth()->user())
            <a href="{{ url('tasnefat') }}" class="btn btn-primary">التصنيفات</a>
            <a href="{{ url('product') }}" class="btn btn-primary">اسعار الخدمات</a>
            <a href="{{ url('create_invoice') }}" class="btn btn-primary">اصدار فاتورة</a>
            <a href="{{ url('tasdeed') }}" class="btn btn-primary"> تسديد زيارة <span class="badge badge-light"
                                                                                      id="tasdeed_cou1nt"></span></a>
            <div class="dropdown">
                <button class="border-0 dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">
                    المصروفات
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="#">اقسام المصروفات</a></li>
                    <li><a href="#"> كل المصروفات</a></li>
                </ul>
            </div>
            <a href="{{ url('expense_main') }}" class="btn btn-primary">اقسام المصروفات</a>
            <a href="{{ url('expense_sub') }}" class="btn btn-primary">المصروفات دروب داون</a>
            <a href="{{ url('expense') }}" class="btn btn-primary">المصاريف</a>
            <a href="{{ url('appoints') }}" class="btn btn-primary">المواعيد</a>
            <a href="{{ url('khazina') }}" class="btn btn-primary">حساب الخزينة</a>
            <a href="{{ url('patient_report') }}" class="btn btn-primary">حساب المريض</a>
            <a href="{{ url('clinic_doctor_report') }}" class="btn btn-primary">حساب العيادة والدكتور</a>

            <span style="display:none;">{{ $url1 = url('tasdeed_count') }}</span>
        @endif
    </div><!-- end logo2 -->

    <div id="homepagearea">
        <nav style="overflow: auto;">
            @if(auth()->user())

                <ul style="
              text-align: center;
              display: flex;
              justify-content: center;
              min-width: 798px;
           ">

                    <li class="{{ Request::segment(1) == '' || Request::segment(1) == 'dashboard'?'active':'' }}"><a
                            href="{{ url('/') }}" title="#"><span></span>
                            <p>{{__('app.home')}}</p></a></li>
                    @user_can("patients-create")
                    <li class="{{ Request::segment(1) == 'add' || Request::segment(2) == 'patient'?'active':'' }}"><a
                            href="{{ url('add/patient') }}" title="#"><span></span>
                            <p>{{ __('admin.add_record') }}</p></a></li>
                    @end_user_can
                    @user_can("patients-read")
                    <li class="{{ Request::segment(1) == 'home' || Request::segment(1) == 'search'?'active':'' }}"><a
                            href="{{ url('/home') }}" title="{{ trans('admin.search') }}"><span></span>
                            <p>{{ __('app.patients_list') }} </p></a></li>
                    @end_user_can
                    @user_can("appointments-read")
                    <li class="{{ Request::segment(1) == 'appoints'?'active':'' }}"><a href="{{ url('appoints') }}"
                                                                                       title="{{ trans('admin.appointments') }}"><span></span>
                            <p>{{ trans('app.appointments') }}</p></a></li>
                    @end_user_can
                    @user_can("invoices-read")
                    <li class="{{ Request::segment(1) == 'invoices'?'active':'' }}">
                        <a href="{{ url('invoices') }}" title="{{ trans('admin.invoices') }}"><span></span>
                            <p>{{ trans('app.invoices') }}</p>
                        </a></li>
                    @end_user_can
                    @user_can("diagnosis-read")
                    <li class="{{ Request::segment(1) == 'diagnosis'?'active':'' }}">
                        <a href="{{ url('diagnosis') }}" title="{{ trans('admin.diagnosis') }}">
                            <span></span>
                            <p> {{ __('app.diagnosis') }}</p></a></li>
                    @end_user_can
                    @user_can("specials-pay_invoice")
                    <li class="{{ Request::segment(1) == 'tasdeed'?'active':'' }}">
                        <a href="{{ url('tasdeed') }}" title="#"><span style="position: relative;"> <div
                                    id="tasdeed_count"
                                    style="position: absolute; bottom: 5px; right: 12px; color: red; font-size: 20px; font-weight: bold; padding-left: 20px; padding-right: 40px;"
                                >0</div></span>
                            <p>{{__('app.pay_invoice')}} </p>

                        </a>

                    </li>
                    @end_user_can

                    @user_can("specials-salaries")
                    <li class="{{ request()->is("salaries") ? 'active':'' }}"><a
                            href="{{ url('salaries') }}" title="#"><span></span>
                            <p>{{ __('admin.salaries') }}</p></a></li>
                    @end_user_can
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span></span>
                            <p>{{ trans('admin.logout') }}</p></a></li>
                </ul>
            @endif
            <div class="clearfix"></div>
        </nav>

    </div>
</div>
@if(auth()->user())
    <script>
        $(document).ready(function () {
            check_tasdeed();
        })

        function check_tasdeed() {
            $.ajax({
                url: '<?php echo($url1);?>',
                data: {
                    _token: '{!! csrf_token() !!}',
                },
                type: 'POST',
                cache: false,
                success: function (frm) {
                    $("#tasdeed_count").html(frm);
                    // alert(frm);
                },
                error: function (xhr) {
                    // alert(xhr.status+' '+xhr.statusText);
                }
            });
        };


        window.setInterval(function () {
            check_tasdeed();
        }, 20000);
    </script>

@endif
