@extends('admin.index')
@section('content')
<style type="text/css">
textarea.treatment{
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
@push('js')

<script type="text/javascript">
$(document).ready(function(){
autosize($('.treatment'));


$('.get_patient').on("select2:selecting", function(e) {
     $('.period,.in_day_div,.in_time').removeClass('hidden');
});
@if(old('patient_id'))
     $('.period,.in_day_div,.in_time').removeClass('hidden');
@endif
 $('.get_patient').select2({
  ajax: {
    url: '{{ aurl('get/patient') }}',
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




 $(document).on('change','.period,.in_day',function(){
 	var period 		  = $('.period option:selected').val();
 	var in_day        = $('.in_day').val();
 	var patient_id    = $('.get_patient').select2().val();
 	$.ajax({
 		url:'{{ aurl('load/period/diagnosis') }}',
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

 @if(old('in_day') and old('period') and old('patient_id'))

 $.ajax({
 		url:'{{ aurl('load/period/diagnosis') }}',
 		dataType:'html',
 		type:'post',
 		data:{_token:'{{ csrf_token() }}',day:'{{ old('in_day') }}',period:'{{ old('period') }}',select:'{{ old('in_time') }}',patient_id:'{{ old('patient_id') }}',select:'{{ old('in_time') }}',appoint_id:'{{ old('appoint_id') }}'},
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





 $(document).on('change','.group_id',function(){
 	var group_id = $('.group_id option:selected').val();
 	if(group_id > 0)
 	{
 		$.ajax({
 			url:'{{ aurl('load/users/doctor') }}',
 			type:'post',
 			dataType:'html',
 			data:{group_id:group_id,_token:'{{ csrf_token() }}'},
 			success: function(data)
 			{
 				$('.user_id').removeClass('hidden');
 				$('.user_id').html(data);
 			}
 		});
 	}
 });
 @if(old('dr_id') and  old('group_id'))
	$.ajax({
		url:'{{ aurl('load/users/doctor') }}',
		type:'post',
		dataType:'html',
		data:{group_id:'{{ old('group_id') }}',_token:'{{ csrf_token() }}',select:'{{ old('dr_id') }}'},
		success: function(data)
		{
			$('.user_id').removeClass('hidden');
			$('.user_id').html(data);
		}
	});
 @endif


});
</script>
<script type="text/javascript">
$(document).ready(function(){

  $('#jstree').jstree({
    "core" : {
      'data' : {!! load_dep(old('dep_id')) !!},
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
					<a  href="{{aurl('diagnosis')}}"
						class="btn btn-circle btn-icon-only btn-default"
						tooltip="{{trans('admin.show_all')}}"
						title="{{trans('admin.show_all')}}">
						<i class="fa fa-list"></i>
					</a>
					<a class="btn btn-circle btn-icon-only btn-default fullscreen"
						href="#"
						data-original-title="{{trans('admin.fullscreen')}}"
						title="{{trans('admin.fullscreen')}}">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="col-md-12">
					{!! Form::open(['url'=>aurl('/diagnosis'),'id'=>'diagnosis','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}

					    <div class="clearfix"></div>
				    <h2>{{ trans('admin.dep_id') }}</h2>
                    <div id="jstree"></div>
                    <input type="hidden" name="dep_id" class="dep_id" value="{{ old('dep_id') }}">
                    <div class="clearfix"></div>


					<div class="form-group">
						{!! Form::label('group_id',trans('admin.group_id'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::select('group_id',App\Models\Group::pluck('group_name','id'),old('group_id'),['class'=>'form-control group_id','placeholder'=>trans('admin.group_id')]) !!}
						</div>
					</div>
					<br>
					<div class="form-group ">
						{!! Form::label('user_id',trans('admin.user_id'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9 user_id hidden">

						</div>
					</div>
					<br>



					<div class="form-group">
						{!! Form::label('patient_id',trans('admin.patient_id'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::select('patient_id',App\Models\Patient::selectRaw('id as id')
							->selectRaw('CONCAT("' . trans('admin.name') . ': ",first_name,"  ",father_name,"  ",grand_name,"  - ' . trans('admin.civil') . ': ",civil)  as text')
							->where('id',old('patient_id'))->pluck('text','id'),old('patient_id'),['class'=>'form-control get_patient','placeholder'=>trans('admin.patient_id')]) !!}
							<small style="color:#c33"><i class="fa fa-info"></i> {{ trans('admin.search_patient_at') }}</small>
						</div>
					</div>
					<br>
					<div class="form-group period hidden">
						{!! Form::label('period',trans('admin.period'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::select('period',['morning'=>trans('admin.morning'),'evening'=>trans('admin.evening'),],old('period'),['class'=>'form-control period','placeholder'=>'...........']) !!}
						</div>
					</div>
					<br>
					<div class="form-group in_day_div hidden">
						{!! Form::label('in_day',trans('admin.in_day'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::text('in_day',old('in_day')?old('in_day'):date('Y-m-d'),['class'=>'form-control in_day date-picker','placeholder'=>trans('admin.in_day'),'readonly'=>'readonly','data-date'=>date("Y-m-d"),'data-date-format'=>'yyyy-mm-dd']) !!}
						</div>
					</div>
					<br>
					<i class="fa fa-spinner fa-spin in_time_load hidden"></i>
					<div class="in_time hidden">
					</div>
					<br>
					<div class="form-group">
						<table class="table table-bordered table-striped table-hover">
							<tr>
								<th width="50%">{{ trans('admin.treatment') }}</th>
								<th>{{ trans('admin.tooth') }}</th>
							</tr>
							<tbody>
								<tr>
									<td>
										{!! Form::textarea('treatment',old('treatment'),['class'=>'treatment','placeholder'=>trans('admin.treatment')]) !!}
									</td>
									<td>
										{!! Form::textarea('tooth',old('tooth'),['class'=>'form-control treatment','placeholder'=>trans('admin.tooth')]) !!}
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="form-group">
						{!! Form::label('taken',trans('admin.taken'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::textarea('taken',old('taken'),['class'=>'form-control','placeholder'=>trans('admin.taken')]) !!}
						</div>
					</div>
					<br>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										{!! Form::submit(trans('admin.add'),['class'=>'btn btn-success']) !!}
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
