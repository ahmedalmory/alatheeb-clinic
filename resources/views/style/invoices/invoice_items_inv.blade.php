<?php foreach ($product as $product) {
    $product = \App\Models\Product::query()->find($product->id);
    ?>
    <td>
        <input type="hidden" id="p_id" name="p_id[]" value="<?= $product->id ?>">
        <input type="hidden" id="p_cat" name="p_cat[]" value="<?= $product->cat_id ?>">
        <input type="hidden" id="p_name" name="p_name[]" value="<?= $product->p_name ?>">
        <input type="hidden" id="p_discount_amount" name="p_discount_amount[]" value="{{($product->p_price / 100 * $product->totalDiscountAmount())}}">
        {{category_name($product->cat_id)}}</td>
<td><?= $product->p_name ?></td>
<td width="20%">
    <input type="hidden" class="p_price form-control" id="p_price" name="p_price[]" value="<?= $product->p_price ?>">
    @if($product->totalDiscountAmount())
        <del>{{$product->p_price}}</del>
        <b>{{$product->p_price - ($product->p_price / 100 * $product->totalDiscountAmount()) }}</b>
    <br>
        <span id="discount_amount" class="btn btn-success btn-sm"> اجمالي خصم {{$product->totalDiscountAmount()}} %</span>
    @else

        <b>{{$product->p_price}}</b>
    @endif
</td>
<td>
<button type="button" class="btn btn-danger btm-xs deleteButton"><span class="fa fa-trash"></span></button></td>

<?php } ?>
<script>
    $(document).ready(function () {
        multInputs();
		$(".txt1 input").keyup(multInputs);
        function multInputs() {
            var mult = 0;
            var t_discount = 0;
            var $total = 0;
            var natio = $("#natio").val();
            var cash_hand = parseInt($("#cash_hand").val());
            var cash_card = parseInt($("#cash_card").val());
            if(cash_hand = ''){
                cash_hand =0;
            }
            if(cash_card = ''){
                cash_card =0;
            }
            // for each row:
            $("tr.txt1").each(function () {
                var $qty_price = parseInt($('.p_price', this).val());
                mult += $qty_price;
                t_discount += parseFloat($('#p_discount_amount', this).val());
                    // alert(mult);
            });
            mult -= t_discount;
            if (natio!=1 && parseInt('{{setting()->tax_enabled}}')){
  
                var tax_amount = mult / 100 * parseFloat('{{setting()->tax_rate}}');
                $("#t_total").html( mult + tax_amount);
                $("#t_tax_amount").html(tax_amount);
            }else{
                $("#t_total").html(mult);
            }

            $("#due").html((mult + tax_amount) - cash_hand - cash_card);
            $("#t_discount").html(t_discount);
        }
    $(function () {

        $(".deleteButton").click(function () {
            $(this).closest("tr").remove();
            multInputs();
        });
    });

    });

</script>
