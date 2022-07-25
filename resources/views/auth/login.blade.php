@extends('style.index')

@section('content')
<style>
body {
  background-color: rgb(228, 229, 247);
  background-image: url('./design/style/images/header.png');
  background-size: cover;
  background-repeat: no-repeat;
  font-family: 'Droid Arabic Kufi' !important;
}

.social-login img {
  width: 24px;
}
a {
  text-decoration: none;
}

.card {
  font-family: sans-serif;
  max-width: 850px;
  margin-left: auto;
  flex-wrap:wrap;
  display:flex;
  align-items:center;
  margin-right: auto;
  margin-top: 3em;
  margin-bottom:3em;
  border-radius: 10px;
  background-color: #ffff;
  box-shadow: 2px 5px 20px rgba(0, 0, 0, 0.1);
}
@media (max-width:700px) {
    .img-log {
    max-height:150px;
    object-fit: cover;
}
    }
.loginpage .content {
    padding: 15px 55px !important;
}
.title {
  text-align: center;
  font-weight: bold;
  margin: 0;
}
.subtitle {
  text-align: center;
  font-weight: bold;
}
.btn-text {
  margin: 0;
}

.social-login {
  display: flex;
  justify-content: center;
  gap: 5px;
}

.google-btn {
  background: #fff;
  border: solid 2px rgb(245 239 239);
  border-radius: 8px;
  font-weight: bold;
  display: flex;
  padding: 10px 10px;
  flex: auto;
  align-items: center;
  gap: 5px;
  justify-content: center;
}
.fb-btn {
  background: #fff;
  border: solid 2px rgb(69, 69, 185);
  border-radius: 8px;
  padding: 10px;
  display: flex;
  align-items: center;
}

.or {
  text-align: center;
  font-weight: bold;
  border-bottom: 2px solid rgb(245 239 239);
  line-height: 0.1em;
  margin: 25px 0;
}
.or span {
  background: #fff;
  padding: 0 10px;
}

.email-login {
  display: flex;
  flex-direction: column;
}
.email-login label {
  color: rgb(170 166 166);
}

input[type="email"],
input[type="text"],
input[type="password"] {
  padding: 13px 15px;
  margin-top: 8px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-sizing: border-box;
  height: auto;
}
.header {
    text-align:center;
    font-size: 25px;
    margin-bottom:10px;
}
.cta-btn {
  background-color: #64B274;
  color: white !important;
  padding: 13px 15px !important;
  margin-top: 2rem !important;
  margin-bottom: 0;
  width: 100%;
  border-radius: 4px !important;
  border: none !important;
  cursor: pointer;
  height: auto !important;
  line-height: 17px !important;
  box-shadow:none !important;
}

.forget-pass {
  text-align: center;
  display: block;
}

.logo-de {
  height: 90px;
      width: 90px;
      box-shadow: 1px 1px 9px #ddd;
      padding: 5px;
      border-radius: 50%;
      object-fit: contain;
      margin-top: -100px;
      background-color: #fff;
}
.pb-0 {
    padding-bottom: 0 !important;
}
.inp-log {
    border:0 !important;
    border-radius: 4px !important;
    border-bottom:1px solid #ddd !important;
}

.img-log {
    width: 100%;
}
.px-0 {
    padding-right:0 !important;
    padding-left:0 !important;
}
</style>

<br><br>
<div class="" style="min-height:80vh">

<div class ="card row p-0" >
    <div class="col-xs-12 col-md-6 px-0">
        <img class="img-log" src="{{url('design/style/images/Doctor.jpg')}}" alt="">
    </div>
    <div class="col-xs-12 col-md-6 px-0">
      <div class="" style="background-color: #fff; padding: 0px;">
        <div class="loginpage">
          <!-- <div class="title" style="">   <img src="{{ it()->url(setting()->logo) }}" alt=""> </div> -->
           <div class="content">
               <!-- margin-right: 5px; margin-left: 5px; -->

                       <div class="" style="display:flex;align-items:center;justify-content: end;">
                       <a href="{{url('lang?loc='.(app()->getLocale() == "ar"?"en":"ar"))}}" title="{{app()->getLocale() == "ar"?"English":"العربية"}}" style="color:#1c7d7e">
                              <i class="fas fa-language" style="font-size:30px"></i>
                            </a>
                    </div>
                          <div class="header"> <b> {{__("app.employees_login_only")}}</b> </div>
                          <div class="">

                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            <div class="form-group">
                              <input type="email" placeholder="{{ trans('admin.email') }}" name="email" class="inp-log form-control {{ $errors->has('email') ? ' is-invalid' : '' }} border10" name="email" value="{{ old('email') }}"   id="email">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                              <input id="password" type="password" placeholder="{{ trans('admin.password') }}" class="inp-log form-control {{ $errors->has('password') ? ' is-invalid' : '' }} border10" name="password" required >
                              @if ($errors->has('password'))
                              <span class="invalid-feedback" role="alert">{{ $errors->first('password') }}</span>
                              @endif
                            </div>

                            <button class="mt-4 cta-btn btn-block" type="submit">{{ trans('admin.login') }}</button>
                            <div class="hidden pull-left"><div class="fpass"><a href="{{ route('password.request') }}" title="#">{{ trans('admin.forgot_password') }} </a></div></div>
                            <div class="clearfix"></div>
                            @csrf
                        </form>
            </div><!-- end loginpage -->
        </div><!-- end loginpage -->
      </div>  <!-- end col-lg-4 -->
    </div><!-- end row -->
</div>
</div>

@endsection
