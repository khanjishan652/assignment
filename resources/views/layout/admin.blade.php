<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demo.dashboardpack.com/admindek-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Dec 2024 08:22:26 GMT -->

<head>
    <title>Backend | @yield('title')</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="" />
    <meta name="keywords"
        content="">
    <meta name="author" content="" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('admin/images/favicon.ico')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="../../fonts.googleapis.com/css0f7c.css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="../../fonts.googleapis.com/css1180.css?family=Quicksand:500,700" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/bower_components/bootstrap/css/bootstrap.min.css')}}">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{asset('admin/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
    <!-- feather icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/icon/feather/css/feather.css')}}">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/font-awesome-n.min.css')}}">
    <!-- Chartlist chart css -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/chartist/css/chartist.css')}}" type="text/css" media="all">
    <!-- sweet alert framework -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/bower_components/sweetalert/css/sweetalert.css')}}">
     <!-- Data Table Css -->
     <link rel="stylesheet" type="text/css" href="{{asset('admin/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/pages/data-table/extensions/buttons/css/buttons.dataTables.min.css')}}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/widget.css')}}">
</head>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">
                @include('includes.header')
               
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        @include('includes.sidebar')
                        @yield('content');
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('admin/bower_components/jquery/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/bower_components/popper.js/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- waves js -->
    <script src="{{asset('admin/pages/waves/js/waves.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{asset('admin/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
    <!-- Float Chart js -->
    <script src="{{asset('admin/pages/chart/float/jquery.flot.js')}}"></script>
    <script src="{{asset('admin/pages/chart/float/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('admin/pages/chart/float/curvedLines.js')}}"></script>
    <script src="{{asset('admin/pages/chart/float/jquery.flot.tooltip.min.js')}}"></script>
    <!-- Chartlist charts -->
    <script src="{{asset('admin/bower_components/chartist/js/chartist.js')}}"></script>
    <!-- sweet alert js -->
    <script type="text/javascript" src="{{asset('admin/bower_components/sweetalert/js/sweetalert.min.js')}}"></script>
    <!-- amchart js -->
    <script src="{{asset('admin/pages/widget/amchart/amcharts.js')}}"></script>
    <script src="{{asset('admin/pages/widget/amchart/serial.js')}}"></script>
    <script src="{{asset('admin/pages/widget/amchart/light.js')}}"></script>


    <script type="text/javascript" src="{{asset('admin/pages/dashboard/custom-dashboard.min.js')}}"></script>

     <!-- data-table js -->
     <script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/pages/data-table/extensions/buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('admin/pages/data-table/js/jszip.min.js')}}"></script>
    <script src="{{asset('admin/pages/data-table/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/pages/data-table/js/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin/pages/data-table/extensions/buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- Custom js -->
    <script src="{{asset('admin/pages/data-table/js/data-table-custom.js')}}"></script>
    <script src="{{asset('admin/js/pcoded.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('admin/js/vertical/vertical-layout.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/script.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/admin.js')}}"></script>

    @stack('after-scripts')
</body>

</html>