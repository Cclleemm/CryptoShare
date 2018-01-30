<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <title>@yield('page-title')</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Smart Financial Dashboard for Genius Geeky Miners"/>
    <meta name="author" content="SavoyCorporation"/>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Theme style -->
    <link href="{{ asset('dist/css/AdminLTE.min.css') }}" rel='stylesheet' type='text/css'/>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('dist/css/skins/_all-skins.min.css') }}" rel='stylesheet' type='text/css'/>

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link href="{{ asset('dist/css/AdminLTE.min.css') }}" rel='stylesheet' type='text/css'/>
    <link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel='stylesheet' type='text/css'/>
    <link rel="stylesheet"
          href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

    <!--[if lte IE 8]>
    <script src="js/admin/ie/html5shiv.js"></script><![endif]-->
    <!--[if lte IE 8]>
    <link href="css/admin/ie8.css" rel='stylesheet' type='text/css'/><![endif]-->
    <!--[if lte IE 9]>
    <link href="css/admin/ie9.css" rel='stylesheet' type='text/css'/><![endif]-->

</head>


<body class="hold-transition skin-black sidebar-mini">

<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="{{url('/')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>C</b>Cs</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Crypto</b>Charts</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
	                                         document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endguest
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="img/verge.jpg" class="img-circle" alt="verge Image">
                </div>
                <div class="pull-left info">
                    <p>Verge Mining Rig</p>
                    <a href="#"><i class="fa fa-home"></i> Saint Alban Leysse</a>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MENU</li>
                <li class="{{ Route::currentRouteNamed('home') ? 'active' : '' }}"><a href="{{url('/')}}"><i
                                class="fa fa-dashboard"></i> <span>Statistiques</span></a></li>
                <li class="{{ Route::currentRouteNamed('recipient.index') ? 'active' : '' }}"><a
                            href="{{url('/recipient')}}"><i class="fa fa-users"></i> <span>Bénéficiaires</span></a>
                </li>
                <li class="{{ Route::currentRouteNamed('transaction.index') ? 'active' : '' }}"><a
                            href="{{url('/transaction')}}"><i class="fa fa-exchange"></i> <span>Transactions</span></a>
                </li>

                @guest
                    @else
                        <li class="{{ Route::currentRouteNamed('configuration.index') ? 'active' : '' }}"><a
                                    href="{{ url('/configuration') }}"><i class="fa fa-gear"></i>
                                <span>Configuration</span></a></li>
                        @endguest
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>


    @yield('content')


    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 0.0.1
        </div>
        <strong>Copyright &copy; {{date('Y')}} SavoyCorporation.</strong> All rights
        reserved.
    </footer>

</div>
</body>


<!--Script -->
<!-- jQuery 3 -->
{{ Html::script('bower_components/jquery/dist/jquery.min.js') }}
<!-- Bootstrap 3.3.7 -->
{{ Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}
<!-- FastClick -->
{{ Html::script('bower_components/fastclick/lib/fastclick.js') }}
<!-- AdminLTE App -->
{{ Html::script('dist/js/adminlte.min.js') }}
<!-- Sparkline -->
{{ Html::script('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}
<!-- jvectormap  -->
{{ Html::script('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}
{{ Html::script('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}
<!-- SlimScroll -->
{{ Html::script('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}
<!-- ChartJS -->
{{ Html::script('bower_components/Chart.js/Chart.js') }}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{ Html::script('dist/js/pages/dashboard2.js') }}
<!-- AdminLTE for demo purposes -->
{{ Html::script('dist/js/demo.js') }}
	
	<!--[if lte IE 8]>{{ Html::script('js/admin/ie/respond.min.js') }}<![endif]-->

@yield('extra-script')

</html>
