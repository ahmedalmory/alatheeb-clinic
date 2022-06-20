<div class="row">
<?php foreach ($category as $item) { ?>
<div class="col-md-2">اسم التصنيف:</div>
<div class="col-md-6">
<input type="text" class="form-control" value="<?=$item->cat_name;?>"
 name="cat_name" id="cat_name"
 placeholder="اسم التصنيف"></div>
<div class="col-md-4">
<button type="button" onclick="update_category('<?=$item->id;?>')" class="btn btn-success" >حفظ التعديل</button></div>
<?php } ?>
</div>
