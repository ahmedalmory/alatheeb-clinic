
<div class="row">
    <?php foreach ($exp_sub as $item) { ?>
    <div class="col-md-4">
        المصرف الفرعي
        <select class="form-control" id="exp_m_id">
            <option value="">اختر مصرف الفرعي</option>
            @foreach($exp_main AS $data)
                <option value="{{ $data->id }}" {{ ( $data->id == $item->exp_m_id ) ? 'selected' : '' }}>{{ $data->exp_m_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        اسم المصرف الفرعي
        <input type="text" class="form-control" value="<?=$item->exp_name;?>" name="exp_name" id="exp_name" placeholder="اسم مصرف الفرعي"></div>

        <div class="col-md-4">
            <br>
        <button type="button" onclick="update_expense_sub('<?=$item->id;?>')" class="btn btn-success" >حفظ التعديل</button></div>
        <?php } ?>
</div>
