@user_can("patients-update")
<a
    href="{{ url('/patients/'.$patient->id.'/edit')}}"
    class="btn btn-xs btn-info"
    ><i class="fa fa-pencil-square-o"></i> {{ trans("admin.edit") }}</a
>
@end_user_can
<a href="{{ url('/patients/'.$patient->id)}}" class="btn btn-xs btn-primary"
    ><i class="fa fa-eye"></i> {{ trans("admin.show") }}</a
>
@user_can("files-create")
<a href="{{url('/patients/'.$patient->id.'?data=files')}}" class="btn btn-xs btn-success"
    ><i class="fa fa-file"></i> {{ trans("admin.file_add") }}</a
>
@end_user_can
@user_can("specials-transfer_patients")
<a
    href="#"
    onclick="search_patient({{$patient->civil}})"
    class="btn btn-xs btn-primary"
    ><i class="fa fa-repeat"></i> {{ trans("admin.patient_transfer") }}</a
>
@end_user_can
@if($patient->status !== 'delete')
    @user_can("patients-delete")
    <a
    href="#"
    onclick="delete_patient({{$patient->id}}, 'open')"
    class="btn btn-xs btn-danger"
    ><i class="fa fa-trash"></i> {{ trans("admin.delete") }}</a
>
    @end_user_can

<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <textarea class="form-control" placeholder="سبب الحدف ..." id="reason"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="delete_patient({{$patient->id}}, 'delete')">حدف</button>
          <button type="button" class="btn btn-info" data-dismiss="modal">الغاء</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
@else
<p>
    <div class="alert alert-danger">تم حدف المريض بسبب : {{$patient->reason}}</div>
</p>
@endif

<script>
    function delete_patient(id, status) {
        if(status === 'open'){
            $('#deleteModal').modal()                      // initialized with defaults
        }else{

            var reason = document.getElementById("reason").value;

            $.ajax({
            url: `/patients/delete/${id}`,
            data:{
            _token: '{!! csrf_token() !!}',
            reason,
            },
            type: 'POST',
            cache:false,
                success: function(frm){
                    if(frm.ok){
                        $('#deleteModal').modal("hide");
                        $.notify(frm.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                },
                error: function(xhr){
                    console.log(xhr);
                }
            });
        }
    }
</script>
