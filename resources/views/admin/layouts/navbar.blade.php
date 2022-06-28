<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="index.html" style="width: 100%; text-align: center;">
                <img src="{{url('design/admin_panel')}}/assets/layouts/layout4/img/logo-light.png" alt="logo" class="logo-default" /> </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE ACTIONS -->
        <!-- DOC: Remove "hide" class to enable the page header actions -->

        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
            <form class="search-form" action="page_general_search_2.html" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" placeholder="Search..." name="query">
                    <span class="input-group-btn">
                        <a href="javascript:;" class="btn submit">
                            <i class="fa fa-search"></i>
                        </a>
                    </span>
                </div>
            </form>
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">

                <ul class="nav navbar-nav pull-right">
                    <li class="separator hide"> </li>


                    <!-- END NOTIFICATION DROPDOWN -->
                    <li class="separator hide"> </li>
                    <!-- BEGIN INBOX DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="fa fa-envelope"></i>
                            <span class="badge badge-danger"> 4 </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>لديك
                                    <span class="bold">7 جديد</span> رسائل</h3>
                                <a href="app_inbox.html">عرض الكل</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                    <li>
                                        <a href="#">
                                            <span class="photo">
                                                <img src="" class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                <span class="from"> Lisa Wong </span>
                                                <span class="time">الآن  </span>
                                            </span>
                                            <span class="message">Vivamus، ولكن مؤلف Nibh Ligula.المؤلف نيبه ... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo">
                                                <img src="" class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                <span class="from"> Richard Doe </span>
                                                <span class="time">16 دقائق </span>
                                            </span>
                                            <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo">
                                                <img src="" class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                <span class="from"> Bob Nilson </span>
                                                <span class="time">2 ساعات </span>
                                            </span>
                                            <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo">
                                                <img src="" class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                <span class="from"> Lisa Wong </span>
                                                <span class="time">40 دقائق </span>
                                            </span>
                                            <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo">
                                                <img src="" class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                <span class="from"> Richard Doe </span>
                                                <span class="time">46 دقائق </span>
                                            </span>
                                            <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- END INBOX DROPDOWN -->
                    <li class="separator hide"> </li>
                    <!-- BEGIN   DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"> {{ admin()->user()->name }} </span>
                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                            <img alt="" class="img-circle" src="{{url('design/admin_panel')}}/assets/layouts/layout4/img/avatar9.jpg" /> </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="page_user_profile_1.html">
                                    <i class="fa fa-user"></i> الملف الشخصي </a>
                            </li>

                            <li>
                                <a href="{{ aurl('logout') }}">
                                    <i class="fa fa-key"></i> {{ trans('admin.logout') }} </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <li class="dropdown dropdown-extended quick-sidebar-toggler">
                        <span class="sr-only">تبديل الشريط الجانبي السريع</span>
                        <i class="fa fa-logout"></i>
                    </li>
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>

            </div>

            <!-- END TOP NAVIGATION MENU -->
        </div>
                        <div class="clearfix"> </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->

</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN SIDEBAR -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse">


<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
