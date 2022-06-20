<div class="row">
    <div class="col-md-4">
        المصرف الرئيسي :
        <select class="form-control" id="exp_m_id">
            <option value="">اختر مصرف الرئيسي</option>
            @foreach($exp_main AS $item)
                <option value="{{ $item->id }}">{{ $item->exp_m_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        اسم مصرف الفرعي
<input type="text" class="form-control" name="exp_name" id="exp_name" placeholder="اسم مصرف الفرعي"></div>
<div class="col-md-4">
</br>
<button type="button" onclick="save_expense_sub()" class="btn btn-success" >حفظ</button></div>

</div>
