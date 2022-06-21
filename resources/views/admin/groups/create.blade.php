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
                        <a href="{{aurl('groups')}}"
                           class="btn btn-circle btn-icon-only btn-default"
                           tooltip="{{trans('admin.show_all')}}"
                           title="{{trans('admin.show_all')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen"
                           href="#"
                           data-original-title="{{trans('admin.fullscreen')}}"
                           title="{{trans('admin.fullscreen')}}">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12">

                        {!! Form::open(['url'=>aurl('/groups'),'id'=>'groups','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
                        <div class="form-group">
                            {!! Form::label('group_name',trans('admin.group_name'),['class'=>'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('group_name',old('group_name'),['class'=>'form-control','placeholder'=>trans('admin.group_name')]) !!}
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-header">
                                صلاحيات المجموعة
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>صلاحيات عامة</h4>
                                        <p class="text-danger">
                                            لا يمكن للموظف التعديل او التحكم في قسم بدون صلاحية التصفح الخاصة بالقسم
                                            مثال : (تصفح المنتجات) القسم = المنتجات
                                        </p>
                                    </div>
                                    @foreach(trans('permissions.departments') as $department => $name)
                                        @foreach(trans('permissions.actions') as $action => $title)
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input name="permissions[{{$department}}][{{$action}}]" class="" type="hidden" value="0">
                                                    <input id="{{$department}}-{{$action}}" name="permissions[{{$department}}][{{$action}}]" class="" type="checkbox" value="1">
                                                    <label for="{{$department}}-{{$action}}">  {{$title}} {{$name}} </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                        <div class="col-md-12">
                                            <h4>صلاحيات خاصة</h4>
                                        </div>
                                    @foreach(trans('permissions.specials') as $action => $title)
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input name="permissions[specials][{{$action}}]" class="" type="hidden" value="0">
                                                <input id="specials-{{$action}}" name="permissions[specials][{{$action}}]" class="" type="checkbox" value="1">
                                                <label for="specials-{{$action}}">  {{$title}} </label>
                                            </div>
                                        </div>
                                    @endforeach
                                        <div class="col-md-12">
                                            <h4>صلاحيات التصنيفات</h4>
                                        </div>
                                    @foreach(\App\Models\Tasnefat::all() as $category)
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input name="permissions[categories][{{$category->id}}]" class="" type="hidden" value="0">
                                                <input id="categories-{{$category->name}}" name="permissions[categories][{{$category->id}}]" class="" type="checkbox" value="1">
                                                <label for="categories-{{$category->name}}">  {{$category->cat_name}} </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            {!! Form::submit(trans('admin.add'),['class'=>'btn btn-success']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@stop

