@extends('style.index')
@section('content')
    <style>
{{--         aloooo ????  --}}
        .dt-buttons{
            margin: 10px 0 !important;
            width: 100% !important;
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
                        "url" => [url('/product/multi_delete')]
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
                        <div class="delete_done"><i class="fa fa-exclamation-triangle"></i> سيتم حذف الفواتير ايضا
                            للخدمات المختارة هل انت منتأكد من حذف <span id="count"></span> {{trans("admin.record")}} !
                        </div>
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
        <script>
            function add_product() {
                $("#addproduct").modal("show");
                $.ajax({
                    url: 'product_add',
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

            function edit_product(id) {
                $("#editproduct").modal("show");
                $.ajax({
                    url: 'product_edit',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        id: id
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

            function save_product() {
                var cat_id = $("#cat_id").val();
                var product_name = $("#product_name").val();
                var product_price = $("#product_price").val();
                if (cat_id == '') {
                    $.notify("فضلا اختر التصنيف", 'error');
                    $("#cat_id").focus();
                } else if (product_name == '') {
                    $.notify("فضلا اكتب اسم الخدمة", 'error');
                    $("#product_name").focus();
                } else if (product_price == '') {
                    $.notify("فضلا اكتب سعر الخدمة", 'error');
                    $("#product_price").focus();
                } else {
                    $.ajax({
                        url: 'save_product',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            product_name: product_name, product_price: product_price, cat_id: cat_id
                        },
                        type: 'POST',
                        cache: false,
                        dataType: 'json',
                        success: function (data) {
                            $.notify(data.text, data.cls);
                            $("#product_name").val('');
                            $("#product_price").val('');
                            $("#product_name").focus();
                        },
                        error: function (xhr) {
                            alert('error');
                        }
                    });
                }
            };

            function update_product(id) {
                var cat_id = $("#cat_id").val();
                var product_name = $("#product_name").val();
                var product_price = $("#product_price").val();
                if (cat_id == '') {
                    $.notify("فضلا اختر التصنيف", 'error');
                    $("#cat_id").focus();
                } else if (product_name == '') {
                    $.notify("فضلا اكتب اسم الخدمة", 'error');
                    $("#product_name").focus();
                } else if (product_price == '') {
                    $.notify("فضلا اكتب سعر الخدمة", 'error');
                    $("#product_price").focus();
                } else {
                    $.ajax({
                        url: 'update_product',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            id: id, product_name: product_name, product_price: product_price, cat_id: cat_id
                        },
                        type: 'POST',
                        cache: false,
                        dataType: 'json',
                        success: function (data) {
                            $.notify(data.text, data.cls);

                        },
                        error: function (xhr) {
                            alert('error');
                        }
                    });
                }
            };
        </script>
    @endpush
    {!! Form::close() !!}
@stop

{!! modelBox("addproduct","اضافة الخدمة","box_add","status_add","add_product") !!}
{!! modelBox("editproduct","تغير الخدمة","box_edit","status_edit","edit_product") !!}
