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
                        @user_can("diagnosis-create")
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url('diagnosis/create')}}"
                           data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.diagnosis')}}">
                            <i class="fa fa-plus"></i>
                        </a>
                        @end_user_can
                        @user_can("diagnosis-delete")
                        <span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.diagnosis')}}">
						<a data-toggle="modal" data-target="#myModal{{$diagnosis->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
							<i class="fa fa-trash"></i>
						</a>
					</span>
                        <div class="modal fade" id="myModal{{$diagnosis->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="close" data-dismiss="modal">x</button>
                                        <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                                    </div>
                                    <div class="modal-body">
                                        <i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$diagnosis->id}}) ؟
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['diagnosis.destroy', $diagnosis->id]
                                        ]) !!}
                                        {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                                        <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @end_user_can
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/diagnosis')}}"
                           data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.diagnosis')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('admin.fullscreen')}}"
                           title="{{trans('admin.fullscreen')}}">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12" style="overflow:auto">
                        <table class="table table-bordered table-hover table-striped" style="min-width:1000px">
                            <tr>
                                <th>{{trans('admin.in_day')}}
                                    : {!! trans('admin.'.date('D',strtotime($diagnosis->in_day))) !!}</th>
                                <th>{{ trans('admin.date') }}: {{ $diagnosis->in_day }}</th>
                                <th>{{ trans('admin.in_time') }}: {{ $diagnosis->in_time }}</th>
                                <th>{{ trans('admin.treatment') }}: {{ $diagnosis->treatment }} </th>

                            </tr>
                            <tr>
                                <th>
                                    <center>{{ trans('admin.TREATMENT_RECORD') }}</center>
                                </th>
                                <th>{{ trans('admin.tooth') }} : @foreach ($diagnosis->tooth as $tooth)
                                    {{ $tooth }},
                                    @endforeach</th>
                                <th>{{ trans('admin.taken') }}:{{$diagnosis->taken}}</th>
                                <th> {{trans('admin.id')}}: {{$diagnosis->id}}</th>
                            </tr>
                            @if(!empty($diagnosis->admin_id))
                                <tr>
                                    <th> {{trans('admin.admin_id')}}
                                        : {{ @App\Admin::find($diagnosis->admin_id)->name }}</th>
                                </tr>
                            @endif


                        </table>
                        <hr/>
                        <div class="clearfix"></div>

                        <div class="col-md-6 col-lg-6 col-xs-6">
                            <b>{{trans('admin.dr_id')}} :</b>
                            {!! $diagnosis->dr->name !!}
                        </div>


                        <div class="col-md-6 col-lg-6 col-xs-6">
                            <b>{{trans('admin.patient_id')}} :</b>
                            {!! @$diagnosis->patient->first_name !!}  {!! @$diagnosis->patient->father_name !!}  {!! @$diagnosis->patient->grand_name !!}
                        </div>


                        <div class="clearfix"></div>
                        <hr/>


                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@stop
