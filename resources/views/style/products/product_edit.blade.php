
<div class="row">
    <?php foreach ($product as $item) { ?>
    <div class="col-md-3">
        التصنيف :
        <select class="form-control" id="cat_id">
            <option value="">اختر التصنيف</option>
            @foreach($category AS $data)
                <option value="{{ $data->id }}" {{ ( $data->id == $item->cat_id ) ? 'selected' : '' }}>{{ $data->cat_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        اسم الخدمة :
        <input type="text" class="form-control" value="<?=$item->p_name;?>" name="product_name" id="product_name" placeholder="اسم الخدمة"></div>
    <div class="col-md-3">
        سعر الخدمة :

        <input type="text" class="form-control" value="<?=$item->p_price;?>" name="product_price" id="product_price" placeholder="سعر الخدمة"></div>
    <div class="col-md-3">
        </br>
        <button type="button" onclick="update_product('<?=$item->id;?>')" class="btn btn-success" >حفظ التعديل</button></div>
        <?php } ?>
</div>
