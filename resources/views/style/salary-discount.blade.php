@extends('style.index')

@section('content')

    <h4>خصم راتب</h4>
    <div class="">
      <form class="row row-gap-24" action="{{ route('salary_discount_post') }}" method="post">
        @csrf
        <div class="col-xs-12 col-md-4">
        <label>{{ __('admin.user_id') }}</label>
        <select class="form-control" name="user_id" id="">
          @foreach ($users as $user)
            <option {{ request('user')==$user->id?'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-xs-12 col-md-4">
        <label for="">{{ __('admin.amount') }}</label>
        <input class="form-control" type="number" name="amount">
      </div>
      <div class="col-xs-12 col-md-4">
        <label for="">{{ __('admin.date') }}</label>
        <input class="form-control" type="date" name="date">
      </div>
      <div class="col-xs-12 col-md-12">
        <label for="">{{ __('admin.reason') }}</label>
        <textarea class="form-control" rows="5" name="reason"></textarea>
      </div>
      <div class="col-xs-12 d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">{{ __('admin.add') }}</button>
      </div>
      </form>
    </div>
@endsection
