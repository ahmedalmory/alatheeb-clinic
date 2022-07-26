@extends('admin.index')
@section('content')
@push('js')


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
					<a href="{{aurl('users')}}" class="btn btn-circle btn-icon-only btn-default"
						tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
						<i class="fa fa-list"></i>
					</a>
					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
						data-original-title="{{trans('admin.fullscreen')}}" title="{{trans('admin.fullscreen')}}">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="col-md-12">
					<form action="{{ route('products.update',$product) }}" method="POST">
						@csrf
						@method('PUT')
						<div class="row">
							<div class="col-md-3">
								التصنيف :
								<select class="form-control" id="cat_id" name='cat_id'>
									<option value="">اختر التصنيف</option>
									@foreach($categories AS $cat)
									<option {{ $product->cat_id==$cat->id?'selected':'' }} value="{{ $cat->id }}">{{ $cat->cat_name }}
									</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-3">
								اسم الخدمة :
								<input type="text" class="form-control" name="p_name" id="product_name" value="{{ $product->p_name }}"
									placeholder="اسم الخدمة">
							</div>
							<div class="col-md-3">
								سعر الخدمة :

								<input type="text" class="form-control" name="p_price" id="product_price"  value="{{ $product->p_price }}"
									placeholder="سعر الخدمة">
							</div>
							<div class="col-md-3">
								</br>
								<button type="submit" class="btn btn-success">حفظ</button>
							</div>

						</div>
					</form>

				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
@stop