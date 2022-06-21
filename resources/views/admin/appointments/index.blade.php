@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form>
                        <div class="form-body p-2 m-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <select name="department_id" class="form-control" style="padding: 0">
                                        <option value="">كل العيادات</option>
                                        @foreach(\App\Models\Department::all() as $department)
                                            <option {{request()->department_id == $department->id ? "selected":""}} value="{{$department->id}}">{{$department->dep_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="user_id" class="form-control" style="padding: 0">
                                        <option value="">كل الاطباء</option>
                                        @foreach(\App\Models\User::query()->where('group_id',1)->get() as $user)
                                            <option {{request()->user_id == $user->id ? "selected":""}} value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" name="period" id="period">
                                        <option value="">كل الفترات</option>
                                        <option {{request()->period == "morning" ? "selected":""}} value="morning">الصباحية</option>
                                        <option {{request()->period == "evening" ? "selected":""}} value="evening">المسائية</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-success">فلتر</button>
                            <hr>
                        </div>

                    </form>
                    <div class="table-responsivee">
                        {!! Form::open([
                        "method" => "post",
                        "url" => [aurl('/appointments/multi_delete')]
                        ]) !!}
                        {!! $dataTable->table(["class"=> "table table-striped table-bordered table-hover table-checkable dataTable no-footer"],true) !!}
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
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
    </div>
    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush
    {!! Form::close() !!}
@stop
