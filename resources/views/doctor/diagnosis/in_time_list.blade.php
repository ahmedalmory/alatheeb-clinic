
<script type="text/javascript">
$(document).ready(function(){

  var checkedval = $('input[name=in_time]:checked', '#diagnosis').attr('pid');
  $('.appoint_id').val(checkedval);

  $(document).on('change','input[type=radio][name=in_time]',function(){
  //  alert('test');
    var checkedval = $('input[name=in_time]:checked', '#diagnosis').attr('pid');
    $('.appoint_id').val(checkedval);
  });
});
</script>

<div class="form-group">
  {!! Form::label('in_time',trans('admin.in_time'),['class'=>'col-md-3 control-label']) !!}
  <div class="input-group col-md-9">
    <center><h1>{{trans('admin.' . date('D', strtotime($day)))}}</h1></center>
@if(count($period_list) > 0)
 <input type="hidden" name="appoint_id" class="appoint_id" value="{{ !empty($appoint_id)?$appoint_id:'' }}">
    <div class="md-radio-list">
      @foreach($period_list as $period)
      <div class="md-radio">

        <input type='radio' id='radio2{{ $period->id }}' {{ $select == $period->in_time.':00' ? 'checked':'' }} pid="{{ $period->id }}"  class='md-radiobtn' name='in_time' value='{{ $period->in_time }}' />
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
