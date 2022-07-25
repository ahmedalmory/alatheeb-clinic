@extends('style.index')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>{{__('app.add_discount')}}</h4>
                <br>
                <a class="btn btn-success btn-sm" href="{{route('discounts.index')}}">الكل</a>
            </div>
            <div class="card-body">
                <form class="form-body" action="{{route('discounts.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">{{__('app.discount_rate')}}</label>
                            <input type="number" name="discount_rate" class="form-control" value="{{old('discount_rate')}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">{{__('app.show_discount_rate')}}</label>
                            <select class="form-control" name="show_discount_rate">
                                <option {{old('show_discount_rate') == 1 ? "selected":""}} value="1">نعم</option>
                                <option {{old('show_discount_rate') == 0 ? "selected":""}} value="0">لا</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">{{__('app.start_at')._the('app.discount')}}</label>
                            <input type="date" name="start_at" class="form-control" value="{{old('start_at')}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">{{__('app.end_at')._the('app.discount')}}</label>
                            <input  type="date" name="end_at" class="form-control" value="{{old('end_at')}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">{{_the('app.product')}}</label>
                            <select class="form-control" name="product_id">
                                <option {{old('product_id') == 0 ? "selected":""}} value="0">{{__('app.for_all').'  '.__('app.products')}}</option>
                                @foreach(\App\Models\Product::all() as $product)
                                <option {{old('product_id') == $product->id ? "selected":""}} value="{{$product->id}}">{{$product->p_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 text-center">
                            <button class="btn btn-success">{{__('admin.create')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
