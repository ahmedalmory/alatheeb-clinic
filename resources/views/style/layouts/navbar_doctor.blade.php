@if(auth()->user())
<?php if( Auth::user()->level !="dr"){
    header("Location: no_access");
    die();
}  ?>
@endif
  <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!-- Edit 11-01-2020-->
  <style>


  </style>
    <div class="container">
      <!--<div class="logo">-->
      <!--  <a href="{{ url('/') }}" title="#"><img src="{{ it()->url(setting()->icon) }}" alt=""></a>-->
      <!--</div><!-- end logo -->-->
      @if(auth()->user())
      <!--<a href="{{ url('/') }}" title="#" class="controllink"><i class="fa fa-cog"></i>  لوحة التحكم</a>-->

                        <div class="group-link">
                        <span style="color:white; font-size:19px;" > {{ Auth::user()->name }}</span>
          <li>
                            <a href="{{url('lang?loc='.(app()->getLocale() == "ar"?"en":"ar"))}}" title="{{app()->getLocale() == "ar"?"English":"العربية"}}" style="color:#1c7d7e">
                                <i class="fas fa-language" style="font-size:30px;color: white"></i>
                            </a>
                        </li>
                        </div>
        @endif
      <div class="clearfix"></div>
    </div><!-- end container -->
  </header><!-- End Header -->
  <div class="container">
    <div class="logo2">

    </div><!-- end logo2 -->
    <div id="homepagearea">
      <nav style="overflow:auto">
        @if(auth()->user())
        <ul style="  text-align: center;
          display: flex;
          justify-content: center;
          min-width: 798px;">

            <li  class="{{ Request::segment(1) == ''?'active':'' }}" ><a href="{{ url('/') }}" title="#"><span></span><p>{{trans('admin.home')}}</p></a></li>
            <li  class="{{ Request::segment(1) == 'doctor_layout'?'active':'' }}" ><a href="{{ url('doctor_layout') }}" title="#"><span></span><p>{{ trans('admin.doctor_layout') }}</p></a></li>
            <li  class="{{ Request::segment(1) == 'appoints_doctor'?'active':'' }}" ><a href="{{ url('appoints_doctor') }}" title="#"><span></span><p>{{ trans('admin.appointments') }}</p></a></li>
            <li  class="{{ Request::segment(1) == 'doctor_report'?'active':'' }}" ><a href="{{ url('doctor_report') }}" title="#"><span></span><p>{{ trans('admin.doctor_report') }}</p></a></li>



            <li  class="" ><a href="{{ route('doctor.last,appointments') }}" title="#"><span></span><p>{{ trans('admin.Previous dates') }}</p></a></li>
            <li class=""><a href="{{ route('doctor.invoices') }}" title="#"><span></span>
              <p>{{ trans('admin.invoices') }}</p></a></li>

            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span></span><p>{{ trans('admin.logout') }}</p></a></li>

        </ul>
        @endif
        <div class="clearfix"></div>

      </nav>
