@extends('style.index')
@section('content')
@push('js')
<script type="text/javascript">
$(document).ready(function(){
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
      console.log(data);
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
 $(document).on('change','.group_id',function(){
 	var group_id = $('.group_id option:selected').val();
 	if(group_id > 0)
 	{
 		$.ajax({
 			url:'{{ url('load/users') }}',
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
 @if($appointments->user_id and  $appointments->group_id)
	$.ajax({
		url:'{{ url('load/users') }}',
		type:'post',
		dataType:'html',
		data:{group_id:'{{ $appointments->group_id }}',_token:'{{ csrf_token() }}',select:'{{ $appointments->user_id }}'},
		success: function(data)
		{
			$('.user_id').removeClass('hidden');
			$('.user_id').html(data);
		}
	});
 @endif

 $(document).on('change','.period,.in_day',function(){
 	var period = $('.period option:selected').val();
 	var day    = $('.in_day').val();
 	$.ajax({
 		url:'{{ url('load/period') }}',
 		dataType:'html',
 		type:'post',
 		data:{_token:'{{ csrf_token() }}',day:day,period:period},
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

 @if($appointments->in_day and $appointments->period)
 $.ajax({
 		url:'{{ url('load/period') }}',
 		dataType:'html',
 		type:'post',
 		data:{_token:'{{ csrf_token() }}',day:'{{ $appointments->in_day }}',period:'{{ $appointments->period }}',select:'{{ $appointments->in_time }}'},
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
      'data' : {!! load_dep($appointments->dep_id) !!},
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
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-lg-offset-2">
  <div class="datespage">
    <div class="title">{{ $title }}</div>
    <div class="content">
      <div class="adddate">
{!! Form::open(['url'=>url('/appointments/'.$appointments->id),'method'=>'put','id'=>'appointments','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}

<div class="clearfix"></div>
<h2>{{ trans('admin.dep_id') }}</h2>
<div id="jstree"></div>
<input type="hidden" name="dep_id" class="dep_id" value="{{ $appointments->dep_id }}">
<div class="clearfix"></div>

<div class="form-group">
	{!! Form::label('patient_id',trans('admin.patient_id'),['class'=>'col-md-3 control-label']) !!}
	<div class="col-md-9">
		{!! Form::select('patient_id',App\Model\Patient::selectRaw('id as id')
->selectRaw('CONCAT("' . trans('admin.name') . ': ",first_name,"  ",father_name,"  ",grand_name,"  - ' . trans('admin.civil') . ': ",civil)  as text')
		->where('id',$appointments->patient_id)->pluck('text','id')
		,$appointments->patient_id,['class'=>'form-control get_patient','placeholder'=>trans('admin.patient_id')]) !!}
		<small style="color:#c33"><i class="fa fa-info"></i> {{ trans('admin.search_patient_at') }}</small>
	</div>
</div>

<div class="form-group">
	{!! Form::label('period',trans('admin.period'),['class'=>'col-md-3 control-label']) !!}
	<div class="col-md-9">
		{!! Form::select('period',['morning'=>trans('admin.morning'),'evening'=>trans('admin.evening'),],$appointments->period,['class'=>'form-control period','placeholder'=>'...........']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('in_day',trans('admin.in_day'),['class'=>'col-md-3 control-label']) !!}
	<div class="col-md-9">
		{!! Form::text('in_day',$appointments->in_day?$appointments->in_day:date('Y-m-d'),['class'=>'form-control in_day date-picker','placeholder'=>trans('admin.in_day'),'readonly'=>'readonly','data-date'=>date("Y-m-d"),'data-date-format'=>'yyyy-mm-dd']) !!}
	</div>
</div>

<i class="fa fa-spinner fa-spin in_time_load hidden"></i>
<div class="in_time">
</div>

<div class="form-group">
	{!! Form::label('group_id',trans('admin.group_id'),['class'=>'col-md-3 control-label']) !!}
	<div class="col-md-9">
		{!! Form::select('group_id',App\Model\Group::pluck('group_name','id'),$appointments->group_id,['class'=>'form-control group_id','placeholder'=>trans('admin.group_id')]) !!}
	</div>
</div>

<div class="form-group ">
	{!! Form::label('user_id',trans('admin.user_id'),['class'=>'col-md-3 control-label']) !!}
	<div class="col-md-9 user_id hidden">

	</div>
</div>

<div class="form-group">
	{!! Form::label('attend_status',trans('admin.attend_status'),['class'=>'col-md-3 control-label']) !!}
	<div class="col-md-9">
		{!! Form::select('attend_status',['pending'=>trans('admin.pending'),'confirmed'=>trans('admin.confirmed'),'unattended'=>trans('admin.unattended'),'attended'=>trans('admin.attended'),],$appointments->attend_status,['class'=>'form-control','placeholder'=>trans('admin.attend_status')]) !!}
	</div>
</div>


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
	 </div><!-- end adddate -->
    </div><!-- end content -->
  </div><!-- end datespage -->
</div><!-- end col-lg-2 -->
</div><!-- end row -->

@stop
