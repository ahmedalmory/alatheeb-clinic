<div class="row">
<?php foreach ($expense_main as $item) { ?>
<div class="col-md-2">اسم مصرف الرئيسي</div>
<div class="col-md-6">
<input type="text" class="form-control" value="<?=$item->exp_m_name;?>"
 name="exp_m_name" id="exp_m_name"
 placeholder="اسم مصرف الرئيسي"></div>
<div class="col-md-4">
<button type="button" onclick="update_expense_main('<?=$item->id;?>')" class="btn btn-success" >حفظ التعديل</button></div>
<?php } ?>
</div>
