<a href="{{ url('/invoice_print/'.$id)}}" target="_blank" style="display: inline;"  class="btn btn-sm btn-success" title="{{trans('admin.show')}}"><i class="fa fa-print"></i> </a>
@user_can("invoices-update")
<a href="{{ url('/tasdeed_invoice/'.$id)}}"  style="display: inline;" class="btn btn-sm btn-info" title="{{trans('admin.edit')}}"><i class="fa fa-pencil-square-o"></i> </a>
@end_user_can
{{--<div class="modal fade" id="delete_record{{$id}}">--}}
{{--	<div class="modal-dialog">--}}
{{--		<div class="modal-content">--}}
{{--			<div class="modal-header">--}}
{{--				<button class="close" data-dismiss="modal">x</button>--}}
{{--				<h4 class="modal-title">{{trans('admin.delete')}}؟</h4>--}}
{{--			</div>--}}
{{--			<div class="modal-body">--}}
{{--				<i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$id}}) ؟--}}
{{--			</div>--}}
{{--			<div class="modal-footer">--}}
{{--				{!! Form::open([--}}
{{--				'method' => 'DELETE',--}}
{{--				'route' => ['invoices.destroy', $id]--}}
{{--				]) !!}--}}
{{--				{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}--}}
{{--				<a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>--}}
{{--				{!! Form::close() !!}--}}
{{--			</div>--}}
{{--		</div>--}}
{{--	</div>--}}
{{--</div>--}}
