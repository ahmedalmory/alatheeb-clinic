@extends('style.index')
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption" style="    white-space: nowrap;">
					<span class="caption-subject bold uppercase font-dark">{{$title}}</span>
					<a  href="{{url('expense_sub')}}" class="btn btn-success" name="button" style="margin-right:10%"> الأقسام الفرعية</a>

				</div>
			</div>
			<div class="portlet-body">
				<div class="table-responsivee">
					{!! Form::open([
					"method" => "post",
					"url" => [url('/expense_main/multi_delete')]
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
	function add_expense_main(){
       $("#addexpense_main").modal("show");
        $.ajax({
            url: 'expense_main_add',
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

  	function edit_expense_main(id){
       $("#editexpense_main").modal("show");
        $.ajax({
            url: 'expense_main_edit',
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

function save_expense_main(){
	var exp_m_name = $("#exp_m_name").val();
	if(exp_m_name == ''){
	  $.notify("فضلا اكتب اسم المصرف الرئيسي",'error');
	  $("#exp_m_name").focus();
	}else{
        $.ajax({
            url: 'save_expense_main',
            data: {
                _token: '{!! csrf_token() !!}',
                exp_m_name:exp_m_name
            },
            type: 'POST',
            cache: false,
            dataType: 'json',
            success: function (data) {
            $.notify(data.text,data.cls);
                $("#exp_m_name").val('');
                $("#exp_m_name").focus();
            },
            error: function (xhr) {
                alert('error');
            }
        });
	}
  };
    function update_expense_main(id){
        var exp_m_name = $("#exp_m_name").val();
        if(exp_m_name == ''){
            $.notify("فضلا اكتب اسم مصرف الرئيسي",'error');
            $("#exp_m_name").focus();
        }else{
            $.ajax({
                url: 'update_expense_main',
                data: {
                    _token: '{!! csrf_token() !!}',
                   id:id,exp_m_name:exp_m_name
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
{!! modelBox("box_add","addexpense_main","اضافة مصاريف رئيسية","status_add","add_expense_main") !!}
{!! modelBox("box_edit","editexpense_main","تغير مصرف الرئيسية","status_edit","edit_expense_main") !!}
