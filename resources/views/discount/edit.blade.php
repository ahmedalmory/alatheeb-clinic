@extends('style.index')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>تعديل عرض</h4>
                <br>
                <a class="btn btn-success btn-sm" href="{{route('discounts.index')}}">الكل</a>
            </div>
            <div class="card-body">
                <form class="form-body" action="{{route('discounts.update',$edit)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">نسبة العرض</label>
                            <input  type="number" name="discount_rate" class="form-control" value="{{old('discount_rate',$edit->discount_rate)}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">اظهار نسبة العرض في الفاتورة </label>
                            <select class="form-control" name="show_discount_rate">
                                <option {{old('show_discount_rate',$edit->show_discount_rate) == 1 ? "selected":""}} value="1">نعم</option>
                                <option {{old('show_discount_rate',$edit->show_discount_rate) == 0 ? "selected":""}} value="0">لا</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">بداية العرض</label>
                            <input type="date" name="start_at" class="form-control" value="{{old('start_at',$edit->start_at)}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">نهاية العرض</label>
                            <input  type="date" name="end_at" class="form-control" value="{{old('end_at',$edit->end_at)}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">التصنيف</label>
                            <select class="form-control" name="product_id">
                                <option {{old('product_id',$edit->product_id) == 0 ? "selected":""}} value="0">لكل التصنيفات</option>
                                @foreach(\App\Models\Product::all() as $product)
                                <option {{old('product_id',$edit->product_id) == $product->id ? "selected":""}} value="{{$product->id}}">{{$product->p_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 text-center">
                            <button class="btn btn-success">تعديل</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
