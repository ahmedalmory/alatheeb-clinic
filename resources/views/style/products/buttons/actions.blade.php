@user_can("products-update")
<a  onclick="edit_product(<?php echo($id); ?>);" class="btn btn-info btn-sm">
<i class="fa fa-pencil-square-o"></i> {{trans('admin.edit')}}
</a>
@end_user_can
@user_can("specials-general_reports")
<a  href="{{url('report?product_id='.$id)}}" class="btn btn-primary btn-sm">
<i class="fa fa-eye"></i> تقرير مالي
</a>
@end_user_can
