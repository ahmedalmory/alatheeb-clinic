<header>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>


    </style>
    <div class="container">
        @if(auth()->user())
            <span style="color:white; font-size:19px;"> {{ Auth::user()->name }}</span>
            <li>
                <a href="{{url('lang?loc='.(app()->getLocale() == "ar"?"en":"ar"))}}"
                   title="{{app()->getLocale() == "ar"?"English":"العربية"}}" style="color:#1c7d7e">
                    <i class="fas fa-language" style="font-size:30px;color: white"></i>
                </a>
            </li>
        @endif
        <div class="clearfix"></div>
    </div><!-- end container -->
</header><!-- End Header -->
<div class="container">
    <div class="logo2">

    </div><!-- end logo2 -->
    <div id="homepagearea">
        <nav style="overflow:auto">
            <ul style="  text-align: center;
          display: flex;
          justify-content: center;
          min-width: 798px;">

                <li class="{{ Request::segment(1) == ''?'active':'' }}"><a href="{{ url('/') }}" title="#"><span></span>
                        <p>{{trans('admin.home')}}</p></a></li>
                <li class="{{ Request::segment(1) == 'doctor_layout'?'active':'' }}"><a
                        href="{{ url('doctor_layout') }}" title="#"><span></span>
                        <p>{{ trans('admin.doctor_layout') }}</p></a></li>
                <li class="{{ Request::segment(1) == 'appoints_doctor'?'active':'' }}"><a
                        href="{{ url('appoints_doctor') }}" title="#"><span></span>
                        <p>{{ trans('admin.appointments') }}</p></a></li>
                <li class="{{ Request::segment(1) == 'doctor_report'?'active':'' }}"><a
                        href="{{ url('doctor_report') }}" title="#"><span></span>
                        <p>{{ trans('admin.doctor_report') }}</p></a></li>


                <li class=""><a href="{{ route('doctor.last,appointments') }}" title="#"><span></span>
                        <p>{{ trans('admin.Previous dates') }}</p></a></li>

                <li><a href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span></span>
                        <p>{{ trans('admin.logout') }}</p></a></li>

            </ul>
            <div class="clearfix"></div>

        </nav>
