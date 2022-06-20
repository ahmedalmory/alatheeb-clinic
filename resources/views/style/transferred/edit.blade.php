
@extends('style.index')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-lg-offset-2">
            <div class="datespage">
                <div class="title">اعادة تحويل مريض</div>
                <div class="content">
                    <div class="adddate">
                        {!! Form::open(['url'=>url('/transferred/'.$appointment->id),'method'=>'put','id'=>'appointments','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
                        <div class="form-group">
                            {!! Form::label('dep_id',"العيادة",['class'=>'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                <select name="dep_id" class="form-control">
                                    @foreach(\App\Model\Department::all() as $dep)
                                        <option {{$dep->id == $appointment->dep_id ? "selected" : ""}} value="{{$dep->id}}">{{$dep->dep_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('dep_id',"الطبيب",['class'=>'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                <select name="user_id" class="form-control">
                                    @foreach(\App\User::query()->where('group_id',1)->get() as $user)
                                        <option {{$user->id == $appointment->user_id ? "selected" : ""}} value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('attend_status',trans('admin.attend_status'),['class'=>'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::select('attend_status',['pending'=>trans('admin.pending'),'confirmed'=>trans('admin.confirmed'),'unattended'=>trans('admin.unattended'),'attended'=>trans('admin.attended'),],$appointment->attend_status,['class'=>'form-control','placeholder'=>trans('admin.attend_status')]) !!}
                            </div>
                        </div>


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            {!! Form::submit(trans('admin.save'),['class'=>'btn btn-success']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div><!-- end adddate -->
                </div><!-- end content -->
            </div><!-- end datespage -->
        </div><!-- end col-lg-2 -->
    </div><!-- end row -->

@stop
