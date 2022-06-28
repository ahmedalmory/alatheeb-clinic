@extends('admin.index')
@section('content')
@push('js')
<script type="text/javascript">
$(document).ready(function() {
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID

	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div class="" style="display:flex;margin-bottom:10px;"><input type="text" placeholder="{{ trans('admin.phones') }}" name="phones[]" class="form-control"><a href="#" class="remove_field btn btn-danger"><i class="fa fa-trash"></i></a></div>'); //add input box
		}
	});

	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});
</script>
@endpush
<style media="screen">
	.mb-3 , .control-label{
		margin-bottom: 10px !important
	}
	.form .form-row-seperated .form-group {
		border:0;
		    padding: 6px 0;
	}
	.form .form-row-seperated .form-group {
	    border: 0 !important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="widget-extra body-req portlet light bordered">
			<div class="portlet-title" style="border:none !important;">
				<div class="caption">
					<span class="caption-subject bold uppercase font-dark">{{$title}}</span>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="col-md-12">
					{!! Form::open(['url'=>aurl('setting'),'id'=>'setting','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
					<div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                            {!! Form::label('sitename',trans('admin.sitename'),['class'=>' control-label mb-3']) !!}
							{!! Form::text('sitename',setting()->sitename,['class'=>'form-control','placeholder'=>trans('admin.sitename')]) !!}
						</div>
					</div>

					<div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                            {!! Form::label('url',trans('admin.url'),['class'=>' control-label mb-3']) !!}
							{!! Form::text('url',setting()->url,['class'=>'form-control','placeholder'=>trans('admin.url')]) !!}
						</div>
					</div>
                    <div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                                {!! Form::label('sms_status',trans('admin.sms_status'),['class'=>' control-label mb-3']) !!}
								{!! Form::select('sms_status',['open'=>trans('admin.open'),'close'=>trans('admin.close')],setting()->sms_status,['class'=>'form-control']) !!}
							</div>
						</div>
					<div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                            {!! Form::label('phones',trans('admin.phones'),['class'=>' control-label mb-3']) !!}
							<div class="input_fields_wrap">
								@foreach(explode('|',setting()->phones) as $phone)
								<div class="mb-3" style="display:flex">
									<input type="text" value="{{ $phone }}" placeholder="{{ trans('admin.phones') }}" name="phones[]" class="form-control"><a href="#" class="remove_field btn btn-danger"><i class="fa fa-trash"></i></a></div>
								@endforeach
							</div>
							<div class="clearfix"></div>

							<button class="add_field_button btn btn-success"><i class="fa fa-plus-square-o"></i></button>
						</div>
					</div>



						<div class="form-group col-sm-6 col-md-3">
                            <div class="col-md-12">
                                {!! Form::label('sms_username',trans('admin.sms_username'),['class'=>' control-label mb-3']) !!}
								{!! Form::text('sms_username',setting()->sms_username,['class'=>'form-control','placeholder'=>trans('admin.sms_username')]) !!}
							</div>
						</div>
						<div class="form-group col-sm-6 col-md-3">
                            <div class="col-md-12">
                                {!! Form::label('sms_sender',trans('admin.sms_sender'),['class'=>' control-label mb-3']) !!}
								{!! Form::text('sms_sender',setting()->sms_sender,['class'=>'form-control','placeholder'=>trans('admin.sms_sender')]) !!}
							</div>
						</div>

						<div class="form-group col-sm-6 col-md-3">
                            <div class="col-md-12">
                                {!! Form::label('sms_password',trans('admin.sms_password'),['class'=>' control-label mb-3']) !!}
								{!! Form::text('sms_password',setting()->sms_password,['class'=>'form-control','placeholder'=>trans('admin.sms_password')]) !!}
							</div>
						</div>


					<div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                            {!! Form::label('email',trans('admin.email'),['class'=>' control-label mb-3']) !!}
							{!! Form::email('email',setting()->email,['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
						</div>
					</div>


                    <div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                            {!! Form::label('tax_enabled',"تفعيل الضريبة",['class'=>' control-label']) !!}
                            {!! Form::select('tax_enabled',[1=>'نعم',0=>"لا"],setting()->tax_enabled,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                            {!! Form::label('tax_rate',"قيمة الضريبة",['class'=>' control-label']) !!}
                            {!! Form::number('tax_rate',setting()->tax_rate,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                            {!! Form::label('tax_id',"الرقم الضريبي",['class'=>' control-label']) !!}
                            {!! Form::text('tax_id',setting()->tax_id,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                            {!! Form::label('address',"العنوان",['class'=>'col-md-3 control-label']) !!}
                            {!! Form::text('address',setting()->address,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group  col-sm-6 col-md-3" >
                        <div class="col-md-12">
                            {!! Form::label('build_num',"رقم المبنى",['class'=>' control-label']) !!}
                            {!! Form::text('build_num',setting()->build_num,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                            {!! Form::label('unit_num',"رقم الوحدة",['class'=>'control-label']) !!}
                            {!! Form::text('unit_num',setting()->unit_num,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                            {!! Form::label('postal_code',"الرمز البريدي",['class'=>' control-label']) !!}
                            {!! Form::text('postal_code',setting()->postal_code,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                            {!! Form::label('extra_number',"الرقم الاضافي",['class'=>' control-label']) !!}
                            {!! Form::text('extra_number',setting()->extra_number,['class'=>'form-control']) !!}
                        </div>
                    </div>
					<div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                            {!! Form::label('logo',trans('admin.logo'),['class'=>' control-label mb-3']) !!}
							{!! Form::file('logo',['class'=>'form-control','placeholder'=>trans('admin.logo')]) !!}
                            <img src="{{ it()->url(setting()->logo) }}" style="width:48px;height:48px;">

						</div>
					</div>

					<div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                            {!! Form::label('icon',trans('admin.icon'),['class'=>' control-label mb-3']) !!}
							{!! Form::file('icon',['class'=>'form-control','placeholder'=>trans('admin.icon')]) !!}
                            <img src="{{ it()->url(setting()->icon) }}" style="width:48px;height:48px;">
						</div>
					</div>
					<div class="form-group col-sm-6 col-md-3">
                        <div class="col-md-12">
                            {!! Form::label('status',trans('admin.status'),['class'=>' control-label mb-3']) !!}
							{!! Form::select('status',['open'=>trans('admin.open'),'close'=>trans('admin.close')],setting()->status,['class'=>'form-control']) !!}
						</div>
					</div>

					<div class="form-group col-md-12">
                        <div class="col-md-12">
                            {!! Form::label('message_status',trans('admin.message_status'),['class'=>' control-label mb-3']) !!}
							{!! Form::textarea('message_status',setting()->message_status,['class'=>'form-control', 'rows' => '6','placeholder'=>trans('admin.message_status')]) !!}
						</div>
					</div>






      				<div class="col-md-12">
      					<center><h3 style="font-weight:bold">{{ trans('admin.morning_and_evening') }}</h3></center>

      				<div class="col-md-6">
								<center><h3 >{{ trans('admin.morning') }}</h3></center>
								<div class="form-group col-md-6">
                                    <div class="col-md-12">
                                        {!! Form::label('from_morning',trans('admin.from_morning'),['class'=>'control-label mb-3 ']) !!}
										{!! Form::text('from_morning',setting()->from_morning,['class'=>'form-control timepicker','readonly'=>'','placeholder'=>trans('admin.from_morning')]) !!}
									</div>
								</div>
								<div class="form-group col-md-6">
                                    <div class="col-md-12">
                                            {!! Form::label('to_morning',trans('admin.to_morning'),['class'=>'control-label mb-3  ']) !!}
											{!! Form::text('to_morning',setting()->to_morning,['class'=>'form-control timepicker','readonly'=>'','placeholder'=>trans('admin.to_morning')]) !!}
										</div>
								</div>
      				</div>

							<div class="col-md-6">
								<center><h3 >{{ trans('admin.evening') }}</h3></center>
								<div class="form-group col-md-6">
                                    <div class="col-md-12">
                                        {!! Form::label('from_evening',trans('admin.from_evening'),['class'=>'control-label mb-3 ']) !!}
										{!! Form::text('from_evening',setting()->from_evening,['class'=>'form-control timepicker','readonly'=>'','placeholder'=>trans('admin.from_evening')]) !!}
									</div>
								</div>
								<div class="form-group col-md-6">
                                    <div class="col-md-12">
                                        {!! Form::label('to_evening',trans('admin.to_evening'),['class'=>'control-label mb-3  ']) !!}
										{!! Form::text('to_evening',setting()->to_evening,['class'=>'form-control timepicker','readonly'=>'','placeholder'=>trans('admin.to_evening')]) !!}
									</div>
								</div>
							</div>



							<div class="form-group col-md-12">
								<center><h4>{{ trans('admin.calc_diff_time') }}</h4></center>
								<small style="color:#c33">{{ trans('admin.warning_calc') }}</small>
								<ul>
									<li>{{ trans('admin.calc_morning') }} : {{ calc_time() }}</li>
									<li>{{ trans('admin.calc_evening') }}  : {{ calc_time('evening') }}</li>
								</ul>
							</div>

      			 	<div class="form-group col-md-6">
								{!! Form::label('patient_exposure',trans('admin.patient_exposure'),['class'=>'control-label mb-3  ']) !!}
								<div class="col-md-12">
									 <select name="patient_exposure" class="form-control">
									 	@for($i=1;$i<61;$i++)
									 	 <option value="{{ $i }}" {{ setting()->patient_exposure == $i ?'selected':''}} >{{ $i }} - {{ trans('admin.mintues') }}</option>
									 	@endfor
									 </select>
								</div>
							</div>

      			 	<div class="form-group col-md-6">
						{!! Form::label('alert_patient',trans('admin.alert_patient'),['class'=>'control-label mb-3  ']) !!}
						<div class="col-md-12">
							 <select name="alert_patient" class="form-control">
							 	@for($i=1;$i<25;$i++)
							 	 <option value="{{ $i }}" {{ setting()->alert_patient == $i ?'selected':''}} >{{ $i }} - {{ trans('admin.hours') }}</option>
							 	@endfor
							 </select>
						</div>
					</div>

      				</div>


					<div class="form-actions">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="text-center" style="margin-top:15px">
										{!! Form::submit(trans('admin.save'),['class'=>'btn btn-lg btn-success']) !!}
									</div>
								</div>
							</div>
						</div>
					</div>
					{!! Form::close() !!}
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
@stop
