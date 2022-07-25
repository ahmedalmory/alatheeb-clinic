@extends('style.index')

@section('content')
    <h4>رواتب الموظفين</h4>
    <div class="">
      <div class="">{{ __('admin.total_employee_salary') }} {{ $users->sum('salary') }}</div>
      <div class="">{{ __('admin.salaries_paid') }}{{ App\Models\User::TotalMonthlyIncome() }}</div>
      <div class="">{{ __('admin.financial_discount') }}  {{ $discounts }}</div>
    </div>
    <div class="">
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
    <a class="btn btn-primary" href="{{ route('salary_discount') }}">{{ __('admin.add_discount') }}</a>
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
            <th scope="row">{{ $loop->index+1 }}</th>
            <th scope="row">{{ __('admin.month') }} {{ now()->format('m') }}</th>
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
@endsection
