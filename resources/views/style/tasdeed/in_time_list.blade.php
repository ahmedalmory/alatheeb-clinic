<div class="form-group">
  {!! Form::label('in_time',trans('admin.in_time'),['class'=>'col-md-3 control-label']) !!}
  <div class="input-group col-md-9">
    <center><h1>{{trans('admin.' . date('D', strtotime($day)))}}</h1></center>
@if(count($period_list) > 0)
    <div class="md-radio-list">
      @foreach($period_list as $period)
      <div class="md-radio">
        <input type='radio' id='radio2{{ $period->id }}' {{ $select == $period->in_time ? 'checked':'' }}  class='md-radiobtn' name='in_time' value='{{ $period->in_time }}' />
        <label for='radio2{{ $period->id }}'>
          <span></span>
          <span class='check'></span>
          <span class='box'></span>
          {{ $period->in_time }}
        </label>
      </div>
      @endforeach
    </div>
@else
 <center><h1>{{ trans('admin.no_data_in_this_day') }}</h1></center>
@endif
  </div>
</div>
