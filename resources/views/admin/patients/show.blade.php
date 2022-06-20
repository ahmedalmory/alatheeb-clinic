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
          <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('patients/create')}}"
            data-toggle="tooltip" title="{{trans('admin.patients')}}">
            <i class="fa fa-plus"></i>
          </a>
          <span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.patients')}}">
            <a data-toggle="modal" data-target="#myModal{{$patients->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
              <i class="fa fa-trash"></i>
            </a>
          </span>
          <div class="modal fade" id="myModal{{$patients->id}}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">x</button>
                  <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                </div>
                <div class="modal-body">
                  {{trans('admin.ask_del')}} {{trans('admin.id')}} {{$patients->id}} ؟
                </div>
                <div class="modal-footer">
                  {!! Form::open([
                  'method' => 'DELETE',
                  'route' => ['patients.destroy', $patients->id]
                  ]) !!}
                  {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                  <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
          </div>
          <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/patients')}}"
            data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.patients')}}">
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
            <b>{{trans('admin.id')}} :</b> {{$patients->id}}
          </div>
          <div class="clearfix"></div>
          <hr />
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.admin_id')}} :</b>
            {{ App\Admin::find($patients->admin_id)->name ?? "لم يحدد" }}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.f_number')}} :</b>
            {!! $patients->f_number !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.record_date')}} :</b>
            {!! $patients->record_date !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.first_name')}} :</b>
            {!! $patients->first_name !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.father_name')}} :</b>
            {!! $patients->father_name !!}
          </div>
          <div class="clearfix"></div>
          <br />
          <hr />
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.grand_name')}} :</b>
            {!! $patients->grand_name !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.title')}} :</b>
            {!! $patients->title !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.civil')}} :</b>
            {!! $patients->civil !!}
          </div>
          <div class="clearfix"></div>
          <br />
          <hr />
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.relation_id')}} :</b>
            {!! @$patients->relation->re_name !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.gender')}} :</b>
            {!! trans('admin.'.$patients->gender) !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.nationality')}} :</b>
            {!! @$patients->national->nat_name !!}
          </div>
          <div class="clearfix"></div>
          <br />
          <hr />
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.date_birh_hijri')}} :</b>
            {!! $patients->date_birh_hijri !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.age')}} :</b>
            {!! $patients->age !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.mobile')}} :</b>
            {!! $patients->mobile !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.phone')}} :</b>
            {!! $patients->phone !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.mobile_nearby')}} :</b>
            {!! $patients->mobile_nearby !!}
          </div>
          <div class="clearfix"></div>
          <br />
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.comments')}} :</b>
            {!! $patients->comments !!}
          </div>
          <div class="col-md-4 col-lg-4 col-xs-4">
            <b>{{trans('admin.last_update_at')}} :</b>
            {!! @$patients->last_update_at()->first()->name !!}
          </div>
        </div>
        <div class="clearfix"></div>
        <hr />
        <?php
/*
@foreach($patients->files()->get() as $file)
<div class="col-md-4">
<a href="{{ it()->url($file->full_path) }}">{{ $file->name }} <i class="fa fa-download"></i></a>
</div>
@endforeach
 */
?>
        <center><h1>{{ trans('admin.appointments') }}</h1></center>
        <table class="table table-bordered table-striped table-hover">
          <tr>
            <th>{{ trans('admin.in_day') }}</th>
            <th>{{ trans('admin.in_time') }}</th>
            <th>{{ trans('admin.period') }}</th>
            <th>{{ trans('admin.attend_status') }}</th>
            <th>{{ trans('admin.dr_id') }}</th>
            <th>{{ trans('admin.invoices') }}</th>
            <th>{{ trans('admin.diagnosis') }}</th>
          </tr>
          @foreach($appoints as $appoint)
          <tr>
            <td><a href="{{ aurl('appointments/'.$appoint->id) }}" target="_blank"> {{ $appoint->in_day }} </a></td>
            <td> {{ $appoint->in_time }} </td>
            <td> {{ trans('admin.'.$appoint->period) }} </td>
            <td> {{ trans('admin.'.$appoint->attend_status) }} </td>
            <td> {{ $appoint->user->name }} </td>
            <td>{{ $appoint->invoice_count() }}</td>
            <td>{{ $appoint->diagnos_count() }}</td>
          </tr>
          @endforeach
        </table>
        <hr />
        {!! $appoints->render() !!}
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
@stop
