<?php

namespace App\Http\Controllers\Doctor;

use App\DataTables\InvoicesDataTable;
use App\Http\Controllers\Controller;
use App\Models\invoice_main;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = invoice_main::with(['new_patient','new_accountant','new_dr'])
            ->where(function ($q) {
                $q->where('doc_id', auth()->id());
                if(request('status')=='unpaid'){
                $q->where('due','<>',0);
                }
            })->orderBy('id', 'desc')->paginate(10);
        return view('doctor.invoices.index', ['invoices' => $invoices, 'title' => trans('admin.invoices')]);
    }
}
