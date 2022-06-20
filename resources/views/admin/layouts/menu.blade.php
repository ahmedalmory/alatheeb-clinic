<li class="nav-item start {{ active_link(null, 'active open') }} ">
    <a href="{{ aurl('') }}" class="nav-link nav-toggle">
        <i class="fa fa-home"></i>
        <span class="title">{{ trans('admin.dashboard') }}</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item start {{ active_link(null, ' open') }} ">
    <a href="{{ url('') }}" target="_blank" class="nav-link nav-toggle">
        <i class="fa fa-home"></i>
        <span class="title">{{ trans('admin.visit_web') }}</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item start {{ active_link('setting', 'active open') }} ">
    <a href="{{ aurl('setting') }}" class="nav-link nav-toggle">
        <i class="fa fa-cog"></i>
        <span class="title">{{ trans('admin.setting') }}</span>
        <span class="selected"></span>
    </a>
</li>

<li class="nav-item start {{ active_link('departments', 'active open') }} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-list"></i>
        <span class="title">{{ trans('admin.departments') }} </span>
        <span class="selected"></span>
        <span class="arrow {{ active_link('departments', 'open') }}"></span>
    </a>
    <ul class="sub-menu" style="{{ active_link('', 'block') }}">
        <li class="nav-item start {{ active_link('departments', 'active open') }}  ">
            <a href="{{ aurl('departments') }}" class="nav-link ">
                <i class="fa fa-list"></i>
                <span class="title">{{ trans('admin.departments') }} </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start">
            <a href="{{ aurl('departments/create') }}" class="nav-link ">
                <i class="fa fa-plus"></i>
                <span class="title"> {{ trans('admin.create') }} </span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>


<li class="nav-item start {{ active_link('relationship|nationalities', 'active open') }} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-venus-double"></i>
        <span class="title">{{ trans('admin.accessories') }} </span>
        <span class="selected"></span>
        <span class="arrow {{ active_link('relationship', 'open') }}"></span>
    </a>
    <ul class="sub-menu" style="{{ active_link('', 'block') }}">


        <li class="nav-item start {{ active_link('relationship', 'active open') }} ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-venus-double"></i>
                <span class="title">{{ trans('admin.relationship') }} </span>
                <span class="selected"></span>
                <span class="arrow {{ active_link('relationship', 'open') }}"></span>
            </a>
            <ul class="sub-menu" style="{{ active_link('', 'block') }}">
                <li class="nav-item start {{ active_link('relationship', 'active open') }}  ">
                    <a href="{{ aurl('relationship') }}" class="nav-link ">
                        <i class="fa fa-venus-double"></i>
                        <span class="title">{{ trans('admin.relationship') }} </span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start">
                    <a href="{{ aurl('relationship/create') }}" class="nav-link ">
                        <i class="fa fa-plus"></i>
                        <span class="title"> {{ trans('admin.create') }} </span>
                        <span class="selected"></span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item start {{ active_link('nationalities', 'active open') }} ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-paste"></i>
                <span class="title">{{ trans('admin.nationalities') }} </span>
                <span class="selected"></span>
                <span class="arrow {{ active_link('nationalities', 'open') }}"></span>
            </a>
            <ul class="sub-menu" style="{{ active_link('', 'block') }}">
                <li class="nav-item start {{ active_link('nationalities', 'active open') }}  ">
                    <a href="{{ aurl('nationalities') }}" class="nav-link ">
                        <i class="fa fa-paste"></i>
                        <span class="title">{{ trans('admin.nationalities') }} </span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start">
                    <a href="{{ aurl('nationalities/create') }}" class="nav-link ">
                        <i class="fa fa-plus"></i>
                        <span class="title"> {{ trans('admin.create') }} </span>
                        <span class="selected"></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item start {{ active_link('cities', 'active open') }} ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-paste"></i>
                <span class="title">{{ trans('admin.cities') }} </span>
                <span class="selected"></span>
                <span class="arrow {{ active_link('cities', 'open') }}"></span>
            </a>
            <ul class="sub-menu" style="{{ active_link('', 'block') }}">
                <li class="nav-item start {{ active_link('cities', 'active open') }}  ">
                    <a href="{{ aurl('cities') }}" class="nav-link ">
                        <i class="fa fa-paste"></i>
                        <span class="title">{{ trans('admin.cities') }} </span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start">
                    <a href="{{ aurl('cities/create') }}" class="nav-link ">
                        <i class="fa fa-plus"></i>
                        <span class="title"> {{ trans('admin.create') }} </span>
                        <span class="selected"></span>
                    </a>
                </li>
            </ul>
        </li>



    </ul>
