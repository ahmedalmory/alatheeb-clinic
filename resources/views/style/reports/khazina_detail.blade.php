<div class="clearfix"></div>
<div class="row">
    <div class="col-md-7">
    </div>
    <div class="col-md-1">
        <button type="button" class="" onclick="jQuery('.print_invoices').print();"><i class="fa fa-print"></i></button>
    </div>
        <div class="col-md-3">
        </div>
    <div class="col-md-1">
        <button type="button" class="" onclick="jQuery('.print_expense').print();"><i class="fa fa-print"></i></button>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-8 print_invoices">
<table class="np" style="width:100% !important;">
    <tr>
        <td width="40%"> {{ str_replace('|','-',setting()->phones) }} </td>
        <td width="50%"><h1>
    {{ setting()->sitename }}</h1>
        </td>
        <td width="20%"><img src="{{ it()->url(setting()->logo) }}" alt="" width="100px" height="80px"> </td>
    </tr>
</table>
        <table class="np" style="width:100% !important;">
    <tr>
        <td width="10%"> من تاريخ :</td> <td><?=$from_date;?></td><td>الي :</td><td><?=$to_date;?></td><td width="10%"> نوع الدفع:</td><td><?=get_pay_report($pay_at)?></td><td>.....</td><td>الفترة :</td><td><?=get_period_report($period)?></td>
    </tr>
    </table>


</table>
        <table border="1" style="background-color:white;text-align: center; " width="100%">

    <tr>
        <th colspan="8" style="text-align: center;">بيانات الفواتير</th>

    </tr>
    <tr>
        <th style="text-align: center;">
التاريخ
        </th>
        <th style="text-align: center;">
            رقم
        </th>
        <th style="text-align: center;">
            اسم الطبيب
        </th>
        <th style="text-align: center;">
اسم المريض        </th>
        <th style="text-align: center;">
الخدمة         </th>
        <th style="text-align: center;">
            الالإجمالي
        </th>
        <th style="text-align: center;">
            كاش
        </th>
        <th style="text-align: center;">
            شبكة
        </th>
        <th style="text-align: center;">
            المتبقي
        </th>

    </tr>

<?php $total_cash = 0; $total_card = 0;$total_due=0; $total_amount = 0; $count =0;
foreach($invoices as $inv) { $count ++;
    $total_amount += $inv->total_amount;
    $total_cash += $inv->paid_cash;
    $total_card += $inv->paid_card;
    $total_due += $inv->due;
    $items = \App\Model\invoice_detail::query()->where('invoice_main_id',$inv->id)->get();
    ?>

<tr>
    <td><?=$inv->in_day?></td>
    <td><?=$inv->id?></td>
    <td>{{doctor_name($inv->doc_id)}}</td>
    <td>{{patient_name($inv->patient_id)}}</td>
    <td>
        @foreach($items as $index => $item)
            @if($index > 0)
            <br>
            @endif
            {{$item->p_name}}
        @endforeach
    </td>
    <td><?=$inv->total_amount?></td>
    <td><?=$inv->paid_cash?></td>
    <td><?=$inv->paid_card?></td>
    <td><?=$inv->due?></td>
</tr>


<?php } ?>
            <tr>
                <td colspan="5">الاجــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــمالي</td>
<td> <?=$total_amount;?></td>
<td><?=$total_cash;?></td>
<td><?=$total_card;?></td>
<td> <?=$total_due;?></td>
            </tr>
</table>
</div>
<div class="col-md-4 print_expense">
    <table class="np" style="width:100% !important;">
        <tr>
            <td width="40%"> {{ str_replace('|','-',setting()->phones) }} </td>
            <td width="50%"><h1>
                    {{ setting()->sitename }}</h1>
            </td>
            <td width="20%"><img src="{{ it()->url(setting()->logo) }}" alt="" width="100px" height="80px"> </td>
        </tr>
    </table>
    <table class="np" style="width:100% !important;">
        <tr>
            <td width="10%"> من تاريخ :</td> <td><?=$from_date;?></td><td>الي :</td><td><?=$to_date;?></td>
        </tr>
    </table>
    <table border="1" style="background-color:white;text-align: center;  "width="100%">
        <tr>
            <th colspan="8" style="text-align: center;">بيانات المصاريف</th>

        </tr>
        <tr>
            <th  style="text-align: center;">
                التاريخ
            </th>
            <th  style="text-align: center;">
                رقم
            </th>
            <th  style="text-align: center;">
