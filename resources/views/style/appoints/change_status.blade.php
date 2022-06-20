<div class="row">
  <div class="col-md-6" style="padding:0">
    <select name="status_id" id="status_id" class="form-control w-100" >
        <option value="">اختر الحالة</option>
        <option value="4"> موكد </option>
        <option value="5"> غير موكد </option>
        <option value="1"> حضر </option>
        <option value="2" > في الانتظار </option>
        <option value="3" > تمت التشخيص </option>
    </select>
  </div>
  <div class="col-md-3">
      <button type="button" class="btn btn-success" onclick="confirm_change('<?php echo  $time; ?>','<?php echo  $clinic; ?>',
          '<?php echo  $doctor; ?>','<?php echo  $period; ?>','<?php echo  $appoint_date; ?>')">تم تغير حالة الحجز
      </button>
  </div>
</div>
