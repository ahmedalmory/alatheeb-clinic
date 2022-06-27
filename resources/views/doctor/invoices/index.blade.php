@extends('doctor.layout.index')
@section('content')
<a href="{{ route('doctor.invoices') }}" class="btn btn-primary">كل الفواتير</a>
<a href="{{ route('doctor.invoices',['status'=>'unpaid']) }}" class="btn btn-primary">الفواتير الغير مسددة</a>
<table class="table">
	<thead>
		<tr>
			<th scope="col">رقم الفاتورة</th>
			<th scope="col">{{ trans('admin.patient_name') }}</th>
			<th scope="col">{{ trans('app.doctor') }}</th>
			<th scope="col">{{ _the('app.accountant') }}</th>
			<th scope="col">{{ trans('app.invoice_date') }}</th>
			<th scope="col">{{ _the('app.total') }}</th>
			<th scope="col">{{ trans('app.invoice_status') }}</th>
			<th scope="col">{{ trans('app.total_tax') }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($invoices as $invoice)
		<tr>
			<th scope="row">{{ $invoice->id }}</th>
			<td>{{ $invoice->new_patient->first_name }}</td>
			<td>{{ $invoice->new_dr->name }}</td>
			<td>{{ $invoice->new_accountant?->name }}</td>
			<td>{{ $invoice->in_day}}</td>
			<td>{{ $invoice->total_amount}}</td>
			<td>{{ $invoice->invoice_status ? __('admin.'.$invoice->invoice_status) : ''}}</td>
			<td>{{ $invoice->tax_amount}}</td>
		</tr>
		@endforeach


	</tbody>
</table>

@stop