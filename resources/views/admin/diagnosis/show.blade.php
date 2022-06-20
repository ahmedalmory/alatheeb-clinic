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
          <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('diagnosis/create')}}"
            data-toggle="tooltip" title="{{trans('admin.diagnosis')}}">
            <i class="fa fa-plus"></i>
          </a>
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
                  {{trans('admin.ask_del')}} {{trans('admin.id')}} {{$diagnosis->id}} ؟
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
          <div class="col-md-12">
        <table class="table table-bordered table-hover table-striped">
          <tr>
            <th>{{trans('admin.in_day')}}: {!! trans('admin.'.date('D',strtotime($diagnosis->in_day))) !!}</th>
            <th>{{ trans('admin.date') }}: {{ $diagnosis->in_day }}</th>
            <th>{{ trans('admin.in_time') }}: {{ $diagnosis->in_time }}</th>
          </tr>
          <tr>
            <td colspan="3"><center>{{ trans('admin.TREATMENT_RECORD') }}</center></td>
          </tr>
          <tr>
            <th width="90%" colspan="2"><center>{{ trans('admin.treatment') }}</center></th>
            <th><center>{{ trans('admin.tooth') }}</center></th>
          </tr>
          <tr>
            <td colspan="2">{{ $diagnosis->treatment }}</td>
            <td>{{ $diagnosis->tooth }}</td>
          </tr>
          <tr>
            <th  colspan="2">{{ trans('admin.taken') }}</th>
            <th></th>
          </tr>
          <tr>
            <td  colspan="2">{{ $diagnosis->taken }}</td>
            <td></td>
          </tr>
        </table>
        <hr />
        <div class="clearfix"></div>
        <div class="col-md-12 col-lg-12 col-xs-12">
            <b>{{trans('admin.id')}} :</b> {{$diagnosis->id}}
          </div>
          @if(!empty($diagnosis->admin_id))
         <div class="col-md-6 col-lg-6 col-xs-6">
            <b>{{trans('admin.admin_id')}} :</b>
            {{ @App\Admin::find($diagnosis->admin_id)->name }}
          </div>
          @endif

          <div class="col-md-6 col-lg-6 col-xs-6">
            <b>{{trans('admin.dr_id')}} :</b>
            {!! $diagnosis->dr->name !!}
          </div>


           <div class="col-md-6 col-lg-6 col-xs-6">
            <b>{{trans('admin.patient_id')}} :</b>
            {!! @$diagnosis->patient->first_name !!}  {!! @$diagnosis->patient->father_name !!}  {!! @$diagnosis->patient->grand_name !!}
          </div>



          <div class="clearfix"></div>
          <hr />


        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
@stop
