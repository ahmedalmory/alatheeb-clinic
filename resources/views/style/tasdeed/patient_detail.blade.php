
<?php foreach ($patient as $item) { ?>
<div class="col-md-5">
  <span> اسم المريض</span>
<input type="hidden" class="form-control" id="pat_id" name="pat_id" value="<?=$item->id;?>">
<input type="text" class="form-control" id="pat_name" name="pat_name" value="<?=$item->first_name;?>">
</div>
<div class="col-md-4">
    رقم الجوال
    <input type="text" class="form-control" id="pat_mobile" name="pat_mobile" value="<?=$item->mobile;?>">
</div>


<?php } ?>
