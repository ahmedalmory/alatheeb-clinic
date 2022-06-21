@extends('admin.index')
@section('content')
<style media="screen">
.dashboard-stat2 .display .number small {
  font-size: 13px;
  color: #ffffff;
}
.dashboard-stat2 {
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -ms-border-radius: 4px;
    -o-border-radius: 4px;
    border-radius: 4px;
    background: #fff;
    padding: 15px 15px 1px;
}
.dashboard-stat2 .display .icon {
    display: inline-block;
    float: left;
    padding: 7px 0 0;
    position: absolute;
    top: 17px;
    left: 30px;
}
.text-white {
  color: #fff
}
.dashboard-stat2 .display .icon>i {
    color: #eef1f5;
    font-size: 35px;
}
.dashboard-stat2 .display .number h3 {
      font-size: 34px;
}
</style>
<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{trans('admin.dashboard')}}</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                </div>
            </div>
            <div class="portlet-body row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered" style="background-color: #1c7d7e;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Patient::count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small> المرضى الاجمالى</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-wheelchair"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered" style="background-color: #795548;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\User::count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small> الموظفين</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered" style="background-color: #9e9e9e;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Group::count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small>مجموعات الموظفين</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered" style="background-color: #009688;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Admin::count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small> المشرفين</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered"  style="background-color: #f44336;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Group::count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small> مجموعات الموظفين</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-group"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered" style="background-color: #8bc34a;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Page::count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small> الصفحات الخاصة</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file-text-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered"  style="background-color: #0093d0;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Forms::count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small> النماذج</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file-text"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered"  style="background-color: #cddc39;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Department::count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small>اقسام العيادات</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-list-ol"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered" style="background-color: #f4ab36;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Appoint::count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small> المواعيد الاجمالى</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered" style="background-color: #b04646;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Appoint::where('attend_status','pending')->count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small> المواعيد بالانتظار</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered" style="background-color: #c060e4;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Appoint::where('attend_status','unattended')->count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small> المواعيد - لم يحضر</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered" style="background-color: #60b7e4;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Appoint::where('attend_status','attend')->count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small> المواعيد - حضر</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered" style="background-color: #60b7e4;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Appoint::where('attend_status','confirmed')->count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small> المواعيد - مؤكدة</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered" style="background-color: #369f67;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Diagnos::count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small>التشخيصات</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-wheelchair"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered" style="background-color: #36419f;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Invoice::count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small>كل الفواتير</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-files-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered"  style="background-color: #9f369f;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Invoice::where('invoice_status','paid')->count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small>الفواتير المسددة</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-files-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered"   style="background-color: #9f6d36;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Invoice::where('invoice_status','unpaid')->count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small>الفواتير غير المسددة</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-files-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered"  style="background-color: #055818;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Invoice::where('invoice_status','paid')->where('pay_at','visa')->count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small>الفواتير المسددة - بالبطاقة الشبكةة</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-files-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered" style="background-color: #3d3d3d;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Invoice::where('invoice_status','paid')->where('pay_at','cash')->count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small>الفواتير المسددة - نقدا / كاش</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-files-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <div class="dashboard-stat2 bordered" style="background-color: #054f58;">
                        <div class="display">
                            <div class="number">
                                <h3 class="text-white">
                                <span>{{ App\Models\Diagnos::count() }}</span>
                                <small class="text-white"></small>
                                </h3>
                                <small>التشخيصات</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-wheelchair"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE BASE CONTENT -->
@endsection
