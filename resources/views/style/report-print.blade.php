@extends('style.index')

@section('content')
    @php
        $invoices = \App\Models\invoice_main::query()
        ->join('invoice_detail','invoice_detail.invoice_main_id','=','invoice_main.id')
        ->where(function ($q){
            if (request()->product_id)
                $q->where('p_id',request()->product_id);
        })
        ->where(function($q){
            if (request()->date_from)
                $q->whereDate('in_day','>=',request()->date_from);
        })
        ->where(function($q){
            if (request()->date_to)
                $q->whereDate('in_day','<=',request()->date_to);
        })
        ->get();
    @endphp


    <script type="text/javascript">
        setTimeout(()=>{
          $("#myDiv").print();
        },1000)
    </script>




    <div id="myDiv" class="mt-5" style="margin-top:50px;background-color:#fff;padding:10px">

        <table class="table table-bordered">
            <thead>
              <tr>
                <td colspan="2">
                  <table class="table" style="border:0 !important;">
                     <tbody>
                        <tr class="selected-cc" style="border:0 !important;">
                           <td width="33%" style="border:0 !important;">
                              <div class="" style="text-align: center;max-width:300px">
                                 <div class="">
                                    مجمع الميدان الطبي<br>
                                    <!-- http://ca.midan-c.com -->
                                    02145454-02145454-058458787
                                 </div>
                              </div>
                           </td>
                           <td width="33%" style="border:0 !important;">
                              <div class="text-center">
                                 <img style="width:100px;margin:auto" src="{{ it()->url(setting()->logo) }}">
                              </div>
                              <h5 class="text-center font-weight-bold" style="font-weight:bold;">print  <br> طباعة  </h5>

                           </td>
                           <td width="33%" style="border:0 !important;">
                              <div class="" style="text-align: center;max-width:300px;margin-bottom:5px">
                                 <div class="">
                                    Al-Maidan Medical Complex<br>
                                    <!-- http://ca.midan-c.com -->
                                    02145454-02145454-058458787
                                 </div>
                              </div>
                              <div class="" style="display: flex;align-items: center;justify-content:center;max-widh:150px;margin:auto">
                                 <!--?xml version="1.0" encoding="UTF-8"?-->

                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                </td>
              </tr>
            </thead>
            <tbody>
            <tr>
                <td style="width:200px;background-color:#36c6d3;color:#fff">نقدا</td>
                <td style="padding:10px">{{$invoices->sum('paid_cash')}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#36c6d3;color:#fff">شبكة</td>
                <td style="padding:10px">{{$invoices->sum('paid_card')}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#36c6d3;color:#fff">المتبقي</td>
                <td style="padding:10px">{{$invoices->sum('due')}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#36c6d3;color:#fff">بدون ضريبة</td>
                <td style="padding:10px">{{$invoices->sum(function ($item){ return ($item->tax_amount ? ($item->total_amount - $item->tax_amount) : $item->total_amount); })}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#36c6d3;color:#fff">الإجمالى مع الضريبة</td>
                <td style="padding:10px">{{$invoices->sum('total_amount')}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#36c6d3;color:#fff">اجمالي الضريبة</td>
                <td style="padding:10px">{{$invoices->sum('tax_amount')}}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
