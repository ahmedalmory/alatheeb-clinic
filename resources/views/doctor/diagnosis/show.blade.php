@extends('doctor.layout.index')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="widget-extra body-req portlet light bordered">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
        </div>
        <div class="actions">
          <a class="btn btn-circle btn-icon-only btn-default" href="{{url('doctor/diagnosis')}}"
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
          <table class="table table-bordered table-hover  table-striped" style="min-width:1000px">
                            <tr>
                                <th>{{trans('admin.id')}}</th>
                                <th>{{trans('admin.in_day')}}</th>
                                <th>{{ trans('admin.date') }}</th>
                                <th>{{ trans('admin.in_time') }}</th>
                                <th>{{trans('admin.dr_id')}}</th>
                                <th>
                                {{trans('admin.patient_id')}}
                                </th>

                            </tr>
                                <tr>
                                <td >{{$diagnosis->id}}#</td>
                                    <td>  {!! trans('admin.'.date('D',strtotime($diagnosis->in_day))) !!}</td>
                                    <td> {{ $diagnosis->in_day }}</td>
                                    <td> {{ $diagnosis->in_time }}</td>
                                    <td>
                                    {!! $diagnosis->dr->name !!}
                                    </td>
                                    <td> {!! @$diagnosis->patient->first_name !!}  {!! @$diagnosis->patient->father_name !!}  {!! @$diagnosis->patient->grand_name !!} </td>
                                </tr>
                        </table>
                        <table class="table table-bordered table-hover  " style="min-width:1000px">
                            <tr >
                                <th class="table-active">{{ trans('admin.tooth') }}  @if ($diagnosis->tooth)</th>
                                <td>@foreach ($diagnosis->tooth as $tooth)
                                        {{ $tooth }},
                                        @endforeach
                                        @else
                                        -
                                        @endif</td>
                            </tr>
                            <tr >
                                <th class="table-active">{{ trans('admin.treatment') }}</th>
                                <td>{{ $diagnosis->treatment }} </td>
                            </tr>
                            <tr >
                                <th class="table-active">{{ trans('admin.taken') }}</th>
                                <td>{{$diagnosis->taken}} </td>
                            </tr>
                        </table>
        <!-- <hr /> -->
        <div class="clearfix"></div>

          <!-- <div class="col-md-6 col-lg-6 col-xs-6">
            <b>{{trans('admin.dr_id')}} :</b>
            {!! $diagnosis->dr->name !!}
          </div>


           <div class="col-md-6 col-lg-6 col-xs-6">
            <b>{{trans('admin.patient_id')}} :</b>
            {!! @$diagnosis->patient->first_name !!}  {!! @$diagnosis->patient->father_name !!}  {!! @$diagnosis->patient->grand_name !!}
          </div>



          <div class="clearfix"></div>
          <hr /> -->


        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
@stop
