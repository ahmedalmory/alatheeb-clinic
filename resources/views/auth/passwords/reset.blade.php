@extends('style.index')
@section('content')
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-lg-offset-3">
<div class="loginpage">
<div class="title">{{ trans('admin.forgot_password') }}</div>
<div class="content">
<form method="POST" action="{{ route('password.update') }}">
    <div class="form-group">
        <label for="email">{{ trans('admin.email') }}</label>
        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"   id="email">
        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="exampleInputEmail2">{{ trans('admin.password') }}</label>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">{{ $errors->first('password') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="exampleInputEmail2">{{ trans('admin.password_confirmation') }}</label>
        <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>
        @if ($errors->has('password_confirmation'))
        <span class="invalid-feedback" role="alert">{{ $errors->first('password_confirmation') }}</span>
        @endif
    </div>
    <div class="pull-right"><button type="submit">{{ trans('admin.reset') }}</button></div>
    <div class="clearfix"></div>
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
</form>
</div>
</div><!-- end loginpage -->
</div>  <!-- end col-lg-4 -->
</div><!-- end row -->
@endsection
