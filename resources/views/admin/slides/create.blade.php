@extends('admin.index')
		@section('content')
	<!-- BEGIN SAMPLE FORM PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
<i class="fa fa-reorder"></i> {{ $title }}
			</div>
		</div>
	<div class="portlet-body form">
{!! Form::open(['route'=>'slides.store','files'=>true]) !!}
<div class="form-body">

<div class="form-group">
<label>{{ trans('admin.title') }}</label>
<input name="title" type="text" placeholder="{{ trans('admin.title') }}" class="form-control" value="{{ old('title') }}" placeholder="{{ trans('admin.title') }}">
</div>

<div class="form-group">
<label>{{ trans('admin.url') }}</label>
<input name="url" type="url" placeholder="{{ trans('admin.url') }}" class="form-control" value="{{ old('url') }}" placeholder="{{ trans('admin.url') }}">
</div>
 
 
<div class="form-group">
<label>مفعل</label>
<input name="active" type="hidden"  class="form-control" value="0">
<input name="active" type="checkbox"  class="form-control" value="1" >
</div>

<div class="form-group">
<label>{{ trans('admin.photo') }}</label>
<input name="photo" type="file" placeholder="{{ trans('admin.photo') }}" class="form-control" value="{{ old('photo') }}" placeholder="{{ trans('admin.url') }}">
</div>
  
{!! Form::submit(trans('admin.add'),['class'=>'btn green']) !!}
</div>
			{!! Form::close() !!}
		</div>
	</div>
	<!-- END SAMPLE FORM PORTLET-->

@stop