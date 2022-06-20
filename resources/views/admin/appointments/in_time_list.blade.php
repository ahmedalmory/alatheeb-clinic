<div class="form-group">

{!! Form::label('in_time',trans('admin.in_time'),['class'=>'col-md-3 control-label']) !!}
<div class="input-group col-md-9">
	<center><h1>
		<?php
$day_date = date('D', strtotime($day));
?>
{{trans('admin.' . $day_date)}}

</h1></center>

<div class="md-radio-list">





<?php
$open_time  = strtotime(setting()->{'from_' . $selected});
$close_time = strtotime(setting()->{'to_' . $selected});
$now        = strtotime(setting()->{'from_' . $selected});
$output     = "";
for ($i = $open_time; $i < $close_time; $i += (60 * setting()->patient_exposure)) {
   if ($i < $now) {
      continue;
   }
   $period_time = date("h:i", $i);

   $select_old = $select == $period_time ? 'checked' : '';
   $check      = App\Model\Appoint::whereDate('in_day', $day)->where('in_time', $period_time)->first();
   $output .= '<div class="md-radio">';
   if (!empty($check)) {
      $output .= "
      <input type='hidden' name='in_time' value='" . $period_time . "'>
      <input type='radio' checked id='radio" . $i . "' class='md-radiobtn' readonly disabled />
       <label for='radio" . $i . "'>
			      <span></span>
			      <span class='check'></span>
			      <span class='box'></span>
			       " . $period_time . "  - " . trans('admin.already_used',
         ['name' => $check->patient->first_name . ' ' . $check->patient->father_name, 'dr' => $check->user->name]) . "</label>";
   } else {
      $output .= "<input type='radio' id='radio2" . $i . "'  class='md-radiobtn' name='in_time' value='" . $period_time . "'  " . $select_old . "/>
      			<label for='radio2" . $i . "'>
			      <span></span>
			      <span class='check'></span>
			      <span class='box'></span>
       				" . $period_time . "
       			  </label>";
   }
}
$output .= '</div>';
echo $output;

?>

</div>
<?php
/*

{{ strtotime('+' . setting()->patient_exposure . ' minutes') }} <br>
24Hours : {{ date("H:i", strtotime(setting()->{'from_'.$selected})) }} <br>

from : {{ setting()->{'from_'.$selected} }}

<br>
to : {{ setting()->{'to_'.$selected} }}
<br>

<br>

{{ $period }}
 */
?>

</div>