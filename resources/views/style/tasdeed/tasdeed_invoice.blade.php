@extends('style.index')
@section('content')
@push('js')
    <script>
    function get_doctors(){
    var id = $("#dep_id").val();
    $.ajax({
    url: 'get_doctors',
    data:{
    _token: '{!! csrf_token() !!}',
    id:id
    },
    type: 'POST',
    cache:false,
    success: function(frm){
    $("#doctors").html(frm);
    },
    error: function(xhr){
    alert(xhr.status+' '+xhr.statusText);
    }
    });
    };
    function add_item_invoice(){
        var id = $("#product_id").val();
        $.ajax({
            url: '../invoice_items_inv',
            data:{
                _token: '{!! csrf_token() !!}',
                id:id
            },
            type: 'POST',
            cache:false,
            success: function(frm){
                $("#msg").append($("<tr class='txt1' table-condensed>").html(frm));
            },
            error: function(xhr){
                alert(xhr.status+' '+xhr.statusText);
            }
        });

    };
    function get_products(){
        var id = $("#cat_id").val();
        $.ajax({
            url: '../get_products',
            data:{
                _token: '{!! csrf_token() !!}',
                id:id
            },
            type: 'POST',
            cache:false,
            success: function(frm){
                $("#product_id").html(frm);
            },
            error: function(xhr){
                alert(xhr.status+' '+xhr.statusText);
            }
        });
    };
    function get_patient(){
        var id = $("#pat_id").val();
        $.ajax({
            url: 'get_patient_detail_invoice',
            data:{
                _token: '{!! csrf_token() !!}',
                id:id
            },
            type: 'POST',
            cache:false,
            success: function(frm){
                if(frm == 'no'){
                    $("#pat_id").focus;
                    $.notify("رقم ملف المريض غير مسجل",'warn');
                    $("#pat_name").val('');
                    $("#pat_mobile").val('');
                }else {
                    $("#pat_detail").html(frm);
                    $("#cat_id").focus;
                }
            },
            error: function(xhr){
                alert(xhr.status+' '+xhr.statusText);
            }
        });

    };
function get_due(){
    var cash_hand = $("#cash_hand").val();
    var cash_card = $("#cash_card").val();
    var t_toal = parseInt($("#t_total").html());
    $("#due").html(t_toal - cash_hand - cash_card );

}

    function update_invoice(invoice_id){
        var total_amount = $("#t_total").html();
       // alert(total_amount);
        var cash_hand = $("#cash_hand").val();
        var cash_card = $("#cash_card").val();
        var comments = $("#comments").val();
        var period = $("#period").val();
        var due = $("#due").html();
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

        if(period == ''){
            $.notify("فضلا اختر  الفترة",'error');
            $("#period").focus();
        }
        else {
            if (confirm('هل انت متاكد من اصدار الفاتورة ؟')) {
                $.ajax({
                    url: '../update_invoice',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        invoice_id: invoice_id, cash_hand: cash_hand, cash_card: cash_card, due: due,
                        comments: comments,period:period, p_id: p_id_array,total_amount:total_amount,
                        p_cat: p_cat_array,
                        p_name: p_name_array,
                        p_price: p_price_array
                    },
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                        $.notify(data.text, data.cls);
                        if (data.status == '1') {
                            $("#print_invoice").css("visibility", "visible");
                            $("#save_invoice").css("visibility", "hidden");
                            $("#print_invoice").prop("href", "../invoice_print/" + invoice_id);

                            // print_invoice(data.last_id);
                        }
                    },
                    error: function (xhr) {
                        alert(xhr.status + ' ' + xhr.statusText);
                    }
                });
            } else {
                // alert('false');
            }
        }
    };
    </script>
