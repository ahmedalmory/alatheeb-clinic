<?php foreach ($patient as $item) { ?>
<table class="table table-bordered">
<tr><th>رقم السجل</th>
<th>رقم الهوية / الاقامة </th>
<th>اسم المريض</th>
<th>رقم الجوال</th>
<th></th>
</tr>
<tr>
<td><?=$item->id;?></td>
<td><?=$item->civil;?></td>
<td><?=$item->first_name;?></td>
<td><?=$item->mobile;?></td>
<td><a href="{{ url('/patients/'.$item->id)}}" type="button" class="btn btn-success"> عرض </button></td>
</tr>
</table>
<div class="row">
<div class="col-md-12">
اضافة ملفات
<table class="table table-bordered">
<tr><th>اسم الملف</th>
<th>اختيار الملف</th>
<th></th>
</tr>
<tr>
<input type="hidden" name="pat_id" value="<?=$item->id;?>">
<td width="30%"><input type="text" name="file_name" id="file_name" class="form-control"></td>
<td>   <input type="file" name="image"  id="image" class="form-control"></td>
<td><button type="submit" class="btn btn-primary">حفظ</button></td>

</tr>
</table>
</div>
</div>
</table>
     <?php
	 }
	 ?>
