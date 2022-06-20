<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="ar"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="ar"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="ar"> <!--<![endif]-->
<head>
	<!-- Basic Page Needs -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{{ !empty($title)?$title: setting()->sitename  }}</title>
	<meta name="description" content="description description description description">
	<meta name="author" content="author author author author">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- Bootstrap Style -->
	<link rel="stylesheet" href="{{url('design/style')}}/css/bootstrap-rtl.min.css">
	<link rel="stylesheet" href="{{url('design/style')}}/print_invoice.css">
	@if(app('l') != 'ar')
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	@endif

	<link rel="stylesheet" href="{{url('design/style')}}/css/bootstrap-theme-rtl.min.css">
	<!-- Fonts -->
	<link href="{{url('design/style')}}/fonts/fonts.css" rel="stylesheet">
	<!-- Fonticon Style -->
	<link href="{{url('design/style')}}/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- Favicons -->
	<link rel="shortcut icon" href="{{ it()->url(setting()->icon) }}" type="image/x-icon">
	<!-- Main Style -->
	<link rel="stylesheet" href="{{url('design/style')}}/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
	<!-- Responsive Style -->
	<link rel="stylesheet" href="{{url('design/style')}}/css/responsive.css">
	<style type="text/css">
	.datepicker-dropdown {max-width: 230px;}
	.datepicker {float: right}
	.datepicker.dropdown-menu {right:auto}
	</style>
	@if(app('l') == 'ar')

	@endif
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <link href="{{ url("design/admin_panel/assets/global/plugins/datatables/datatables.min.css") }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{url("design/admin_panel")}}/assets/global/css/components-rtl.min.css">
    <link rel="stylesheet" href="{{url("design/admin_panel")}}/assets/global/css/plugins-rtl.min.css">
    <link href="{{ url("design/admin_panel/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css") }}" rel="stylesheet" type="text/css" />
    @if(app("l") != 'ar')
    <link href="{{ url("design/admin_panel/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css") }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{url("design/admin_panel")}}/assets/global/css/components.min.css">
		<link rel="stylesheet" href="{{url("design/admin_panel")}}/assets/global/css/plugins.min.css">
		<style media="screen">
			.navbar-nav {
			}
			nav {
				    direction: ltr !important;
			}
			html {
	    text-align: left;
	    direction: ltr;
			}
			.navbar-nav-2 {
				float: right !important
			}
			</style>
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <link href="{{asset("css/bootstrap-datetimepicker.min.css")}}" rel="stylesheet" />
		<script type="text/javascript" src="{{url('design/style')}}/js/jquery-2.2.0.min.js"></script>
		<script type="text/javascript" src="{{url('design/style')}}/js/notify.js"></script>
		<script type="text/javascript" src="{{url('printer')}}/html5.min.js"></script>
		<script type="text/javascript" src="{{url('printer')}}/jQuery.print.js"></script>

{{--	<script src="{{url('design/admin_panel')}}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>--}}

	<style media="screen">
		.fade.in {
			opacity: 1;
			display: block !important;
		}
		.modal-backdrop, .modal-backdrop.fade.in {
    background-color: #3336!important;
		}
		.last-footer {
		    background-color: #030e1c;
		    color: #fff;
		    padding: 8px 15px;
		    display: flex;
		    justify-content: space-between;
		    margin-bottom: -2px;
		}
		.text-white {
		    color: #fff!important;
		}
		.portlet.light .dataTables_wrapper .dt-buttons {
			margin-top: 0;
			margin-bottom: 11px;
		}
		.dataTables_filter.col-md-6 {
			    width: 100% !important;
		}
	</style>
</head>
<body>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
