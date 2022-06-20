@extends('admin.index')
		@section('content')
<a href="{{ url(aurl('/slides/create')) }}" class="btn green">{{ trans('admin.add') }}</a>
<div class="clearfix"></div>
<br />
<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-file"></i> {{ $title }}
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-responsive">
								<table class="table table-hover table-bordered">
								<thead>
								<tr>
									<th>{{ trans('admin.title') }}</th>
									<th>{{ trans('admin.url') }}</th>
									<th>الحالة</th>
									<th>{{ trans('admin.photo') }}</th>
									<th>{{ trans('admin.action') }}</th>
								</tr>
								</thead>
								<tbody>
								@foreach($slides as $slide)
								<tr>
									<td>{{ $slide->title }}</td>
									<td><a href="{{$slide->url}}" target="_blank">{{$slide->url}}</a></td>
									<td>{{ $slide->active ? 'مفعل' : 'غير مفعل' }}</td>
									<td><img src="{{ url('images/'.$slide->photo) }}" style="width:100px;height:100px;" /></td>
									<td>
									<a href="{{ url(aurl('/slides').'/'.$slide->id.'/edit') }}" title="{{ trans('admin.edit') }}" class="btn green"><i class="fa fa-edit"></i></a>
									{{-- <a href="#" class="btn red delrec" classform="deleteform{{ $slide->id }}" title="{{ trans('admin.delete') }}"><i class="fa fa-times"></i></a> --}}
									<form action="{{aurl('/slides').'/'.$slide->id}}" method="POST">
										@csrf
										@method('DELETE')
										<button class="btn red delrec"><i class="fa fa-times" title="{{ trans('admin.delete') }}"></i></button>
									</form>
									
									</td>
								</tr>
								@endforeach
								</tbody>
								</table>
								{!! $slides->render() !!}
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
@stop