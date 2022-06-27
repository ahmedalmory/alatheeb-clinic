@extends('style.index')

@section('content')
<style media="screen">
  .d-block  {
    display: block
  }
  .fa, .fas {
    font-weight: 900;
}
.fa, .far, .fas {
    font-family: "Font Awesome 5 Free";
}

.fa-3x {
    font-size: 3em;
}
.fa, .fab, .fad, .fal, .far, .fas {
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
}
  .index-dd {
    background-color: #83c2f761;
    display: flex;
    align-items: center;
    flex-direction: column;
    color: #253848;
    font-size: 14px;
    margin-bottom: 10px;
    border-radius: 10px;
    padding: 15px 10px;
    height: 114px;
  }
  .mb-3 {

  }
  .bg-success-lt {
    background-color: #14dd7f;
}
.m-2 {
    margin: 0.5rem!important;
}
.badge {
  display: inline-block;
      padding: 0.35em 0.65em;
      font-size: 16px !important;
      font-weight: 700;
      height: auto;
      line-height: 1;
      color: #fff;
      text-align: center;
      white-space: nowrap;
      vertical-align: baseline;
      border-radius: 0.25rem !important;

}
.mb-3 {
    margin-bottom: 1rem!important;
}
.d-block {
    display: block!important;
}
</style>
<style>.homepagetable2 {background-color: white; padding: 30px;}</style>
<div class="row w-100 mx-0 mt-5 " style="display: flex;flex-wrap: wrap; justify-content: center; background-color: #fff; padding: 21px 0px 0; border-radius: 10px;">
  <div class=" col-xs-6 col-md-4 col-lg-2 mb-3">
    <div class="index-dd" >
      <i class="fas fa-user-injured fa-2x d-block mb-3" style="line-height: 1;"></i>
      <span class="translate">{{__('app.patients_count')}}
      </span>
      <span class="badge bg-success-lt mx-2 mt-0">{{$total_patient}}</span>
    </div>
  </div>
  <div class="col-xs-6 col-md-4 col-lg-2 mb-3">
    <div class="index-dd" >
      <i class="fas fa-user-check fa-2x d-block mb-3" style="line-height: 1;"></i>
      <span class="translate">{{__('app.registered_today')}}
      </span>
      <span class="badge bg-success-lt mx-2 mt-0">{{\App\Models\Patient::query()->whereDate('created_at',\Carbon\Carbon::today()->toDateTimeString())->count()}}</span>
    </div>
  </div>
  <div class="col-xs-6 col-md-4 col-lg-2 mb-3">
    <div class="index-dd" >
      <i class="fas fa-user-md fa-2x d-block mb-3" style="line-height: 1;"></i>
      <span class="translate">{{__('app.doctors_count')}}
      </span>
      <span class="badge bg-success-lt mx-2 mt-0">{{$total_doctor}}</span>
    </div>
  </div>
  <div class="col-xs-6 col-md-4 col-lg-2 mb-3">
    <div class="index-dd" >
      <i class="fas fa-hospital-alt fa-2x d-block mb-3" style="line-height: 1;"></i>
      <span class="translate">{{__('app.departments_count')}}
      </span>
      <span class="badge bg-success-lt mx-2 mt-0">{{$total_departments}}</span>
    </div>
  </div>


</div


@endsection
