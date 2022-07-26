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
      $(document).on('click','.print_btn', function() {
        console.log("hhh");
        $("#myDiv").print();
      })
    </script>
    <h2>{{trans('app.financial_report')}}</h2>
    @if(request()->product_id)
        <h3> للخدمة : {{\App\Models\Product::query()->find(request()->product_id)->p_name}}</h3>
        <a class="btn btn-primary" href="{{url('report')}}"> عرض تقرير لكل المنتجات </a>
    @endif
    <div class="mt-5 "
         style="
    display:flex;
    align-items: center;
    justify-content: space-between;
  "
    >
        <form class="">
            <input type="hidden" name="product_id" value="{{request()->product_id}}">
            <span>{{__('app.from')}}</span>
            <span style="display:inline-block;min-width:150px ">
              <input
              style="border: 1px solid #ddd; border-radius: 5px; padding: 2px 10px;"
               type="date" value="{{request()->date_from}}"
               name="date_from"> </span>
            <span>{{__('app.to')}}</span>
            <span style="display:inline-block;min-width:150px ">
              <input type="date" value="{{request()->date_to}}"
                     style="border: 1px solid #ddd; border-radius: 5px; padding: 2px 10px;"
                     name="date_to">
            </span>
            <span>
      <button class="btn btn-warning" type="submit" name="button">{{__('app.show')}} <i class="fas fa-eye"></i></button>
    </span>
        </form>
        <div class="">
            <a  href="{{route('report_print')}}"
                class=" btn btn-success" >
                {{__('app.print')}} <i class="fas fa-print"></i>
            </a>
            <a  href="{{route('export_report')}}"
                class=" btn btn-success" >
                {{__('admin.export_excel')}} <i class="fas fa-export"></i>
            </a>
        </div>
    </div>

    <div id="myDiv" class="mt-5  table-responsive" style="margin-top:50px">
        <table class="table table-bordered text-center">

            <tbody>
            <tr>
                <td style="width:200px;background-color:#8893B0;color:#fff">{{__('app.cash')}}</td>
                <td style="padding:10px  background-color:white; background-color:white;">{{$invoices->sum('paid_cash')}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#8893B0;color:#fff">{{__('app.network')}}</td>
                <td style="padding:10px  background-color:white; background-color:white;">{{$invoices->sum('paid_card')}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#8893B0;color:#fff">{{__('app.okay')}}</td>
                <td style="padding:10px  background-color:white; background-color:white;">{{$invoices->sum('due')}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#8893B0;color:#fff"> {{__('app.without_tax')}}</td>
                <td style="padding:10px  background-color:white; background-color:white;">{{$invoices->sum(function ($item){ return ($item->tax_amount ? ($item->total_amount - $item->tax_amount) : $item->total_amount); })}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#8893B0;color:#fff">{{__('app.total_with_tax')}}</td>
                <td style="padding:10px  background-color:white;  background-color:white;">{{$invoices->sum('total_amount')}}</td>
            </tr>
            <tr>
                <td style="width:200px;background-color:#8893B0;color:#fff">{{__('app.total_tax')}}</td>
                <td style="padding:10px  background-color:white;  background-color:white;">{{$invoices->sum('tax_amount')}}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
