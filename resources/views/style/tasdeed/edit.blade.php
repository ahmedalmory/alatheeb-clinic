@extends('style.index')
@section('content')
@push('js')
<style type="text/css">
textarea.content{
    width: 100%;
    height: 35px;
    padding: 6px 12px;
    background-color: #fff;
    border: 1px solid #c2cad8;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
</style>
<script type="text/javascript">
$(document).ready(function(){

$('.get_patient').on("select2:selecting", function(e) {
     $('.period,.in_day_div,.in_time').removeClass('hidden');
});
@if($invoices->patient_id)
     $('.period,.in_day_div,.in_time').removeClass('hidden');
@endif
 $('.get_patient').select2({
  ajax: {
    url: '{{ url('get/patient') }}',
     dataType: 'json',
	 delay: 250,
	 type:'post',
     data: function (params) {
      return {
        text: params.term, // search term
        page: params.page,
        _token: '{{ csrf_token() }}'
      };
     },
     processResults: function (data, params) {
      // parse the results into the format expected by Select2
      // since we are using custom formatting functions we do not need to
      // alter the remote JSON data, except to indicate that infinite
      // scrolling can be used
      params.page = params.page || 1;
      //console.log(data);
      return {
        results: data.users,
        pagination: {
          more: (params.page * 30) < data.count
        }
      };
    },
      placeholder: '{{trans('admin.search')}}',
	  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
	  minimumInputLength: 1,
      cache: true
  }
});

$(document).on('change','.dr_group_id',function(){
 	var group_id = $('.dr_group_id option:selected').val();
 	if(group_id > 0)
 	{
 		$.ajax({
 			url:'{{ url('load/users/doctor') }}',
 			type:'post',
 			dataType:'html',
 			data:{group_id:group_id,_token:'{{ csrf_token() }}'},
 			success: function(data)
 			{
 				$('.dr_id').removeClass('hidden');
 				$('.dr_id').html(data);
 			}
 		});
 	}
 });
 @if($invoices->dr_id and  $invoices->dr_group_id)
	$.ajax({
		url:'{{ url('load/users/doctor') }}',
		type:'post',
		dataType:'html',
		data:{group_id:'{{ $invoices->dr_group_id }}',_token:'{{ csrf_token() }}',select:'{{ $invoices->dr_id }}'},
		success: function(data)
		{
			$('.dr_id').removeClass('hidden');
			$('.dr_id').html(data);
		}
	});
 @endif


$(document).on('change','.accountant_group_id',function(){
 	var group_id = $('.accountant_group_id option:selected').val();
 	if(group_id > 0)
 	{
 		$.ajax({
 			url:'{{ url('load/users/accountant') }}',
 			type:'post',
 			dataType:'html',
 			data:{group_id:group_id,_token:'{{ csrf_token() }}'},
 			success: function(data)
 			{
 				$('.accountant_id').removeClass('hidden');
 				$('.accountant_id').html(data);
 			}
 		});
 	}
 });
 @if($invoices->accountant_id and  $invoices->accountant_group_id)
	$.ajax({
		url:'{{ url('load/users/accountant') }}',
		type:'post',
		dataType:'html',
		data:{group_id:'{{ $invoices->accountant_group_id }}',_token:'{{ csrf_token() }}',select:'{{ $invoices->accountant_id }}'},
		success: function(data)
		{
			$('.accountant_id').removeClass('hidden');
			$('.accountant_id').html(data);
		}
	});
 @endif



autosize($('.content'));
	var max_fields      = 100; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID

	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
		$(wrapper).append('<tr>'+
						'<td>{!! Form::text('price_list[]','',['class'=>'form-control','placeholder'=>trans('admin.price_list')]) !!}</td>'+
						'<td>'+
						'{!! Form::textarea('content[]','',['class'=>'content','placeholder'=>trans('admin.content')]) !!}</div>'+
							'</td><td><a href="#" class="remove_field btn btn-danger"><i class="fa fa-trash"></i></a></td>'+
						'</tr>'); //add input box
		}
	autosize($('.content'));
	});

	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault();
		$(this).parent().parent().remove(); x--;
	});


 $(document).on('change','.period,.in_day',function(){
 	var period 		  = $('.period option:selected').val();
 	var in_day        = $('.in_day').val();
 	var patient_id    = $('.get_patient').select2().val();
 	$.ajax({
 		url:'{{ url('load/period/invoice') }}',
 		dataType:'html',
 		type:'post',
 		data:{_token:'{{ csrf_token() }}',day:in_day,period:period,patient_id:patient_id},
 		beforeSend: function()
 		{
 			$('.in_time_load').removeClass('hidden');
 			$('.in_time').html('');
 		},
 		success: function(data)
 		{
 			$('.in_time_load').addClass('hidden');
 			$('.in_time').html(data);
 		}
 	});
 });

 @if($invoices->in_day and $invoices->period and $invoices->patient_id)

 $.ajax({
 		url:'{{ url('load/period/invoice') }}',
 		dataType:'html',
 		type:'post',
 		data:{_token:'{{ csrf_token() }}',day:'{{ $invoices->in_day }}',period:'{{ $invoices->period }}',select:'{{ $invoices->in_time }}',patient_id:'{{ $invoices->patient_id }}',select:'{{ $invoices->in_time }}'},
 		beforeSend: function()
 		{
 			$('.in_time_load').removeClass('hidden');
 			$('.in_time').html('');
 		},
 		success: function(data)
 		{
 			$('.in_time_load').addClass('hidden');
 			$('.in_time').html(data);
 		}
 	});
 @endif



});
</script>

