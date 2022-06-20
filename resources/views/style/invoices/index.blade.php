@extends('style.index')
@section('content')
    @push('js')
        <script>


        </script>
        <style>
            tbody .mt-checkbox > span:after {
                right: auto;
            }

            td > .mt-checkbox.mt-checkbox-single {
                left: 11px !important;
            }

            #dataTableBuilder_filter {
                margin-top: 8px;
                margin-bottom: 8px;
            }

            .datespage table.table tbody td span {
                padding: 10px;
                height: 20px;
            }

            .datespage .toparea label {
                height: 40px;
                padding: 0;
                margin: 0;
                font-weight: normal;
                font-size: 17px;
                text-align: right;
                display: block;
                color: #000;
            }
        </style>
        <div class="datespage">
            <div class="title">{{$title}}</div>
            <div class="content">
                <div class="toparea">

                    <form action="{{ url()->current() }}">
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <label></label>
                                <div>
                                    <input type="date" class="form-control date-picker" autocomplete="off" name="from"
                                           value="{{ request('from') }}" id="exampleInputEmail1"
                                           placeholder="{{ trans('app.from') }}">
                                </div>
                            </div><!-- end col-lg-2 -->

                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <label></label>
                                <div>
                                    <input type="date" class="form-control date-picker" autocomplete="off" name="to"
                                           value="{{ request('to') }}" id="to" placeholder="{{ trans('app.to') }}">
                                </div>
                            </div><!-- end col-lg-3 -->

                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <label>{{ trans('app.period') }}</label>
                                <div>
                                    {!! Form::select('period',['morning'=>trans('app.morning_period'),'evening'=>trans('app.evening_period')],request('period'),['class'=>'form-control','placeholder'=>trans('app.all_periods')]) !!}
                                </div>
                            </div><!-- end col-lg-3 -->

                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <label>{{ trans('app.doctor') }}</label>
                                <div>
                                    {!! Form::select('dr_id',$drs,request('dr_id'),['class'=>'form-control','placeholder'=>trans('app.all_doctors')]) !!}
                                </div>
                            </div><!-- end col-lg-3 -->

                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <label>{{ trans('app.invoice_status') }}</label>
                                <div>
                                    {!! Form::select('invoice_status',['paid'=>trans('app.paid'),'unpaid'=>trans('app.unpaid'),],request('invoice_status'),['class'=>'form-control','placeholder'=>__('app.the').trans('app.all')]) !!}
                                </div>
                            </div><!-- end col-lg-3 -->
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <label></label>
                                <button type="submit" class="btn btn-success">{{__('app.search')}}</button>
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
                        <div class="delete_done"><i
                                class="fa fa-exclamation-triangle"></i> {{trans("admin.ask-delete")}} <span
                                id="count"></span> {{trans("admin.record")}} !
                        </div>
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
