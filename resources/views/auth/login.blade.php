@extends('style.index')

@section('content')
<style>
body {
  background-color: rgb(228, 229, 247);
  background-image: url('./design/style/images/header.png');
  background-size: cover;
  background-repeat: no-repeat;
  font-family: 'cairo';
}
.social-login img {
  width: 24px;
}
a {
  text-decoration: none;
}

.card {
  font-family: sans-serif;
  max-width: 360px;
  width: 100%;
  margin-left: auto;
  margin-right: auto;
  margin-top: 3em;
  margin-bottom:3em;
  border-radius: 10px;
  background-color: #ffff;
  padding: 1.8rem;
  box-shadow: 2px 5px 20px rgba(0, 0, 0, 0.1);
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
  padding: 15px 20px;
  margin-top: 8px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-sizing: border-box;
  height: auto;
}

.cta-btn {
  background-color: rgb(69, 69, 185);
  color: white !important;
  padding: 18px 20px !important;
  margin-top: 10px;
  margin-bottom: 0;
  width: 100%;
  border-radius: 10px !important;
  border: none !important;
  cursor: pointer;
  height: auto !important;
  line-height: 17px !important;
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
</style>

<br><br>
<div class="" style="min-height:80vh">

<div class ="card pb-0" >
    <div class="row">
      <div class="" style="background-color: #fff; padding: 0px;">
        <div class="loginpage">
          <!-- <div class="title" style="">   <img src="{{ it()->url(setting()->logo) }}" alt=""> </div> -->
           <div class="content">
               <!-- margin-right: 5px; margin-left: 5px; -->
               <div class="row email-login" style="">
                 <div class="" style="text-align: center;">
                   <img class="logo-de" src="http://sjl.const-tech.biz/medical_complex/public_html/design/admin_panel/assets/layouts/layout4/img/logo-light.png" alt="">
                 </div>
                   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                        <div class="" style="display:flex;align-items:center;justify-content: space-between;">
                          <div class="header"> <b> {{__("app.employees_login_only")}}</b> </div>
                          <div class="">
                            <a href="{{url('lang?loc='.(app()->getLocale() == "ar"?"en":"ar"))}}" title="{{app()->getLocale() == "ar"?"English":"العربية"}}" style="color:#1c7d7e">
                              <i class="fas fa-language" style="font-size:30px"></i>
                            </a>
                          </div>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            <div class="form-group">
                              <label for="email">{{ trans('admin.email') }}</label>
                              <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} border10" name="email" value="{{ old('email') }}"   id="email">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail2">{{ trans('admin.password') }}</label>
                              <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} border10" name="password" required >
                              @if ($errors->has('password'))
                              <span class="invalid-feedback" role="alert">{{ $errors->first('password') }}</span>
                              @endif
                            </div>

                            <button class=" cta-btn btn-block" type="submit">{{ trans('admin.login') }}</button>
                            <div class="hidden pull-left"><div class="fpass"><a href="{{ route('password.request') }}" title="#">{{ trans('admin.forgot_password') }} </a></div></div>
                            <div class="clearfix"></div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div><!-- end loginpage -->
        </div><!-- end loginpage -->
      </div>  <!-- end col-lg-4 -->
    </div><!-- end row -->
</div>
</div>

@endsection
