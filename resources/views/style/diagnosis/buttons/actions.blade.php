@user_can
<a href="{{ url('/diagnosis/'.$id.'/edit')}}" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i> {{trans('admin.edit')}}</a>
@end_user_can
<a href="{{ url('/diagnosis/'.$id)}}"  class="btn btn-default btn-sm"><i class="fa fa-eye"></i> {{trans('admin.show')}}</a>
@user_can("diagnosis-delete")
<a data-toggle="modal" data-target="#delete_record{{$id}}" href="#"  class="btn btn-danger btn-sm">
<i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
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
				'route' => ['diagnosis.destroy', $id]
				]) !!}
				{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
				<a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@end_user_can
