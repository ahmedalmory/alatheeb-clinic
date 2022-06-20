<div class="row">
    <div class="col-md-3">
        التصنيف :
        <select class="form-control" id="cat_id">
            <option value="">اختر التصنيف</option>
            @foreach($category AS $cat)
                <option value="{{ $cat->id }}">{{ $cat->cat_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        اسم الخدمة :
<input type="text" class="form-control" name="product_name" id="product_name" placeholder="اسم الخدمة"></div>
    <div class="col-md-3">
        سعر الخدمة :

<input type="text" class="form-control" name="product_price" id="product_price" placeholder="سعر الخدمة"></div>
<div class="col-md-3">
</br>
<button type="button" onclick="save_product()" class="btn btn-success" >حفظ</button></div>

</div>
