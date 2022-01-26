<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('images/hospital.ico')}}" type="image/ico"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Add more and remove button -->

    <title>VIP TechnoLabs</title>

    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">

    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Datatables -->
    <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{route('index')}}" class="site_title"><i class="fa fa-hospital-o"></i> <span>VIP TechnoLabs</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{asset('upload_file/'.$hospital->logo ?? 'default.png')}}" alt="..."
                             class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <h2>{{ $hospital->name }}</h2>
                        <span>Medical Locker</span>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a href=""><i class="fa fa-home"></i> Dashboard</a></li>
                        </ul>

                        @if(Auth::guard('hospital')->check())
                        <ul class="nav side-menu">
                            <li><a href=""><i class="fa fa-user-md"></i> Doctors</a></li>
                        </ul>
                        <ul class="nav side-menu">
                            <li><a href="{{route('staff.index')}}"><i class="fa fa-user"></i>Staff</a></li>
                        </ul>
                        @endif

                        <ul class="nav side-menu">
                            <li><a href=""><i class="fa fa-users"></i> Patients</a></li>
                        </ul>

                        @if(Auth::guard('hospital')->check())
                        <ul class="nav side-menu">
                            <li><a href=""><i class="fa fa-clock-o"></i> Activity</a></li>
                        </ul>
                        @endif

                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">


                    <a href="" data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>

                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a href="{{route('logout')}}" data-toggle="tooltip" data-placement="top" title="Logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                    <ul class=" navbar-right">
                        <li class="nav-item dropdown open" style="padding-left: 15px;">
                            @if(Auth::guard('hospital')->check())
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                   id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{asset('upload_file/'.Auth::guard('hospital')->user()->logo)}}"
                                         alt="{{Auth::guard('hospital')->user()->name}}">{{Auth::guard('hospital')->user()->name}}
                                </a>
                            @elseif (Auth::check())
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                   id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{asset('upload_file/'.Auth::user()->avatar)}}"
                                         alt="{{Auth::user()->name}}">{{Auth::user()->name}}
                                </a>
                            @endif
                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="javascript:;"> Profile</a>
                                <a class="dropdown-item" href="javascript:;">
                                    <span class="badge bg-red pull-right">50%</span>
                                    <span>Settings</span>
                                </a>
                                <a class="dropdown-item" href="javascript:;">Help</a>
                                <a class="dropdown-item" href="{{route('logout')}}"><i
                                        class="fa fa-sign-out pull-right"></i> Log
                                    Out</a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                @yield('content')
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    function disabledSubmitBtn(form) {
        $(form).find(':input[type=submit]').prop('disabled', true);
        $(form).find(':input[type=radio]:not(:checked)').attr("disabled", true);
    }
</script>
<script>
    function disabledSubmitBtn(form) {
        $(form).find(':input[type=submit]').prop('disabled', true);
        // $(form).find(':input[type=radio]:not(:checked)').attr("disabled", true);
    }
</script>
<!-- Bootstrap -->
<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

<!-- DataTables -->
<script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
<script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script>

<!-- NProgress -->
<script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>

{{--<!-- morris.js -->--}}
<script src="{{asset('vendors/raphael/raphael.min.js')}}"></script>
<script src="{{asset('vendors/morris.js/morris.min.js')}}"></script>

{{--<!-- Chart.js -->--}}
<script src="{{asset('vendors/Chart.js/dist/Chart.min.js')}}"></script>

{{--<!-- gauge.js -->--}}
<script src="{{asset('vendors/gauge.js/dist/gauge.min.js')}}"></script>

{{--<!-- bootstrap-progressbar -->--}}
<script src="{{asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>

{{--<!-- iCheck -->--}}
<script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>

{{--<!-- Skycons -->--}}
<script src="{{asset('vendors/skycons/skycons.js')}}"></script>

{{--<!-- Flot -->--}}
<script src="{{asset('vendors/Flot/jquery.flot.js')}}"></script>
<script src="{{asset('vendors/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('vendors/Flot/jquery.flot.time.js')}}"></script>
<script src="{{asset('vendors/Flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('vendors/Flot/jquery.flot.resize.js')}}"></script>

{{--<!-- Flot plugins -->--}}
<script src="{{asset('vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
<script src="{{asset('vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
<script src="{{asset('vendors/flot.curvedlines/curvedLines.js')}}"></script>

{{--<!-- DateJS -->--}}
<script src="{{asset('vendors/DateJS/build/date.js')}}"></script>

{{--<!-- JQVMap -->--}}
<script src="{{asset('vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
<script src="{{asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<script src="{{asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>

{{--<!-- bootstrap-daterangepicker -->--}}
<script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

{{--<!-- jQuery Tags Input -->--}}
<script src="{{asset('vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{asset('build/js/custom.min.js')}}"></script>

<!--Change Email Js-->
<script src="{{ asset('js/change_email.js') }}"></script>

<!--Change Mobile No Js-->
<script src="{{ asset('js/change_mobile_no.js') }}"></script>

<!--Change Status Js-->
<script src="{{ asset('js/change_status.js') }}"></script>

<!--Change password Js-->
<script src="{{ asset('js/change_password.js') }}"></script>

<!--Validation-->
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/custom_validation_rules.js') }}"></script>
<script src="{{ asset('js/validation.js') }}"></script>
</body>

</html>

