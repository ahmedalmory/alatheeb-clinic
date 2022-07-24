@extends('style.index')

@section('content')
    <h4>رواتب الموظفين</h4>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('admin.first_name') }}</th>
            <th scope="col">{{ __('admin.salary') }}</th>
            <th scope="col">{{ __('admin.rate') }}</th>
            <th scope="col">{{ __('admin.rate_active') }}</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                
          <tr>
            <th scope="row">{{ $loop->index+1 }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->salary }}</td>
            <td>{{ $user->rate }}%</td>
            <td>{{ $user->rate_active? __('admin.active'): __('admin.not_active') }}</td>
          </tr>
          @endforeach
          {{ $users->links() }}
        </tbody>
      </table>
@endsection
