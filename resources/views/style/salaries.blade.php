@extends('style.index')

@section('content')
<div class="d-flex align-items-center justify-content-between gap-3  mb-3">
    <h4 class="fw-bold">رواتب الموظفين</h4>
    <form action="{{ URL::current() }}">
        <label>{{ __('admin.user_id') }}</label>
        <select name="user" id="" onchange="submit()">
          <option value="">كل  الموظفين</option>
          @foreach ($users as $user)
            <option {{ request('user')==$user->id?'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </form>
</div>
<div class="d-flex align-items-center justify-content-between gap-3 mb-2">
    <div class="d-flex align-items-center justify-content-between gap-3">
    <div class=""><b>{{ __('admin.total_employee_salary') }} </b> {{ $users->sum('salary') }}</div>
    |
    <div class=""><b>{{ __('admin.salaries_paid') }} </b> {{ App\Models\User::TotalMonthlyIncome() }}</div>
    |
    <div class=""><b>{{ __('admin.financial_discount') }} </b>  {{ $discounts }}</div>
</div>
<a class="btn btn-primary btn-sm" href="{{ route('salary_discount') }}">{{ __('admin.add_discount') }}</a>
</div>


 <div class="datespage table-responsive mt-0 ">
 <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('admin.month') }}</th>
            <th scope="col">{{ __('admin.user_id') }}</th>
            <th scope="col">{{ __('admin.salary') }}</th>
            <th scope="col">{{ __('admin.discount') }}</th>
            <th scope="col">{{ __('admin.monthly_income') }}</th>
            <th scope="col">{{ __('admin.rate') }}</th>
            <th scope="col">{{ __('admin.total_with_rate') }}</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)

          <tr>
            <td scope="row">{{ $loop->index+1 }}</td>
            <td scope="row">{{ __('admin.month') }} {{ now()->format('m') }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->salary }}</td>
            <td>{{ $user->monthly_discounts }}</td>
            <td>{{ $user->monthly_income_from_invoices }}</td>
            <td>{{ $user->rate }}%</td>
            <td>{{ ($user->monthly_income_from_invoices +$user->salary )- $user->monthly_discounts }}</td>
          </tr>
          @endforeach
          {{ $users->links() }}
        </tbody>
      </table>
 </div>
@endsection
