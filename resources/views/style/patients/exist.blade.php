<?php foreach ($patient as $item) { ?>
<table class="table table-bordered">
    <tr>
        <th>رقم السجل</th>
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
        تحويل الي طبيب مباشرة
        <table class="table table-bordered">
            <tr>
                <th>العيادة</th>
                <th>الطبيب</th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <select name="dep_id" id="dep_id" class="form-control" onchange="get_doctors()">
                        <option value="">اختر العيادة</option>
                        @foreach($departments AS $dep)
                        <option value="{{ $dep->id }}">{{ $dep->dep_name }}
                        </option>
                        @endforeach
                    </select>
                </td>
                <td><select class="form-control" id="doctors">
                    </select></td>
                <td><button type="button" class="btn btn-primary"
                        onclick="tahweel_patient(<?=$item->id;?>);">حفظ</button></td>
            </tr>
        </table>
    </div>
</div>
</table>
<?php
}
?>