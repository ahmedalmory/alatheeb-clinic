
<div class="" style="overflow:auto;overflow: auto; width: 100%;" >

<div class="" style="min-width:800px">
  <table class="table table-bordered" >
      <tr>
          <th>
              الوقت
          </th>
          <th>
              المريض
          </th>
          <th>
              الحالة
          </th>
          <th>
              حجز بواسطه
          </th>
          <th>
              ملاحظات
          </th>
          <th colspan="6">

          </th>
      </tr>



      <?php
          if($period !== 'all_period'){
              $open_time  = strtotime(setting()->{'from_' . $period});
              $close_time = strtotime(setting()->{'to_' . $period});
              $now        = strtotime(setting()->{'from_' . $period});
          }else {
              $open_time  = strtotime(setting()->from_morning);
              $close_time = strtotime(setting()->to_evening);
              $now        = strtotime(setting()->from_morning);
          }
          for ($i = $open_time; $i < $close_time; $i += (60 * setting()->patient_exposure)) {
              if ($i < $now) {
                  continue;
              }?>
      <tr>
          <td> <?php echo  $period_time = date("h:i", $i); echo " / ".$appoint_date;?></td>
          <td bgcolor="#FF0000">
              @php
              foreach(get_appoint_data($period_time,$clinic,$doctor,$period,$appoint_date) AS $getdata){
              $patient_id = $getdata->patient_id;
              echo ("<a href='".url('doctor/patients/'.$getdata->patient_id)."'>".patient_name($getdata->patient_id)."</a>");
              }
              @endphp



          </td>

          <td> @php
              foreach(get_appoint_data($period_time,$clinic,$doctor,$period,$appoint_date) AS $getdata){
              $s = $getdata->appoint_status;
              echo(get_status($getdata->appoint_status));
              }@endphp
          </td>
          <td> @php
              foreach(get_appoint_data($period_time,$clinic,$doctor,$period,$appoint_date) AS $getdata){
              echo (doctor_name($getdata->user_id_a));
              }
              @endphp</td>
          <td>
              @foreach(get_appoint_data($period_time,$clinic,$doctor,$period,$appoint_date) AS $getdata)
              {{ $getdata->call_patient }}
              @endforeach
          </td>
              <?php
              $s = 0;
          foreach(get_appoint_data($period_time,$clinic,$doctor,$period,$appoint_date) AS $getdata){
            $disable = '';$s = $getdata->appoint_status;
              }?>
          <td>
              @foreach(get_appoint_data($period_time,$clinic,$doctor,$period,$appoint_date) AS $getdata)
                <a target="_blank" href="{{url('appoints_print/'.$getdata->id)}}" class="btn btn-sn btn-info">
                  <i class="fas fa-print"></i>
                </a>
              @endforeach
          </td>
          <td>
              <?php if($s != '0'){?>
              <a class="btn btn-danger btn-sm" onclick="appoint_cancel('<?php echo  $s; ?>','<?php echo  $period_time; ?>','<?php echo  $clinic; ?>',
                  '<?php echo  $doctor; ?>','<?php echo  $period; ?>','<?php echo  $appoint_date; ?>')">
                  <i class="fas fa-trash-alt"></i>
                </a>
              <?php } else{?>
              <a class="btn btn-danger btn-sm" disabled>
                <i class="fas fa-trash-alt"></i>
              </a>
              <?php }  ?>

          </td>
          <td>
              <?php if($s != '0'){?>
              <a class="btn btn-success btn-sm" onclick="confirm_call('<?php echo  $period_time; ?>','<?php echo  $clinic; ?>',
                  '<?php echo  $doctor; ?>','<?php echo  $period; ?>','<?php echo  $appoint_date; ?>');"><i class="fas fa-phone-alt"></i></a>
              <?php } else{?>
              <a class="btn btn-success btn-sm" disabled><i class="fas fa-phone-alt"></i></a>
              <?php }  ?>
          </td>
          <td>
              <?php if($s != '0'){?>
              <a class="btn btn-primary btn-sm" onclick="change_status('<?php echo  $period_time; ?>','<?php echo  $clinic; ?>',
                  '<?php echo  $doctor; ?>','<?php echo  $period; ?>','<?php echo  $appoint_date; ?>')">حالة</a>
              <?php } else{?>
              <a class="btn btn-primary btn-sm" disabled>حالة</a>
              <?php }  ?>
          </td>
          <td>
              <?php if($s != '0'){
                  $message = " تنبية : هناك موعد يوم ".$appoint_date." الساعة ".$period_time." مع الدكتور ".\App\User::query()->find($doctor)->name." في عيادة ".\App\Model\Department::find($clinic)->dep_name." الرجاء الحضور .";
                  ?>
                  <a class="btn btn-success btn-sm" target="_blank" href="https://wa.me/966500876876/?text={{urlencode($message)}}">
                      <i class="fab fa-whatsapp" aria-hidden="true"></i>
                  </a>
              <?php }?>

          </td>

      </tr>
      <?php  } ?>
  </table>

</div>
</div>