المبلغ            </th>
            <th  style="text-align: center;">
                ملاحظات
            </th>

        </tr>

        <?php
        $total_expense =0;$safi_khazina = 0; $count_exp =0;
        foreach($expenses as $exp) {
            $count_exp ++;
        $total_expense += $exp->total_amount;
            ?>

        <tr>
            <td><?=$exp->in_day?></td>
            <td><?=$exp->id?></td>
            <td><?=$exp->total_amount?></td>
            <td><?=$exp->comments?></td>
        </tr>


        <?php } ?>
        <tr>
            <td colspan="2">الاجـــــــــــــــمالي</td>
<td><?=$total_expense;?></td><td></td>
        </tr>
    </table>
</div>

</div>
<div class="popoverr" id="popoverr">
    <div class="header">
        الإجمالي
        <span class="closee" onclick="popoverr_hide();">x</span>
        <a class="print_btn" onclick="jQuery('.print_summary').print();"><i class="fa fa-print"></i></a>

    </div>
    <div id="popoverr_text" class="list print_summary">
        <table class="np" style="width:100% !important;">
            <tr>
                <td width="40%"> {{ str_replace('|','-',setting()->phones) }} </td>
                <td width="50%"><h1>
                        {{ setting()->sitename }}</h1>
                </td>
                <td width="20%"><img src="{{ it()->url(setting()->logo) }}" alt="" width="100px" height="80px"> </td>
            </tr>
        </table>
        <table class="np" style="width:100% !important;">
            <tr>
                <td width="10%"> من تاريخ :</td> <td><?=$from_date;?></td><td>الي :</td><td><?=$to_date;?></td><td>.....</td><td width="10%"> نوع الدفع:</td><td><?=get_pay_report($pay_at)?></td><td>.....</td><td>الفترة :</td><td><?=get_period_report($period)?></td>
            </tr>
        </table>
        <table border="1" style="background-color:white;text-align: center; " width="100%" class="">
            <br>
            <tr>
                <td>عددالفواتير</td>
                <td> <?=$count;?></td>
            </tr>
            <tr>
                <td>عدد فواتير المصروفات</td>
                <td> <?=$count_exp;?></td>
            </tr>
            <tr>
                <td>الإجمالي فواتير</td>
                <td> <?=$total_amount;?></td>
            </tr>
            <tr>
                <td>الإجمالي كاش</td>
                <td> <?=$total_cash;?></td>
            </tr>
            <tr>
                <td>الإجمالي شبكة</td>
                <td>  <?=$total_card;?></td>
            </tr>
            <tr>
                <td>الإجمالي متبقي</td>
                <td>  <?=$total_due;?></td>
            </tr>
            <tr>
                <td>الإجمالي مصروفات</td>
                <td>  <?=$total_expense;?></td>
            </tr>
            <tr>
                <td> صافي الخزينة</td>
                <td>  <?=$total_cash - $total_expense ; ?></td>
            </tr>
        </table></div>
</div>
<script>
    function popoverr_hide(){
        $('#popoverr').hide();
    }

</script>
<style>

    .popoverr{

        width:350px;
        height:250px;
        color:grey;
        background-color:#e3e9ec;
        z-index:55555;
        position:fixed;
        bottom:355px;
        left:20px;

    }

    .popoverr .header{
        border-radius:5px 5px 0px 0px;
        border-bottom:1px solid black;
        padding:6px;
        color:white;
        text-align:center;
        font-family: sans-serif;
        font-size:16px;
        font-weight:bolder;
        background-color:#354b72;
    }
    .popoverr .header .closee{
        float:right;
        color:lightgrey;
        cursor:hand;

    }
    .popoverr .header .print_btn{
        float:left;
        widh:50px;
        height: 50px;
        color:lightgrey;
        cursor:hand;

    }

    .popoverr .list{
        padding:0px 10px 0px 10px;
        color:black;
        text-align:center;
    }
    .np{
        display:none !important;
    }
    @media print{
        .np{
            display: block !important;

        }

    }
</style>
