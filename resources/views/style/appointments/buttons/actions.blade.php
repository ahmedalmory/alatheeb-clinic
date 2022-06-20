
<a href="{{ url('/appointments/'.$id)}}" style="display: inline;"  class="btn btn-sm btn-success" title="{{trans('admin.show')}}"><i class="fa fa-eye"></i> </a>
@user_can("appointments-update")
<a href="{{ url('/appointments/'.$id.'/edit')}}"  style="display: inline;" class="btn btn-sm btn-info" title="{{trans('admin.edit')}}"><i class="fa fa-pencil-square-o"></i> </a>
@end_user_can
@user_can("appointments-delete")
<a data-toggle="modal" data-target="#delete_record{{$id}}" href="#"  style="display: inline;"  class="btn btn-sm btn-danger" title="{{trans('admin.delete')}}"><i class="fa fa-trash"></i> </a>


<div class="modal fade" id="delete_record{{$id}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" data-dismiss="modal">x</button>
				<h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
			</div>
			<div class="modal-body">
				<i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$id}}) ؟
			</div>
			<div class="modal-footer">
				{!! Form::open([
				'method' => 'DELETE',
				'route' => ['appointments.destroy', $id]
				]) !!}
				{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
				<a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@end_user_can