<script type="text/javascript">
$(document).ready(function(){

  $('#jstree').jstree({
    "core" : {
      'data' : {!! load_dep($invoices->dep_id) !!},
      "themes" : {
        "variant" : "large"
      }
    },
    "checkbox" : {
      "keep_selected_style" : false
    },
    "plugins" : [ "wholerow" ]
  });

});

 $('#jstree').on('changed.jstree',function(e,data){
    var i , j , r = [];
    for(i=0,j = data.selected.length;i < j;i++)
    {
        r.push(data.instance.get_node(data.selected[i]).id);
    }
    $('.dep_id').val(r.join(', '));
});

</script>
@endpush
<div class="row">
	<div class="col-md-12">
		<div class="widget-extra body-req portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject bold uppercase font-dark">{{$title}}</span>
				</div>
				<div class="actions">
                    @user_can("invoices-create")
					<a class="btn btn-circle btn-icon-only btn-default" href="{{url('invoices/create')}}"
						data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.invoices')}}">
						<i class="fa fa-plus"></i>
					</a>
                    @end_user_can
                    @user_can("invoices-delete")
                    <span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.invoices')}}">
						<a data-toggle="modal" data-target="#myModal{{$invoices->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
							<i class="fa fa-trash"></i>
						</a>
					</span>
					<div class="modal fade" id="myModal{{$invoices->id}}">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button class="close" data-dismiss="modal">x</button>
									<h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
								</div>
								<div class="modal-body">
									<i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$invoices->id}}) ؟
								</div>
								<div class="modal-footer">
									{!! Form::open([
									'method' => 'DELETE',
									'route' => ['invoices.destroy', $invoices->id]
									]) !!}
									{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
									<a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
									{!! Form::close() !!}
								</div>
							</div>
						</div>
					</div>
                    @end_user_can
					<a class="btn btn-circle btn-icon-only btn-default" href="{{url('invoices')}}"
						data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.invoices')}}">
						<i class="fa fa-list"></i>
					</a>
					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
						data-original-title="{{trans('admin.fullscreen')}}"
						title="{{trans('admin.fullscreen')}}">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="col-md-12">

					{!! Form::open(['url'=>url('/invoices/'.$invoices->id),'method'=>'put','id'=>'invoices','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}

					 <div class="clearfix"></div>
				    <h2>{{ trans('admin.dep_id') }}</h2>
                    <div id="jstree"></div>
                    <input type="hidden" name="dep_id" class="dep_id" value="{{ $invoices->dep_id }}">
                    <div class="clearfix"></div>

					<div class="form-group">
						{!! Form::label('patient_id',trans('admin.patient_id'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::select('patient_id',App\Model\Patient::selectRaw('id as id')
            ->selectRaw('CONCAT("' . trans('admin.name') . ': ",first_name,"  ",father_name,"  ",grand_name,"  - ' . trans('admin.civil') . ': ",civil)  as text')
							->where('id',$invoices->patient_id)->pluck('text','id'),$invoices->patient_id,['class'=>'form-control get_patient','placeholder'=>trans('admin.patient_id')]) !!}
						<small style="color:#c33"><i class="fa fa-info"></i> {{ trans('admin.search_patient_at') }}</small>
						</div>
					</div>

					<br>

					<div class="form-group period hidden">
						{!! Form::label('period',trans('admin.period'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::select('period',['morning'=>trans('admin.morning'),'evening'=>trans('admin.evening'),],$invoices->period,['class'=>'form-control period','placeholder'=>'...........']) !!}
						</div>
					</div>
					<br>
					<div class="form-group in_day_div hidden">
						{!! Form::label('in_day',trans('admin.in_day'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::text('in_day',$invoices->in_day?$invoices->in_day:date('Y-m-d'),['class'=>'form-control in_day date-picker','placeholder'=>trans('admin.in_day'),'readonly'=>'readonly','data-date'=>date("Y-m-d"),'data-date-format'=>'yyyy-mm-dd']) !!}
						</div>
					</div>
					<br>
					<i class="fa fa-spinner fa-spin in_time_load hidden"></i>
					<div class="in_time hidden">
					</div>
					<br>

					<div class="clearfix"></div>
					@if(in_array(auth()->user()->level,['accountant','recep']))
					<div class="form-group col-md-6">
						{!! Form::label('dr_group_id',trans('admin.dr_group_id'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::select('dr_group_id',App\Model\Group::pluck('group_name','id'),$invoices->dr_group_id,['class'=>'form-control dr_group_id','placeholder'=>trans('admin.dr_group_id')]) !!}
						</div>
					</div>

					<div class="form-group col-md-6">
						{!! Form::label('dr_id',trans('admin.dr_id'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9 dr_id hidden">

						</div>
					</div>
					@endif
					<div class="clearfix"></div>
					@if(in_array(auth()->user()->level,['dr','recep']))
					<div class="form-group col-md-6">
						{!! Form::label('accountant_group_id',trans('admin.accountant_group_id'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::select('accountant_group_id',App\Model\Group::pluck('group_name','id'),$invoices->accountant_group_id,['class'=>'form-control accountant_group_id','placeholder'=>trans('admin.accountant_group_id')]) !!}
						</div>
					</div>
					<div class="form-group col-md-6">
						{!! Form::label('accountant_id',trans('admin.accountant_id'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9 accountant_id hidden">

						</div>
					</div>
					@endif
					<div class="clearfix"></div>
					<br>
					<div class="form-group">
						{!! Form::label('invoice_date',trans('admin.invoice_date'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::text('invoice_date',$invoices->invoice_date?$invoices->invoice_date:date('Y-m-d'),['class'=>'form-control date-picker','placeholder'=>trans('admin.invoice_date'),'readonly'=>'readonly','data-date'=>date("Y-m-d"),'data-date-format'=>'yyyy-mm-dd']) !!}
						</div>
					</div>
					<br>
					<div class="form-group">
						<table class="table table-bordered table-striped table-hover">
							<tr>
								<th width="20%">{{ trans('admin.price_list') }}</th>
								<th>{{ trans('admin.content') }}</th>
								<th  width="5%"></th>
							</tr>
							<tbody class="input_fields_wrap">
							<?php
$i = 0;
?>
@if(count(explode('|',$invoices->content)) > 0)
							@foreach(explode('|',$invoices->content) as $content)
							<tr>
								<td>{!! Form::text('price_list[]',@explode('|',$invoices->price_list)[$i],['class'=>'form-control','placeholder'=>trans('admin.price_list')]) !!}</td>
								<td>
									{!! Form::textarea('content[]',$content,['class'=>'content','placeholder'=>trans('admin.content')]) !!}
								</td>
								</td><td><a href="#" class="remove_field btn btn-danger"><i class="fa fa-trash"></i></a></td>
							</tr>
							<?php
$i++;
?>
							@endforeach
@endif
							</tbody>
						</table>

					 	<button class="add_field_button btn btn-primary"><i class="fa fa-plus-square"></i></button>


					</div>

					<br>
					<div class="form-group">
						{!! Form::label('invoice_status',trans('admin.invoice_status'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::select('invoice_status',['paid'=>trans('admin.paid'),'unpaid'=>trans('admin.unpaid'),],$invoices->invoice_status,['class'=>'form-control','placeholder'=>trans('admin.invoice_status')]) !!}
						</div>
					</div>
					<br>
					<div class="form-group">
						{!! Form::label('pay_at',trans('admin.pay_at'),['class'=>'col-md-3 control-label']) !!}
					<div class="col-md-9">
						{!! Form::select('pay_at',['visa'=>trans('admin.visa'),'cash'=>trans('admin.cash'),],$invoices->pay_at,['class'=>'form-control','placeholder'=>trans('admin.pay_at')]) !!}
							</div>
					</div>
					<br>

					<div class="form-actions">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										{!! Form::submit(trans('admin.save'),['class'=>'btn btn-success']) !!}
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