</li>


<li class="nav-item start {{ active_link('patients', 'active open') }} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-files-o"></i>
        <span class="title">{{ trans('admin.patients') }} </span>
        <span class="selected"></span>
        <span class="arrow {{ active_link('patients', 'open') }}"></span>
    </a>
    <ul class="sub-menu" style="{{ active_link('', 'block') }}">
        <li class="nav-item start {{ active_link('patients', 'active open') }}  ">
            <a href="{{ aurl('patients') }}" class="nav-link ">
                <i class="fa fa-files-o"></i>
                <span class="title">{{ trans('admin.patients') }} </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start">
            <a href="{{ aurl('patients/create') }}" class="nav-link ">
                <i class="fa fa-plus"></i>
                <span class="title"> {{ trans('admin.create') }} </span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>



<li class="nav-item start {{ active_link('groups', 'active open') }} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-group"></i>
        <span class="title">{{ trans('admin.groups') }} </span>
        <span class="selected"></span>
        <span class="arrow {{ active_link('groups', 'open') }}"></span>
    </a>
    <ul class="sub-menu" style="{{ active_link('', 'block') }}">
        <li class="nav-item start {{ active_link('groups', 'active open') }}  ">
            <a href="{{ aurl('groups') }}" class="nav-link ">
                <i class="fa fa-group"></i>
                <span class="title">{{ trans('admin.groups') }} </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start">
            <a href="{{ aurl('groups/create') }}" class="nav-link ">
                <i class="fa fa-plus"></i>
                <span class="title"> {{ trans('admin.create') }} </span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item start {{ active_link('users', 'active open') }} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-group"></i>
        <span class="title">{{ trans('admin.users') }} </span>
        <span class="selected"></span>
        <span class="arrow {{ active_link('users', 'open') }}"></span>
    </a>
    <ul class="sub-menu" style="{{ active_link('', 'block') }}">
        <li class="nav-item start {{ active_link('users', 'active open') }}  ">
            <a href="{{ aurl('users') }}" class="nav-link ">
                <i class="fa fa-group"></i>
                <span class="title">{{ trans('admin.users') }} </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start">
            <a href="{{ aurl('users/create') }}" class="nav-link ">
                <i class="fa fa-plus"></i>
                <span class="title"> {{ trans('admin.create') }} </span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item start {{ active_link('forms', 'active open') }} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-forumbee"></i>
        <span class="title">{{ trans('admin.forms') }} </span>
        <span class="selected"></span>
        <span class="arrow {{ active_link('forms', 'open') }}"></span>
    </a>
    <ul class="sub-menu" style="{{ active_link('', 'block') }}">
        <li class="nav-item start {{ active_link('forms', 'active open') }}  ">
            <a href="{{ aurl('forms') }}" class="nav-link ">
                <i class="fa fa-forumbee"></i>
                <span class="title">{{ trans('admin.forms') }} </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start">
            <a href="{{ aurl('forms/create') }}" class="nav-link ">
                <i class="fa fa-plus"></i>
                <span class="title"> {{ trans('admin.create') }} </span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item start {{ active_link('pages', 'active open') }} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-file-text"></i>
        <span class="title">{{ trans('admin.pages') }} </span>
        <span class="selected"></span>
        <span class="arrow {{ active_link('pages', 'open') }}"></span>
    </a>
    <ul class="sub-menu" style="{{ active_link('', 'block') }}">
        <li class="nav-item start {{ active_link('pages', 'active open') }}  ">
            <a href="{{ aurl('pages') }}" class="nav-link ">
                <i class="fa fa-file-text"></i>
                <span class="title">{{ trans('admin.pages') }} </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start">
            <a href="{{ aurl('pages/create') }}" class="nav-link ">
                <i class="fa fa-plus"></i>
                <span class="title"> {{ trans('admin.create') }} </span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item start {{ active_link('appointments', 'active open') }} ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-clock-o"></i>
        <span class="title">{{ trans('admin.appointments') }} </span>
        <span class="selected"></span>
        <span class="arrow {{ active_link('appointments', 'open') }}"></span>
    </a>
    <ul class="sub-menu" style="{{ active_link('', 'block') }}">
        <li class="nav-item start {{ active_link('appointments', 'active open') }}  ">
            <a href="{{ aurl('appointments') }}" class="nav-link ">
                <i class="fa fa-clock-o"></i>
                <span class="title">{{ trans('admin.appointments') }} </span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start">
            <a href="{{ aurl('appointments/create') }}" class="nav-link ">
                <i class="fa fa-plus"></i>
                <span class="title"> {{ trans('admin.create') }} </span>
                <span class="selected"></span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item start {{ active_link('invoices', 'active open') }} ">
    <a href="javascript:;" class="nav-link nav-toggle">
         <i class="fa fa-files-o"></i> 
         <span class="title">{{trans('admin.invoices')}} </span> 
         <span class="selected"></span> 
         <span class="arrow {{active_link('invoices','open')}}"></span> 
         </a> 
         <ul class="sub-menu" style="{{active_link('','block')}}"> 
         <li class="nav-item start {{active_link('invoices','active open')}}  "> 
         <a href="{{aurl('invoices')}}" class="nav-link "> 
         <i class="fa fa-files-o"></i> 
         <span class="title">{{trans('admin.invoices')}}  </span> 
         <span class="selected"></span> 
         </a> 
         </li> 
         <li class="nav-item start"> 
         <a href="{{ aurl('invoices/create') }}" class="nav-link "> 
         <i class="fa fa-plus"></i> 
         <span class="title"> {{trans('admin.create')}}  </span> 
         <span class="selected"></span> 
         </a> 
         </li> 
         </ul> 
         </li> 

         <li class="nav-item start {{active_link('diagnosis','active open')}} "> 
         <a href="javascript:;" class="nav-link nav-toggle"> 
         <i class="fa fa-wheelchair"></i> 
         <span class="title">{{trans('admin.diagnosis')}} </span> 
         <span class="selected"></span> 
         <span class="arrow {{active_link('diagnosis','open')}}"></span> 
         </a> 
         <ul class="sub-menu" style="{{active_link('','block')}}"> 
         <li class="nav-item start {{active_link('diagnosis','active open')}}  "> 
         <a href="{{aurl('diagnosis')}}" class="nav-link "> 
         <i class="fa fa-wheelchair"></i> 
         <span class="title">{{trans('admin.diagnosis')}}  </span> 
         <span class="selected"></span> 
         </a> 
         </li> 
         <li class="nav-item start"> 
         <a href="{{ aurl('diagnosis/create') }}" class="nav-link "> 
         <i class="fa fa-plus"></i> 
         <span class="title"> {{trans('admin.create')}}  </span> 
         <span class="selected"></span> 
         </a> 
         </li> 
         </ul> 
         </li> 
         
         <li class="nav-item start {{active_link('slides','active open')}} "> 
         <a href="javascript:;" class="nav-link nav-toggle"> 
         <i class="fa fa-wheelchair"></i> 
         <span class="title">{{trans('admin.slides')}} </span> 
         <span class="selected"></span> 
         <span class="arrow {{active_link('slides','open')}}"></span> 
         </a> 
         <ul class="sub-menu" style="{{active_link('','block')}}"> 
         <li class="nav-item start {{active_link('slides','active open')}}  "> 
         <a href="{{aurl('slides')}}" class="nav-link "> 
         <i class="fa fa-wheelchair"></i> 
         <span class="title">{{trans('admin.slides')}}  </span> 
         <span class="selected"></span> 
         </a> 
         </li> 
         <li class="nav-item start"> 
         <a href="{{ aurl('slides/create') }}" class="nav-link "> 
         <i class="fa fa-plus"></i> 
         <span class="title"> {{trans('admin.create')}}  </span> 
         <span class="selected"></span> 
         </a> 
         </li> 
         </ul> 
         </li> 
