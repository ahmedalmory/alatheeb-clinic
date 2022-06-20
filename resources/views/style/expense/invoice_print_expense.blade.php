@include('style.layouts.header')
@section('content')
    @push('js')
    <script>
        window.onload = function () {
            window.print();
            window.top.close();

        }
    </script>

    <table class="table table-bordered table-hover table-striped">
        <tr>
            <td width="33%">
                {{ setting()->sitename }}<br>
                {{ setting()->url }}<br>
                {{ str_replace('|','-',setting()->phones) }}
            </td>
            <td width="33%">
                <center>
                    <img src="{{ asset('images/'.setting()->logo) }}" alt="">


                </center>
            </td>
            <td width="33%" valign="middle">

            </td>
        </tr>
    </table>

    <?php foreach ($expense_main as $exp_main) { ?>
    <table class="table">
        <tr>
            <th>
                رقم الحركة :
<?=$exp_main->id;?>
            </th>
            <th>
                تاريخ  الحركة :
                <?=$exp_main->in_day;?>
            </th>
        </tr>

    </table>
    <table class="table table-bordered">

        <tr>

                <table class="table table-bordered">
                    <tr>

                        <th>المصروف الرئيسي</th>
                        <th>المصروف الفرعي</th>
                        <th>المبلغ</th>
                    </tr>
                    <?php foreach ($expense_detail as $exp_detail) { ?>
                    <tr>
                        <td>{{exp_main_name($exp_detail->exp_m_id)}}</td>
                        <td><?=$exp_detail->exp_s_name;?></td>
                        <td><?=$exp_detail->amount;?></td>

                    </tr>
        <?php } ?>
                    <tr>
                        <td colspan="2">المبلغ الالإجمالي</td>
                        <td><?=$exp_main->total_amount;?></td>

                    </tr>
                </table>

        </tr>
    </table>
    <?php } ?>
    @yield('content')
    @include('style.layouts.footer')
