@extends('style.index')
@section('content')
@push('js')
    <script>

    function add_item_invoice(){
        var id = $("#exp_sub_id").val();
        var exp_amount = $("#exp_amount").val();
        var exp_m_id = $("#exp_m_id").val();
        var exp_sub_id = $("#exp_sub_id").val();
        if (exp_m_id === '') {
            $.notify("فضلا اختر مصرف الرئيسي");
            $("#exp_m_id").focus();
        }
        else if (exp_sub_id === '') {
            $.notify("فضلا اختر مصرف الفرعي");
            $("#exp_sub_id").focus();
        }
       else if (exp_amount === '') {
            $.notify("فضلا اكتب مبلغ المصرف");
            $("#exp_amount").focus();
        }
       else {
            $.ajax({
                url: 'invoice_items_exp',
                data: {
                    _token: '{!! csrf_token() !!}',
                    id: id, exp_amount: exp_amount
                },
                type: 'POST',
                cache: false,
                success: function (frm) {
                    $("#msg").append($("<tr class='txt1' table-condensed>").html(frm));
                },
                error: function (xhr) {
                    alert(xhr.status + ' ' + xhr.statusText);
                }
            });
        }
    };
    function get_expense_sub(){
        var id = $("#exp_m_id").val();
        $.ajax({
            url: 'get_expense_sub',
            data:{
                _token: '{!! csrf_token() !!}',
                id:id
            },
            type: 'POST',
            cache:false,
            success: function(frm){
                $("#exp_sub_id").html(frm);
            },
            error: function(xhr){
                alert(xhr.status+' '+xhr.statusText);
            }
        });
    };


    function save_invoice_exp(){
        var t_total = $("#t_total").html();
        var comments = $("#comments").val();

        var p_id_array = new Array();
            $('input[name="p_id[]"]').each(function () {
                p_id_array.push($(this).val());
            });
        var p_cat_array = new Array();
        $('input[name="p_cat[]"]').each(function () {
            p_cat_array.push($(this).val());
        });
            var p_name_array = new Array();
            $('input[name="p_name[]"]').each(function () {
                p_name_array.push($(this).val());
            });
            var p_price_array = new Array();
            $('input[name="p_price[]"]').each(function () {
                p_price_array.push($(this).val());
            });

            $.ajax({
                url: 'save_invoice_exp',
                data: {
                    _token: '{!! csrf_token() !!}',
                  t_total: t_total,
                    p_id: p_id_array,
                    p_cat: p_cat_array,
                    p_name: p_name_array,
                    p_price: p_price_array,
                    comments: comments
                },
                type: 'POST',
                cache: false,
                dataType: 'json',
                success: function (data) {
                    $.notify(data.text, data.cls);
                    if(data.status == '1') {
                        $("#print_invoice").css("visibility", "visible");
                        $("#save_invoice").css("visibility", "hidden");
                        $("#print_invoice").prop("href", "invoice_print_expense/"+data.last_id);

                       // print_invoice(data.last_id);
                    }
                },
                error: function (xhr) {
                    alert(xhr.status + ' ' + xhr.statusText);
                }
            });

    };
    </script>
@endpush
<div class="datespage">
    <div class="title">اصدار فاتورة مصاريف</div>
    <div class="content">
<div class="row">
	<div class="col-md-12">
        <div class="col-md-8">
            <textarea placeholder="ملاحظات الفاتورة" id="comments" class="form-control"></textarea>


    <div class="clearfix"></div>


    <div class="clearfix"></div>
        <div class="col-md-3">
            المصروف الرئيسي :
            <select class="form-control" id="exp_m_id"  name="exp_m_id" onclick="get_expense_sub()">
                <option value="">اختر مصرف الرئيسي</option>
                @foreach($exp_main AS $exp_m)
                    <option value="{{ $exp_m->id }}">{{ $exp_m->exp_m_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            المصرف الفرعي :
            <select class="form-control" id="exp_sub_id">

            </select>

        </div>
            <div class="col-md-2">
                السعر :
<input type="text" class="form-control" id="exp_amount" name="exp_amount" >

            </div>
            <div class="col-md-2"> </br>

              <button class="btn btn-primary" onclick="add_item_invoice()">اضافة مصرف</button>
            </div>
</div>
        <div class="col-md-4">
            <div class="col-md-5">
                       الصافي :
            </div>
            <div class="col-md-7">
                <span id="t_total">0</span>
            </div>


<div class="col-md-12">
    <button class="btn btn-success btn-block" style="visibility:visible;" id="save_invoice"  onclick="save_invoice_exp();" >حفظ فاتورة المصاريف</button>
</div>
            <div class="col-md-12">
                <a class="btn btn-success btn-block"   target= "_blank" style="visibility:hidden;" id="print_invoice"  >طباعة </a>
            </div>
            <div class="col-md-12">
                <br>
                <a href="{{ url('create_expense') }}" class="btn btn-primary btn-block"  >فاتورة جديده</a>
            </div>
        </div>
    <div class="clearfix"></div>
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>اسم المصروف الرئيسي</th>
                    <th>اسم المصروف الفرعي</th>
                    <th>السعر</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="msg">

                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4">

                    </td>

                </tr>

                </tfoot>
            </table>
        </div>
        </div>
			</div>
					</div>
</div>
</div>

@stop
