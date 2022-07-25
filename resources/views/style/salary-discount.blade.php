@extends('style.index')

@section('content')

    <h4>خصم راتب</h4>
    <div class="">
      <form action="{{ route('salary_discount_post') }}" method="post">
        @csrf
        <div class="">
        <label>{{ __('admin.user_id') }}</label>
        <select name="user_id" id="">
          @foreach ($users as $user)
            <option {{ request('user')==$user->id?'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="">
        <label for="">{{ __('admin.amount') }}</label>
        <input type="number" name="amount">
      </div>
      <div class="">
        <label for="">{{ __('admin.date') }}</label>
        <input type="date" name="date">
      </div>
      <div class="">
        <label for="">{{ __('admin.reason') }}</label>
        <textarea name="reason"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">{{ __('admin.add') }}</button>
      </form>
    </div>
@endsection
