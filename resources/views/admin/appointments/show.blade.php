@extends('admin.index')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="widget-extra body-req portlet light bordered">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
        </div>
        <div class="actions">
          <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('appointments/create')}}"
            data-toggle="tooltip" title="{{trans('admin.appointments')}}">
            <i class="fa fa-plus"></i>
          </a>
          <span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.appointments')}}">
            <a data-toggle="modal" data-target="#myModal{{$appointments->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
              <i class="fa fa-trash"></i>
            </a>
          </span>
          <div class="modal fade" id="myModal{{$appointments->id}}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">x</button>
                  <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                </div>
                <div class="modal-body">
                  {{trans('admin.ask_del')}} {{trans('admin.id')}} {{$appointments->id}} ؟
                </div>
                <div class="modal-footer">
                  {!! Form::open([
                  'method' => 'DELETE',
                  'route' => ['appointments.destroy', $appointments->id]
                  ]) !!}
                  {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                  <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
          </div>
          <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/appointments')}}"
            data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.appointments')}}">
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
          <div class="col-md-12 col-lg-12 col-xs-12">
            <b>{{trans('admin.id')}} :</b> {{$appointments->id}}
          </div>
          <div class="clearfix"></div>
          <hr />
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.admin_id')}} :</b>
            {{ App\Admin::find($appointments->admin_id)->name }}
          </div>

          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.patient_id')}} :</b>
            {!! @$appointments->patient->first_name !!}   {!! @$appointments->patient->father_name !!}  {!! @$appointments->patient->grand_name !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.group_id')}} :</b>
            {!! @$appointments->group->group_name !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.user_id')}} :</b>
            {!! $appointments->user->name !!}
          </div>

          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.period')}} :</b>
            {!! trans('admin.'.$appointments->period) !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.in_day')}} :</b>
            {!! $appointments->in_day !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.in_time')}} :</b>
            {!! $appointments->in_time !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.attend_status')}} :</b>
            {!! trans('admin.'.$appointments->attend_status) !!}
          </div>
          <div class="clearfix"></div>
          <hr />


          <div class="tabbable" id="tabs-60986">
        <ul class="nav nav-tabs">
          <li class="nav-item active">
            <a class="nav-link active" href="#invoices" data-toggle="tab">{{ trans('admin.invoices') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#diagnosis" data-toggle="tab">{{ trans('admin.diagnosis') }}</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="invoices">
            <p>
               <ul>
            @foreach($invoices as $invoice)
            <li>
              <a href="{{ aurl('invoices/'.$invoice->id) }}">{{ trans('admin.invoice',['id'=>$invoice->id]) }} -
                  {!! trans('admin.'.$invoice->invoice_status) !!}
              </a>
            </li>
            @endforeach
          </ul>
            </p>
          </div>
          <div class="tab-pane" id="diagnosis">
              <p>
               <ul>
            @foreach($diagnosis as $diagnos)
            <li>
              <a href="{{ aurl('diagnosis/'.$diagnos->id) }}">
                {{ trans('admin.diagnos',['id'=>$diagnos->id]) }}
              </a>
            </li>
            @endforeach
          </ul>
            </p>
          </div>
        </div>
      </div>





        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
@stop
