<style>
    .mt-checkbox > span:after {
        background: red;
    }
</style>
@extends('style.index')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget-extra body-req portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default"
                           href="{{aurl('invoices/'.$invoices->id.'/edit')}}"
                           data-toggle="tooltip" title="{{trans('admin.invoices')}}">
                            <i class="fa fa-edit"></i>
                        </a>
                        @user_can("invoices-create")
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url('invoices/create')}}"
                           data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.invoices')}}">
                            <i class="fa fa-plus"></i>
                        </a>
                        @end_user_can
                        @user_can("invoices-delete")
                        <span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.invoices')}}">
						<a data-toggle="modal" data-target="#myModal{{$invoices->id}}"
                           class="btn btn-circle btn-icon-only btn-default" href="">
							<i class="fa fa-trash"></i>
						</a>
					</span>
                        <div class="modal fade" id="myModal{{$invoices->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="close" data-dismiss="modal">x</button>
                                        <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                                    </div>
                                    <div class="modal-body">
                                        <i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}}
                                        ({{$invoices->id}}) ؟
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['invoices.destroy', $invoices->id]
                                        ]) !!}
                                        {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                                        <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @end_user_can
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/invoices')}}"
                           data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.invoices')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('admin.fullscreen')}}"
                           title="{{trans('admin.fullscreen')}}">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover table-striped">
                            <tr>
                                <td width="33%">
                                    {{ setting()->sitename }}<br>
                                    {{ setting()->url }}<br>
                                    {{ str_replace('|','-',setting()->phones) }}
                                </td>
                                <td width="33%">
                                    <center>
                                        <img src="{{ it()->url(setting()->logo) }}" style="width:48px;height:48px;">
                                    </center>
                                </td>
                                <td width="33%" valign="middle">
                                    <br>
                                    <center>
                                        {{ $invoices->invoice_date }}
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <center>
                                        {{ trans('admin.invoice_id') }}<br>
                                        {{ $invoices->id }}
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ trans('admin.name') }}
                                    : {{ @$invoices->patient->first_name }} {{ @$invoices->patient->father_name }} {{ @$invoices->patient->grand_name }}
                                </td>
                                <td>
                                    {{ trans('admin.f_number') }}: {{ @$invoices->patient->f_number }} <br>
                                    {{ trans('admin.mobile') }} : {{ @$invoices->patient->mobile }}
                                </td>
                                <td>
                                    {{ trans('admin.dr_id') }} : {{ $invoices->dr->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>{{ trans('admin.price_list') }}</td>
                                <td colspan="2">{{ trans('admin.content') }}</td>
                            </tr>
                            <?php
                            $i = 0;
                            ?>
                            @foreach(explode('|',$invoices->content) as $content)
                                <tr>
                                    <td>{{ explode('|', $invoices->price_list)[$i] }}</td>
                                    <td colspan="2">{{ $content }}</td>
                                </tr>
                                <?php
                                $i++;
                                ?>
                            @endforeach
                        </table>
                        <div class="col-md-3">
                            {{ trans('admin.total') }}
                            : {{ array_sum(explode('|',$invoices->price_list)) }}  {{ trans('admin.sar') }}
                        </div>
                        <div class="col-md-3 col-lg-3 col-xs-6">
                            <b>{{trans('admin.invoice_status')}} :</b>
                            {!! trans('admin.'.$invoices->invoice_status) !!}
                        </div>
                        <div class="col-md-3 col-lg-3 col-xs-6">
                            <b>{{trans('admin.pay_at')}} :</b>
                            {!! trans('admin.'.$invoices->pay_at) !!}
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-md-6">
                            {{ trans('admin.recipient_signature') }} : .....................................
                        </div>
                        <div class="col-md-6">
                            {{ trans('admin.accountant_signature') }} : .....................................
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@stop
