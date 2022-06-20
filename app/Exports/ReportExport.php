<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{
    public function view(): View
    {
        return view('style.exports.report', [
            'invoices' => \App\Model\invoice_main::query()
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
        ->get()
        ]);
    }
}
