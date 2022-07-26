@extends('style.index')
@section('content')
{!! modelBox("box_add","addexpense_sub","اضافة مصرف الفرعي","status_add","add_expense_sub") !!}
{!! modelBox("box_edit","editexpense_sub","تغير مصرف الفرعي","status_edit","edit_expense_sub") !!}
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject bold uppercase font-dark">{{$title}}</span>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-responsivee">
					{!! Form::open([
					"method" => "post",
					"url" => [url('/expense_sub/multi_delete')]
					]) !!}
					{!! $dataTable->table(["class"=> "table table-striped table-bordered table-hover table-checkable dataTable no-footer"],true) !!}
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="multi_delete">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">x</button>
					<h4 class="modal-title">{{trans("admin.delete")}} </h4>
				</div>
				<div class="modal-body">
					<div class="delete_done"><i class="fa fa-exclamation-triangle"></i> {{trans("admin.ask-delete")}} <span id="count"></span> {{trans("admin.record")}} ! </div>
					<div class="check_delete">{{trans("admin.check-delete")}}</div>
				</div>
				<div class="modal-footer">
					{!! Form::submit(trans("admin.approval"), ["class" => "btn btn-danger delete_done"]) !!}
					<a class="btn btn-default" data-dismiss="modal">{{trans("admin.cancel")}}</a>
				</div>
			</div>
		</div>
	</div>
</div>
@push('js')
{!! $dataTable->scripts() !!}
@endpush
{!! Form::close() !!}
@stop
<script>
	function add_expense_sub(){
       $("#addexpense_sub").modal("show");
        $.ajax({
            url: 'expense_sub_add',
            data: {
                _token: '{!! csrf_token() !!}',
            },
            type: 'POST',
            cache: false,
            success: function (frm) {
                    $("#box_add").html(frm);
            },
            error: function (xhr) {
                alert('error');
            }
        });
  };

  	function edit_expense_sub(id){
       $("#editexpense_sub").modal("show");
        $.ajax({
            url: 'expense_sub_edit',
            data: {
                _token: '{!! csrf_token() !!}',
				id:id
            },
            type: 'POST',
            cache: false,
            success: function (frm) {
                    $("#box_edit").html(frm);
            },
            error: function (xhr) {
                alert('error');
            }
        });
  };

function save_expense_sub(){
	var exp_m_id = $("#exp_m_id").val();
	var exp_name = $("#exp_name").val();
	if(exp_m_id == ''){
	  $.notify("فضلا اختر مصرف الرئيسي",'error');
	  $("#exp_m_id").focus();
	}
	else if(exp_name == '') {
        $.notify("فضلا اكتب اسم مصرف الفرعي", 'error');
        $("#exp_name").focus();
    }
	else{
        $.ajax({
            url: 'save_expense_sub',
            data: {
                _token: '{!! csrf_token() !!}',
				exp_name:exp_name,exp_m_id:exp_m_id
            },
            type: 'POST',
            cache: false,
            dataType: 'json',
            success: function (data) {
            $.notify(data.text,data.cls);
                $("#exp_name").val('');
                $("#exp_name").focus();
            },
            error: function (xhr) {
                alert('error');
            }
        });
	}
  };
  function update_expense_sub(id){
	var exp_m_id = $("#exp_m_id").val();
	var exp_name = $("#exp_name").val();
	if(exp_m_id == ''){
	  $.notify("فضلا اختر مصرف الرئيسي",'error');
	  $("#exp_m_id").focus();
	}
	else if(exp_name == ''){
	  $.notify("فضلا اكتب اسم مصرف الفرعي",'error');
	  $("#exp_name").focus();
	}

	else{
        $.ajax({
            url: 'update_expense_sub',
            data: {
                _token: '{!! csrf_token() !!}',
				id:id,exp_name:exp_name,exp_m_id:exp_m_id
            },
            type: 'POST',
            cache: false,
            dataType: 'json',
            success: function (data) {
            $.notify(data.text,data.cls);

            },
            error: function (xhr) {
                alert('error');
            }
        });
	}
  };
</script>

