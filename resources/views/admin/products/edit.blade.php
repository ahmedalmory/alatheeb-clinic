@extends('admin.index')
@section('content')
@push('js')
<script type="text/javascript">
$(document).ready(function(){

  $('#jstree').jstree({
    "core" : {
      'data' : {!! load_dep($users->dep_id) !!},
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
					<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('users/create')}}"
						data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.users')}}">
						<i class="fa fa-plus"></i>
					</a>
					<span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.users')}}">
						<a data-toggle="modal" data-target="#myModal{{$users->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
							<i class="fa fa-trash"></i>
						</a>
					</span>
					<div class="modal fade" id="myModal{{$users->id}}">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button class="close" data-dismiss="modal">x</button>
									<h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
								</div>
								<div class="modal-body">
									<i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$users->id}}) ؟
								</div>
								<div class="modal-footer">
									{!! Form::open([
									'method' => 'DELETE',
									'route' => ['users.destroy', $users->id]
									]) !!}
									{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
									<a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
									{!! Form::close() !!}
								</div>
							</div>
						</div>
					</div>
					<a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('users')}}"
						data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.users')}}">
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

					{!! Form::open(['url'=>aurl('/users/'.$users->id),'method'=>'put','id'=>'users','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
					<div class="form-group">
						{!! Form::label('name',trans('admin.name'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::text('name', $users->name ,['class'=>'form-control','placeholder'=>trans('admin.name')]) !!}
						</div>
					</div>
					<br>
					<div class="form-group">
						{!! Form::label('email',trans('admin.email'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::email('email', $users->email ,['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
						</div>
					</div>
					<br>
					<div class="form-group">
						{!! Form::label('password',trans('admin.password'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::password('password',['class'=>'form-control','placeholder'=>trans('admin.password')]) !!}
						</div>
					</div>
					<br>
					<div class="form-group">
						{!! Form::label('salary',trans('admin.salary'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::number('salary',old('salary',$users->salary),['class'=>'form-control','placeholder'=>trans('admin.salary')]) !!}
						</div>
					</div>
					<br>
					<div class="form-group">
						{!! Form::label('rate',trans('admin.rate'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::number('rate',old('rate',$users->rate),['class'=>'form-control','placeholder'=>trans('admin.rate')]) !!}
						</div>
					</div>
					<br>
					<div class="form-group">
						{!! Form::label('rate_active',trans('admin.rate_active'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							<input type="checkbox" name="rate_active" {{ $users->rate_active?'checked':'' }} id="">
						</div>
					</div>
					<br>

					<div class="form-group">
						{!! Form::label('group_id',trans('admin.group_id'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::select('group_id',App\Models\Group::pluck('group_name','id'), $users->group_id ,['class'=>'form-control','placeholder'=>trans('admin.group_id')]) !!}
						</div>
					</div>
					<br>
					<div class="form-group">
						{!! Form::label('level',trans('admin.level'),['class'=>'col-md-3 control-label']) !!}
						<div class="col-md-9">
							{!! Form::select('level',['dr'=>trans('admin.dr'),'accountant'=>trans('admin.accountant'),'recep'=>trans('admin.recep')],$users->level,['class'=>'form-control','placeholder'=>trans('admin.level')]) !!}
						</div>
					</div>
					<br>

					    <div class="clearfix"></div>
				    <h2>{{ trans('admin.dep_id') }}</h2>
                    <div id="jstree"></div>
                    <input type="hidden" name="dep_id" class="dep_id" value="{{ $users->dep_id }}">
                    <div class="clearfix"></div>


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
