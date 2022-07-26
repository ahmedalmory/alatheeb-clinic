@extends('style.index')
@section('content')

<style media="screen">
    form {
        display: inline-block;
    }
</style>
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
                    "url" => [url('/tasnefat/multi_delete')]
                    ]) !!}
                    {!! $dataTable->table(["class"=> "table table-striped table-bordered table-hover table-checkable
                    dataTable no-footer"],true) !!}
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
                    <div class="delete_done"><i class="fa fa-exclamation-triangle"></i> {{trans("admin.ask-delete")}}
                        <span id="count"></span> {{trans("admin.record")}} ! </div>
                    <div class="check_delete">{{trans("admin.check-delete")}}</div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit(trans("admin.approval"), ["class" => "btn btn-danger delete_done"]) !!}
                    <a class="btn btn-default" data-dismiss="modal">{{trans("admin.cancel")}}</a>
                </div>
            </div>
        </div>
    </div>
    {!! modelBox("box_add","addcategory","اضافة التصنيف","status_add","add_category") !!}
    {!! modelBox("box_edit","editcategory","تغير التصنيف","status_edit","edit_category") !!}
</div>
@push('js')
{!! $dataTable->scripts() !!}
@endpush
{!! Form::close() !!}
@stop
<script>
    function add_category(){
       $("#addcategory").modal("show");
        $.ajax({
            url: 'category_add',
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

  	function edit_category(id){
       $("#editcategory").modal("show");
        $.ajax({
            url: 'category_edit',
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

function save_category(){
	var cat_name = $("#cat_name").val();
	if(cat_name == ''){
	  $.notify("فضلا اكتب اسم التصنيف",'error');
	  $("#cat_name").focus();
	}else{
        $.ajax({
            url: 'save_category',
            data: {
                _token: '{!! csrf_token() !!}',
				cat_name:cat_name
            },
            type: 'POST',
            cache: false,
            dataType: 'json',
            success: function (data) {
            $.notify(data.text,data.cls);
                $("#cat_name").val('');
                $("#cat_name").focus();
            },
            error: function (xhr) {
                alert('error');
            }
        });
	}
  };
    function update_category(id){
        var cat_name = $("#cat_name").val();
        if(cat_name == ''){
            $.notify("فضلا اكتب اسم التصنيف",'error');
            $("#cat_name").focus();
        }else{
            $.ajax({
                url: 'update_category',
                data: {
                    _token: '{!! csrf_token() !!}',
                   id:id,cat_name:cat_name
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