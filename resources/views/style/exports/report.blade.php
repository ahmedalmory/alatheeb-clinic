<table class="table table-bordered">

            <tbody>
            <tr>
                <td style="width:200px;background-color:#36c6d3;color:#fff">{{__('app.cash')}}</td>
                <td style="padding:10px">{{$invoices->sum('paid_cash')}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#36c6d3;color:#fff">{{__('app.network')}}</td>
                <td style="padding:10px">{{$invoices->sum('paid_card')}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#36c6d3;color:#fff">{{__('app.okay')}}</td>
                <td style="padding:10px">{{$invoices->sum('due')}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#36c6d3;color:#fff"> {{__('app.without_tax')}}</td>
                <td style="padding:10px">{{$invoices->sum(function ($item){ return ($item->tax_amount ? ($item->total_amount - $item->tax_amount) : $item->total_amount); })}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#36c6d3;color:#fff">{{__('app.total_with_tax')}}</td>
                <td style="padding:10px">{{$invoices->sum('total_amount')}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#36c6d3;color:#fff">{{__('app.total_tax')}}</td>
                <td style="padding:10px">{{$invoices->sum('tax_amount')}}</td>
            </tr>
            </tbody>
        </table>