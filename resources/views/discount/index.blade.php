@extends('style.index')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>العروض</h4>
                <br>
                @user_can("discounts-create")
                    <a class="btn btn-success btn-sm" href="{{route('discounts.create')}}">{{__('admin.add')}}</a>
                @end_user_can
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <th>#</th>
                        <th>{{__('admin.product_name')}}</th>
                        <th>{{__('admin.start')}}</th>
                        <th>{{__('admin.end')}}</th>
                        <th>{{__('admin.discount_rate')}}</th>
                        <th>{{__('admin.discount_rate_appears')}}</th>
                        <th>  </th>
                    </thead>
                    <tbody>
                        @forelse($discounts as $discount)
                            <tr>
                                <td>{{$discount->id}}</td>
                                <td>{{$discount->product_id == 0 ? __('admin.products'):$discount->product->p_name }}</td>
                                <td>{{$discount->start_at}}</td>
                                <td>{{$discount->end_at}}</td>
                                <td>{{$discount->discount_rate}}%</td>
                                <td>{{$discount->show_discount_rate ?__('admin.yes') :__('admin.no')}}</td>
                                <td>
                                    @user_can("discounts-delete")
                                    <a class="btn btn-primary btn-sm" href="{{route('discounts.edit',$discount)}}">{{__('admin.edit')}}</a>
                                    @end_user_can
                                    @user_can("discounts-update")
                                    <button class="btn btn-danger btn-sm" form="delete{{$discount->id}}">{{__('admin.delete')}}</button>
                                    <form id="delete{{$discount->id}}" method="post" action="{{route('discounts.destroy',$discount)}}">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                    @end_user_can

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="1000">لا يوجد</td>

                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