@endpush
<div class="datespage">
    <div class="title">اصدار فاتورة / تسديد الزيارة</div>
    <div class="content">
        <?php foreach ($invoice as $inv_main) { ?>
<div class="row">
	<div class="col-md-12">
        <div class="col-md-8">


    <div class="clearfix"></div>

        <div class="col-md-2">
           رقم ملف المريض
<input type="text" class="form-control" id="pat_id" name="pat_id" value="<?=$inv_main->patient_id;?>" disabled>
        </div>
            <div id="pat_detail">
                <?php foreach ($patient_detail as $pat) { ?>
        <div class="col-md-5">
            اسم المريض
            <input type="text" class="form-control" id="pat_name" name="pat_name" value="<?=$pat->first_name;?>" disabled>
        </div>
        <div class="col-md-3">
            رقم الجوال
            <input type="text" class="form-control" id="pat_mobile" name="pat_mobile" value="<?=$pat->mobile;?>" disabled>
        </div>
                    <div class="col-md-2">الفترة

                     <select id="period">
                         <option value="">اختر الفترة</option>
                         <option value="morning" {{ ( "morning" == $inv_main->period ) ? 'selected' : '' }}>الصباحية</option>
                         <option value="evening" {{ ( "evening" == $inv_main->period ) ? 'selected' : '' }}>المسائية</option>
                     </select>
                    </div>
            </div>
            <?php } ?>
    <div class="clearfix"></div>
        <div class="col-md-12">
            <br>
            <textarea placeholder="ملاحظات الفاتورة" id="comments" class="form-control"><?=$inv_main->comments;?></textarea>


        </div>

</div>
        <div class="col-md-4">
            <div class="col-md-5">
                       الصافي :
            </div>
            <div class="col-md-7">
             <center>    <span id="t_total"><?=$inv_main->total_amount;?></span></center>
            </div>

            <div class="col-md-5">
                المدفوع كاش :
            </div>
            <div class="col-md-7">
                       <input type="text" id="cash_hand"  value="<?=$inv_main->paid_cash;?>" onkeyup= "get_due();" class="form-control">
            </div>

            <div class="col-md-5">
المدفوع شبكه :
            </div>
            <div class="col-md-7">
                       <input type="text" id="cash_card" value="<?=$inv_main->paid_card;?>" onkeyup= "get_due();" class="form-control">
            </div>
            <div class="col-md-5">
                       المتبقي
            </div>
            <div class="col-md-7">
                   <center>    <span id="due"><?=$inv_main->due;?></span></center>
            </div>
<div class="col-md-6">
    <button class="btn btn-primary btn-block" style="visibility:visible;" id="save_invoice"  onclick="update_invoice(<?=$inv_main->id;?>);" >حفظ الفاتورة</button>
</div>
            <div class="col-md-6">
                <a class="btn btn-success btn-block"   target= "_blank" style="visibility:hidden;" id="print_invoice"  >طباعة </a>
            </div>
            <div class="col-md-12">
                <br>
                <a href="{{ url('create_invoice') }}" class="btn btn-primary btn-block"
                  style="margin:10px 0"
                 >فاتورة جديده</a>
            </div>
        </div>
    <div class="clearfix"></div>
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>اسم التصنيف</th>
                    <th>اسم الخدمة</th>
                    <th>السعر</th>
                </tr>
                </thead>
                <tbody id="msg">
                <?php foreach ($invoice_detail as $inv_detail) { ?>
<tr class="txt2">
    <td>{{category_name($inv_detail->p_cat)}}</td>
    <td><?=$inv_detail->p_name;?></td>
    <td width="20%">
        <input type="hidden" class="p_id form-control" name="p_id[]" value="<?=$inv_detail->p_id;?>" >
        <input type="hidden" class="p_name form-control" name="p_name[]" value="<?=$inv_detail->p_name;?>" >
        <input type="hidden" class="p_cat form-control" name="p_cat[]" value="<?=$inv_detail->p_cat;?>" >
        <input type="text" class="p_price form-control" name="p_price[]" value="<?=$inv_detail->p_price;?>" >
    </td>

</tr>
                <?php } ?>
                </tbody>
                <tfoot>


                </tfoot>
            </table>
        </div>
        </div>
			</div>
					</div>
</div>
</div>
<?php } ?>
<script>
    $(document).ready(function () {
        multInputs();
        $(".txt2 input").keyup(multInputs);
        /*function multInputs() {
            var mult = 0;
            var cash_hand =0;
            var cash_card = 0;
            var $total = 0;
            // for each row:
            $("tr.txt2").each(function () {
                var $qty_price = parseInt($('.p_price', this).val());
                mult += $qty_price;
                alert(mult);
                //$("#t_total").html(mult);
                var cash_hand = parseInt($("#cash_hand").val());
                var cash_card = parseInt($("#cash_card").val());
                if(cash_hand = ''){
                    cash_hand =0;
                }
                if(cash_card = ''){
                    cash_card =0;
                }
                $("#due").html(mult - cash_hand - cash_card);

            })
        }*/
        $(function () {

            $(".deleteButton").click(function () {
                $(this).closest("tr").remove();
                multInputs();
            });
        });

    });

</script>

@stop
