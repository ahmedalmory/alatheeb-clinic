<?php foreach ($exp_item as $product) { ?>
    <td>
        <input type="hidden" id="p_id" name="p_id[]" value="<?= $product->id ?>">
        <input type="hidden" id="p_cat" name="p_cat[]" value="<?= $product->exp_m_id ?>">
        <input type="hidden" id="p_name" name="p_name[]" value="<?= $product->exp_name ?>">
        <input type="hidden" id="p_price" name="p_price[]" value="<?= $exp_amount ?>">
        {{exp_main_name($product->exp_m_id)}}</td>
<td><?= $product->exp_name ?></td>
<td class="p_price"><?= $exp_amount ?></td>
<td>
<button type="button" class="btn btn-danger btm-xs deleteButton"><span class="fa fa-trash"></span></button></td>

<?php } ?>
<script>
    $(document).ready(function () {
        multInputs();
        function multInputs() {
            var mult = 0;
            var cash_hand =0;
            var cash_card = 0;
            var $total = 0;
            // for each row:
            $("tr.txt1").each(function () {
                var $qty_price = parseInt($('.p_price', this).html());
                    mult += $qty_price;
                    // alert(mult);
            $("#t_total").html(mult);
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
        }
    $(function () {

        $(".deleteButton").click(function () {
            $(this).closest("tr").remove();
            multInputs();
        });
    });

    });

</script>
