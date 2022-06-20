@extends('style.index')
@section('content')
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-lg-offset-3">
    <div class="loginpage">
      <div class="title">{{ trans('admin.forgot_password') }}</div>
      <div class="content">
        <form method="POST" action="{{ route('password.email') }}">

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope-o"></i></span>
              <input type="email" placeholder="{{ trans('admin.email') }}" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" aria-describedby="basic-addon1" name="email" value="{{ old('email') }}"   id="email">
              @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
              @endif
            </div>
          </div>
          <div class="pull-right"><button type="submit">{{ trans('admin.reset') }}</button></div>
          <div class="clearfix"></div>
          @csrf
        </form>
</div>
</div><!-- end loginpage -->
</div>  <!-- end col-lg-4 -->
</div><!-- end row -->
@endsection
