@user_can("categories-update")
<a  onclick="edit_category(<?php echo($id); ?>);" class="btn btn-info btn-sm">
<i class="fa fa-pencil-square-o"></i> {{trans('admin.edit')}}</a>
@end_user_can
@user_can("categories-delete")
<form id="delete{{$id}}" action="{{url('tasnefat/'.$id)}}" method="post">
    @csrf
    @method('DELETE')
</form>
<button class="btn btn-danger btn-sm" form="delete{{$id}}">حذف</button>
@end_user_can
