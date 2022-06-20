@extends('style.index')
@section('content')
    @push('js')

  <style media="screen">
  .datespage .toparea label {
    text-align: right;
    }
  </style>
<div class="datespage">
        <div class="title">{{$title}}</div>
        <div class="content">
          <p class="text-center text-danger" style="margin-top:0">هنا يتم تسديد فواتير الزيارات للطبيب وتحديد الخدمه من قبل الطبيب</p>
          <div class="toparea">
            <form action="{{ url()->current() }}">
              <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                   <label></label>
                  <div>
                   <input type="text" class="form-control date-picker" autocomplete="off" name="from" value="{{ request('from') }}" id="exampleInputEmail1" placeholder="{{ trans('admin.from') }}">
                  </div>
                </div><!-- end col-lg-2 -->

                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                  <label></label>
                  <div>
                   <input type="text" class="form-control date-picker" autocomplete="off" name="to" value="{{ request('to') }}" id="to" placeholder="{{ trans('admin.to') }}">
                  </div>
                </div><!-- end col-lg-3 -->

                 <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                  <label>{{ trans('admin.period') }}</label>
                  <div>
                  {!! Form::select('period',['morning'=>trans('admin.morning'),'evening'=>trans('admin.evening')],request('period'),['class'=>'form-control','placeholder'=>trans('admin.all')]) !!}
                  </div>
                </div><!-- end col-lg-3 -->

                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                  <label>{{ trans('admin.dr_id') }}</label>
                  <div>
                   {!! Form::select('dr_id',$drs,request('dr_id'),['class'=>'form-control','placeholder'=>trans('admin.all')]) !!}
                  </div>
                </div><!-- end col-lg-3 -->

<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
    <label></label>
                  <button type="submit" class="btn btn-success">بحث</button>
                </div><!-- end col-lg-2 -->


              </div><!-- end row -->
            </form>
          </div><!-- end toparea -->
			{!! Form::open(["method" => "post","url" => [url('/invoices/multi_delete')]]) !!}
      <div style="overflow:auto">
        <div class="" style="min-width:1000px">
          {!! $dataTable->table(["class"=> "table table-condensed"],true) !!}
        </div>
      </div>
			<div class="clearfix"></div>

        </div><!-- end content -->
      </div><!-- end datespage -->
<div class="clearfix"></div>
<div class="modal fade" id="multi_delete">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">x</button>
					<h4 class="modal-title">{{trans("admin.delete")}} </h4>
				</div>
				<div class="modal-body">
					<div class="delete_done"><i class="fa fa-exclamation-triangle"></i> {{trans("admin.ask-delete")}} <span id="count"></span> {{trans("admin.record")}} ! </div>
					<div class="check_delete">{{trans("admin.check-delete")}}</div>
				</div>
				<div class="modal-footer">
					{!! Form::submit(trans("admin.approval"), ["class" => "btn btn-danger delete_done"]) !!}
					<a class="btn btn-default" data-dismiss="modal">{{trans("admin.cancel")}}</a>
				</div>
			</div>
		</div>
</div>

@push('js')
{!! $dataTable->scripts() !!}
@endpush
{!! Form::close() !!}
@stop
