@extends('style.index')
@section('content')
<style media="screen">
  .p-3 {
      padding:16px;
  }
</style>
<div class="viewlogpage">
  <div class="viewlogbut">
    <button type="submit" class="edit"><i class="fa fa-pencil"></i>تعديل</button>
    <button type="submit" class="del"><i class="fa fa-close"></i>حذف</button>
  </div>
  <div class="content">
    <div class="">
        <div class="row w-100 mx-0 px-0">
          <div class="col-md-6">
            <table class="table table-striped table-bordered table-hover table-condensed">
              <tbody>
                <tr>
                  <td>{{ trans('admin.name') }}</td>
                  <td> {!! @$appointments->patient->first_name !!}   {!! @$appointments->patient->father_name !!}  {!! @$appointments->patient->grand_name !!}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.gender') }}</td>
                  <td>{{ !empty(@$appointments->patient->gender)?trans('admin.'.@$appointments->patient->gender):'' }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.f_number') }}</td>
                  <td>{{ @$appointments->patient->f_number }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.record_date') }}</td>
                  <td>{{ @$appointments->patient->record_date }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.age') }}</td>
                  <td>{{ @$appointments->patient->age }} عاما</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.date_birh_hijri') }}</td>
                  <td>{{ @$appointments->patient->date_birh_hijri }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.mobile') }}</td>
                  <td>{{ @$appointments->patient->mobile }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.phone') }} </td>
                  <td>{{ @$appointments->patient->phone }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.mobile_nearby') }} </td>
                  <td>{{ @$appointments->patient->mobile_nearby }}</td>
                </tr>
                <tr>
                  <td colspan="2">معلومات طبيه عن المريض</td>
                </tr>
              </body>
            </table>
          </div>
          <div class="col-md-6">
            <table class="table table-striped table-bordered table-hover table-condensed">
              <tbody>
                <tr>
                  <td>{{ trans('admin.comments') }}</td>
                  <td>{{ @$appointments->patient->comments }}</td>
                </tr>
                <tr>
                  <td colspan="2">الغرض من الزيارة : {{ @$appointments->patient->purpose_visit }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.teeth_medicine') }}</td>
                  <td>{{ !empty(@$appointments->patient->teeth_medicine)?trans('admin.'.@$appointments->patient->teeth_medicine):'' }}</td>
                </tr>
                <tr>
                  <td colspan="2">هل سبق وأن اصبت او ان تعاني حاليا من  :</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.heart_disease') }}</td>
                  <td>{{ !empty(@$appointments->patient->heart_disease)?trans('admin.'.@$appointments->patient->heart_disease):'' }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.high_low_blood') }}</td>
                  <td>{{ !empty(@$appointments->patient->high_low_blood)?trans('admin.'.@$appointments->patient->high_low_blood):'' }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.rheumatic_fever') }}</td>
                  <td>{{ !empty(@$appointments->patient->rheumatic_fever)?trans('admin.'.@$appointments->patient->rheumatic_fever):'' }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.anemia') }}</td>
                  <td>{{ !empty(@$appointments->patient->anemia)?trans('admin.'.@$appointments->patient->anemia):'' }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.thyroid_disease') }}</td>
                  <td>{{ !empty(@$appointments->patient->thyroid_disease)?trans('admin.'.@$appointments->patient->thyroid_disease):'' }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.hepatitis') }}</td>
                  <td>{{ !empty(@$appointments->patient->hepatitis)?trans('admin.'.@$appointments->patient->hepatitis):'' }}</td>
                </tr>

              </body>
            </table>
          </div>
          <div class="col-md-6">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <tbody>
                  <tr>
                    <td>{{ trans('admin.diabetes') }}</td>
                    <td>{{ !empty(@$appointments->patient->diabetes)?trans('admin.'.@$appointments->patient->diabetes):'' }}</td>
                  </tr>
                <tr>
                  <td>{{ trans('admin.asthma') }}</td>
                  <td>{{ !empty(@$appointments->patient->asthma)?trans('admin.'.@$appointments->patient->asthma):'' }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.kidney_disease') }}</td>
                  <td>{{ !empty(@$appointments->patient->kidney_disease)?trans('admin.'.@$appointments->patient->kidney_disease):'' }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.tics') }}</td>
                  <td>{{ !empty(@$appointments->patient->tics)?trans('admin.'.@$appointments->patient->tics):'' }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.sensitivity_penicillin') }}</td>
                  <td>{{ !empty(@$appointments->patient->sensitivity_penicillin)?trans('admin.'.@$appointments->patient->sensitivity_penicillin):'' }}</td>
                </tr>
                <tr>
                  <td>{{ trans('admin.taking_drugs') }}</td>
                  <td>{{ !empty(@$appointments->patient->taking_drugs)?trans('admin.'.@$appointments->patient->taking_drugs):'' }}</td>
                </tr>
                @if(@$appointments->patient->gender=='female')
                <tr>
                  <td>{{ trans('admin.pregnant') }}</td>
                  <td>{{ !empty(@$appointments->patient->pregnant)?trans('admin.'.@$appointments->patient->pregnant):'' }}</td>
                </tr>
                @endif
                <tr>
                  <td>{{ trans('admin.other_diseases') }}</td>
                  <td>{{ @$appointments->patient->other_diseases }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div><!-- end table-responsive -->
      </div><!-- end content -->
      </div><!-- end datespage -->
      <div class="row">
        <div class="col-md-12">
          <div class="widget-extra body-req portlet light bordered">
            <div class="portlet-title">
              <div class="caption">
                <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
              </div>
              <div class="actions">
                  @user_can("appointments-create")
                  <a class="btn btn-circle btn-icon-only btn-default" href="{{url('appointments/create')}}"
                  data-toggle="tooltip" title="{{trans('admin.appointments')}}">
                  <i class="fa fa-plus"></i>
                    </a>
                  @end_user_can
                  @user_can("appointments-delete")
                <span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.appointments')}}">
                  <a data-toggle="modal" data-target="#myModal{{$appointments->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
                    <i class="fa fa-trash"></i>
                  </a>
                </span>
                  @end_user_can
                <a class="btn btn-circle btn-icon-only btn-default" href="{{url('/appointments')}}"
                  data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.appointments')}}">
                  <i class="fa fa-list"></i>
                </a>
              </div>
            </div>
            <div class="portlet-body form" style="background-color: #fff; position: relative; overflow: hidden;">
              <div class="col-md-12">
                <div class="col-md-12 col-lg-12 col-xs-12">
                  <b>{{trans('admin.id')}} :</b> {{$appointments->id}}
                </div>
                @if(!empty($appointments->admin_id))
                <div class="col-md-4 col-lg-4 col-xs-4 p-3">
                  <b>{{trans('admin.admin_id')}} :</b>
                  {{ @App\Admin::find($appointments->admin_id)->name }}
                </div>
                @endif
                <div class="col-md-4 col-lg-4 col-xs-4 p-3">
                  <b>{{trans('admin.patient_id')}} :</b>
                  {!! @$appointments->patient->first_name !!}   {!! @$appointments->patient->father_name !!}  {!! @$appointments->patient->grand_name !!}
                </div>
                <div class="col-md-4 col-lg-4 col-xs-4 p-3">
                  <b>{{trans('admin.group_id')}} :</b>
                  {!! @$appointments->group->group_name !!}
                </div>
                <div class="col-md-4 col-lg-4 col-xs-4 p-3">
                  <b>{{trans('admin.user_id')}} :</b>
                  {!! $appointments->user->name !!}
                </div>
                <div class="col-md-4 col-lg-4 col-xs-4 p-3">
                  <b>{{trans('admin.period')}} :</b>
                  {!! trans('admin.'.$appointments->period) !!}
                </div>
                <div class="col-md-4 col-lg-4 col-xs-4 p-3">
                  <b>{{trans('admin.in_day')}} :</b>
                  {!! $appointments->in_day !!}
                </div>
                <div class="col-md-4 col-lg-4 col-xs-4 p-3">
                  <b>{{trans('admin.in_time')}} :</b>
                  {!! $appointments->in_time !!}
                </div>
                <div class="col-md-4 col-lg-4 col-xs-4 p-3">
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
                            <a href="{{ url('invoices/'.$invoice->id) }}">{{ trans('admin.invoice',['id'=>$invoice->id]) }} -
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
                            <a href="{{ url('diagnosis/'.$diagnos->id) }}">
                              {{ trans('admin.diagnos',['id'=>$diagnos->id]) }}
                            </a>
                          </li>
                          @endforeach
                        </ul>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <br /> <br />
              </div>
            </div>
          </div>
        </div>
        @push('js')
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
        @endpush
        @stop
