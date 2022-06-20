
<div class="col-md-4">
اسم المريض
<input type="hidden" class="form-control" id="pat_id2" name="pat_id2" value="<?=$patient->id;?>">
<input type="text" class="form-control" id="pat_name" name="pat_name" value="<?=$patient->first_name;?>" disabled>
</div>
<div class="col-md-3">
    رقم الجوال
    <input type="text" class="form-control" id="pat_mobile" name="pat_mobile" value="<?=$patient->mobile;?>" disabled>
</div>
<div class="col-md-3">
        <input type="hidden" class="form-control" id="natio"  value="<?=$patient->nationality;?>" disabled>
</div>
