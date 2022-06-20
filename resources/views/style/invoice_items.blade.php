<?php foreach ($product as $product) { ?>
    <td>
        <input type="hidden" id="p_id" name="p_id[]" value="<?= $product->id ?>">
        <input type="hidden" id="p_cat" name="p_cat[]" value="<?= $product->cat_id ?>">
        <input type="hidden" id="p_name" name="p_name[]" value="<?= $product->p_name ?>">

        {{category_name($product->cat_id)}}</td>
<td><?= $product->p_name ?></td>
<td width="20%">  <input type="text" class="form-control p_price" id="p_price" name="p_price[]" value="<?= $product->p_price ?>"></td>
<td>
<button type="button" class="btn btn-danger btm-xs deleteButton"><span class="fa fa-trash"></span></button></td>

<?php } ?>
<script>
    $(document).ready(function () {
        multInputs();
        $(".txt1 input").keyup(multInputs);
        function multInputs() {
            var mult = 0;
            var $total = 0;
            // for each row:
            $("tr.txt1").each(function () {
                var $qty_price = parseInt($('.p_price', this).val());
                var natio = $("#natio").val();
                    mult += $qty_price;
                    //alert(mult);
            if (natio!=1 && parseInt('{{setting()->tax_enabled}}')){
                var tax_amount = mult / 100 * parseFloat('{{setting()->tax_rate}}');
                $("#t_total").html(tax_amount + mult);
                $("#t_tax_amount").html(tax_amount);
            }else{
                $("#t_total").html(mult);
            }


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
