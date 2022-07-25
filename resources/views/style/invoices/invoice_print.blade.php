@include('style.layouts.header')
@push('js')
    <script>
       /* window.onload = function() {
            window.print();
            setTimeout(() => {
                window.top.close();
            }, 3000);*/

        // }
    </script>
@endpush


<div class="res-table">
{{-- <div class="" style="max-width:1100px;margin:auto;background-color:#fff;padding:20px">
        <?php foreach ($invoice_main as $inv_main) { ?>

        <table class="table" style="border:0 !important;">
            <tr class="selected-cc" style="border:0 !important;">
                <td width="33%" style="border:0 !important;">
                    <div class="" style="text-align: center;max-width:300px">
                        <img width="300" src="{{ it()->url(setting()->logo) }}">
                        <div class="">
                            {{ setting()->sitename }}<br>
                            {{ setting()->url }}<br>
                            <b>ارقام هاتف :</b>
                            {!!  str_replace('|','<br>',setting()->phones) !!}<br>
                            <b>بريد :</b>
                            {{ setting()->email }}<br>
                            @if (setting()->tax_enabled)
                            <b>الرقم الضريبي :</b>
                            {{ setting()->tax_id }}<br>
                            @endif
                        </div>
                    </div>
                </td>
                <td width="33%" style="border:0 !important;">
                    <h3 class="text-center font-weight-bold" style="font-weight:bold">Tax Invoice</h3>
                    <h3 class="text-center font-weight-bold" style="font-weight:bold">فاتورة ضريبية</h3>
                </td>
                <td width="33%" style="border:0 !important;">
                    <div class=""
                         style="display: flex;align-items: center;justify-content:flex-end;max-widh:150px;margin:auto">
                        {!! $qrCode !!}
                    </div>
                </td>
            </tr>
        </table>
        <div class="" style="display:flex">

            <table class="table">

                <tr>
                    <th style="border:0; width:15%;white-space:nowrap">
                        اسم المريض
                    </th>
                    <td style="border:0">{{patient_name($inv_main->patient_id)}}
                    </td>
                </tr>
                <tr>
                    <th style="border:0; width:15%;white-space:nowrap">رقم ملفه</th>
                    <td style="border:0"><?= $inv_main->patient_id ?></td>
                </tr>
                <tr>
                    <th style="border:0; width:15%;white-space:nowrap">الطبيب المعالج</th>
                    <td style="border:0">{{doctor_name($inv_main->doc_id)}}</td>
                </tr>
                <tr>
                    <th style="border:0; width:15%;white-space:nowrap">الفتره</th>
                    <td style="border:0">
                        {{ trans('admin.'.$inv_main->period) }}
                    </td>
                </tr>

            </table>
            <table>
                <tr>
                    <td>
                        <div class="" style="float:left">
                            <div class="" style="margin-bottom:10px">
                                <span style="width:120px;display:inline-block">فاتورة رقم :</span>
                                <input type="text" name="" value="<?= $inv_main->id ?>"
                                       style="border: 1px solid #ccc;background-color:transparent;padding:5px">
                            </div>
                            <div class="">
                                <span style="width:120px;display:inline-block">التاريخ:</span>
                                <input type="text" name="" value="<?= $inv_main->in_day ?>"
                                       style="border: 1px solid #ccc;background-color:transparent;padding:5px">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>


        <table class="table ">
            <tr>
                <div class="">
                    <table class="table table-bordered">
                        <tr style="background-color:#000 !important; color:#fff !important; -webkit-color-adjust: exact!important; color-adjust: exact!important; -webkit-print-color-adjust: exact!important; print-color-adjust: exact!important;">
                            <th style="width:20%">
                                التصنيف
                                <br>
                                category
                            </th>
                            <th style="width:20%">
                                الخدمة
                                <br>
                                services
                            </th>
                            <th style="width:20%">
                                السعر
                                <br>
                                price
                            </th>
                            <th style="width:20%">
                                الدفع
                                <br>
                                pay
                            </th>

                        </tr>
                        <?php foreach ($invoice_detail as $inv_detail) { ?>
                        <tr>
                            <td>{{category_name($inv_detail->p_cat)}}</td>
                            <td><?= $inv_detail->p_name ?></td>
                            <td><?= $inv_detail->p_price ?></td>
                            <td><?= $inv_main->pay_at ?></td>

                        </tr>
                        <?php } ?>
                    </table>


                    <table class="table table-bordered" style="margin-right:auto;max-width:400px">
                        <tr>
                            <th>حالة الفاتورة</th>
                            <td style="min-width:150px">{{ trans('admin.'.$inv_main->invoice_status) }}</td>
                        </tr>
                        <tr>
                            <th>المدفوع كاش</th>
                            <td style="min-width:150px"><?= $inv_main->paid_cash ?></td>
                        </tr>
                        <tr>
                            <th>المدفوع شبكة</th>
                            <td style="min-width:150px"><?= $inv_main->paid_card ?></td>
                        </tr>
                        <tr>
                            <th>المبلغ المتبقي</th>
                            <td style="min-width:150px"><?= $inv_main->due ?></td>
                        </tr>
                        @if ($inv_main->tax_amount)
                            <tr>
                                <th>اجمالي الضريبة</th>
                                <td style="min-width:150px"><?= $inv_main->tax_amount ?></td>
                            </tr>
                        @endif
                        <tr>
                            <th>المبلغ الالإجمالي</th>
                            <td style="min-width:150px"><?= $inv_main->total_amount ?></td>
                        </tr>
                    </table>

                </div>
            </tr>
        </table>
        <?php } ?>
    </div> --}}
    <?php foreach ($invoice_main as $inv_main) { ?>
<section>
    <div dir="ltr" class="main-head">
        <img width="300" src="{{ it()->url(setting()->logo) }}">
        <div class="head">
            <h1 class="ar">{{ setting()->sitename }}</h1>
            <h1><span>{{ setting()->sitename }}</span></h1>
        </div>
    </div>
    <table>
        <tr>
            <td colspan="6">
                <div>
                    <span class="rig"><strong>أسم المريض</strong>:
                        {{ patient_name($inv_main->patient_id) }}</span>
                    <span dir="ltr" class="lef"><strong>Patinet Nam</strong>:{{ patient_name($inv_main->patient_id) }}</span>
                </div>
            </td>
            <td colspan="2">{{nationality_name(\App\Models\Patient::findOrFail($inv_main->patient_id)->nationality)}}</td>
            <td colspan="1">
                <span class="rig"><strong>رقم الملف</strong></span>
                <span class="cen">{{$inv_main->patient_id}}</span>
                <span dir="ltr" class="lef"><strong>File.No</strong></span>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <span class="rig"><strong>أسم الطبيب</strong></span>
                <span>دكتور {{doctor_name($inv_main->doc_id)}}</span>
                <span dir="ltr" class="lef"><strong>Dr.Name</strong></span>
            </td>
            <td colspan="4">
                <span class="rig"><strong>العيادة</strong></span>
                <span>{{clinic_name($inv_main->dep_id)}}</span>
                <span dir="ltr" class="lef"><strong>Clinic</strong></span>
            </td>
            <td colspan="3">
                <span class="rig"><strong>رقم الفاتورة</strong></span>
                <span class="cen">{{$inv_main->id}}</span>
                <span dir="ltr" class="lef"><strong>Invoice. No.</strong></span>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <span class="rig"><strong>شركة التأمين</strong></span>
                <span dir="ltr" class="lef"><strong>co.Name</strong></span>
            </td>
            <td colspan="4">
                <span class="rig"><strong>الرقم الضريبي</strong></span>
                <span class="cen">{{ setting()->tax_id }}</span>
                <span class="lef" dir="ltr"><strong>Tax No.</strong></span>
            </td>
        </tr>

        <tr>
            <th colspan="3">أسم الخدمة<br />Service Name</th>
            <th>السعر<br />price</th>
            <th>العدد<br />Count</th>
            <th>الإجمالي<br />Total</th>
            <th>#الخصم<br />#Discount</th>
            <th>تحمل التأمين<br />Insuranee</th>
            <th colspan="1">%الضريبة<br />%VAT</th>
        </tr>
        @foreach ($invoice_detail as $inv_detail)
        <tr>
            <td colspan="3" dir="ltr">
                {{$inv_detail->p_name}}
            </td>
            <td>{{$inv_detail->p_price}}</td>
            <td>1</td>
            <td>{{$inv_detail->p_price}}</td>
            <td>0.00</td>
            <td>0.00</td>
            <td colspan="1">{{setting()->tax_rate}}</td>
        </tr>
        @endforeach
        <tr height="60px">
            <td class="hidd-1" colspan="2"></td>
            <td class="hidd-2" colspan="3"></td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="rig pir-r"><strong>المبلغ قبل الضريبة</strong></span>
                <span class="cen">{{$inv_main->total_amount-$inv_main->tax_amount}}</span>
                <span dir="ltr pir-l" class="lef"><strong>ِAmount</strong></span>
            </td>
            <td colspan="4">
                <span class="rig"><strong>التاريخ</strong></span>
                <span dir="ltr">{{$inv_main->in_day}}</span>
                <span dir="ltr" class="lef"><strong>ِData</strong></span>
            </td>
            <td rowspan="2" colspan="2">
                <span class="rig"><strong>ملاحظة</strong></span>
                <span dir="ltr" class="lef"><strong>{{$inv_main->comments}}</strong></span>
            </td>
            <td rowspan="5">{!! $qrCode !!}</td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="rig pir-r"><strong>أجمالي الخصم</strong></span>
                <span class="cen">{{ $inv_main->discount }}</span>
                <span dir="ltr pir-l" class="lef"><strong>Discount</strong></span>
            </td>
            <td rowspan="2">
                <strong>المدفوع-Paid</strong><br />{{$inv_main->paid_cash + $inv_main->paid_card}}
            </td>
            <td rowspan="2" colspan="2">
                <strong>نقدي-Cash</strong><br />{{$inv_main->paid_cash}}
            </td>
            <td rowspan="2"><strong>صراف-Atm</strong><br />{{$inv_main->paid_card}}</td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="rig pir-r"><strong>الصافي قبل الضريبة</strong></span>
                <span class="cen pir-l">{{$inv_main->total_amount-$inv_main->tax_amount}}</span>
                <span dir="ltr" class="lef"><strong>Total</strong></span>
            </td>
            <td colspan="2">
                <span class="rig"><strong>التوقيع</strong></span>
                <span dir="ltr" class="lef"><strong>Sing.</strong></span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="rig pir-r"><strong>قيمة الضريبة المضافة</strong></span>
                <span class="cen pir-l">{{$inv_main->tax_amount}}</span>
                <span dir="ltr" class="lef"><strong>VAT</strong></span>
            </td>
            <td rowspan="2" colspan="2">
                <strong>تحمل التأمين .Ins</strong><br />0.00
            </td>
            <td rowspan="2" colspan="2">
                <strong>المتبقي-Remain</strong><br />{{$inv_main->due}}
            </td>
            <td colspan="2">
                <span class="rig"><strong>هويةالمريض</strong></span>
                <span>{{\App\Models\Patient::findOrFail($inv_main->patient_id)->civil}}</span>
                <span dir="ltr" class="lef"><strong>Id</strong></span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="rig pir-r"><strong>المبلغ بعد الضريبة</strong></span>
                <span class="cen">{{$inv_main->total_amount}}</span>
                <span dir="ltr pir-l" class="lef"><strong>NET</strong></span>
            </td>
            <td colspan="2">
                <div>
                    <span class="rig"><strong>الموظف</strong></span>
                    <span dir="ltr" class="lef"><strong>User</strong> {{auth()->user()->name}}</span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="9">
                العنوان:{{setting()->address}}
                    رقم المبني:{{setting()->build_num}}
                    رقم وحدة:{{setting()->unit_num}}
                    الرمز البريدي:{{setting()->postal_code}}
                    الرقم الاضافي:{{setting()->extra_number}}
            </td>
        </tr>
    </table>
    <div dir="ltr" class="text">
        <span>{{setting()->sitename}}</span>
        <span>1/1</span>
        <span>Prinetd Count:{{$inv_main->id}}</span>
        <span>User:{{auth()->user()->name}}</span>
        <span>Printing Data:{{now()}}</span>
    </div>
    <a class="print" href="javascript:print()">طباعة</a>
</section>
</div>
<?php } ?>
@include('style.layouts.footer')
