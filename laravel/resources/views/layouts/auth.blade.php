<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<title>@yield('page-title')</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="Smart Financial Dashboard for Genius Geeky Miners" />
		<meta name="author" content="SavoyCorporation" />
		<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" >

		<!-- Bootstrap 3.3.7 -->
		<link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
		<!-- Ionicons -->
		<link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
		<!-- jvectormap -->
		<link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
		<!-- Theme style -->
		<link href="{{ asset('dist/css/AdminLTE.min.css') }}" rel='stylesheet' type='text/css' />
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		   folder instead of downloading all of them to reduce the load. -->
		<link href="{{ asset('dist/css/skins/_all-skins.min.css') }}" rel='stylesheet' type='text/css' />

  		<!-- Google Font -->
  		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

		<link href="{{ asset('dist/css/AdminLTE.min.css') }}" rel='stylesheet' type='text/css' />


		<link rel="stylesheet" type="text/css" href="{{ asset('css/base.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('css/demo5.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('css/pater.css') }}" />

		<!--[if lte IE 8]><script src="js/admin/ie/html5shiv.js"></script><![endif]-->
		<!--[if lte IE 8]><link href="css/admin/ie8.css" rel='stylesheet' type='text/css' /><![endif]-->
		<!--[if lte IE 9]><link href="css/admin/ie9.css" rel='stylesheet' type='text/css' /><![endif]-->

	</head>
	
	<body class="demo-5">
	    <main>
	        <div class="content">
	            <canvas class="scene scene--full" id="scene"></canvas>
	            <div class="content__inner">
	                <!-- /.auth-box -->
					@yield('content')
	            </div>
        	</div>
    	</main>                
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

	<!-- Background -->
	{{ Html::script('js/demo.js') }}
	{{ Html::script('js/three.min.js') }}
	{{ Html::script('js/perlin.js') }}
	{{ Html::script('js/TweenMax.min.js') }}
	{{ Html::script('js/demo5.js') }}
	
	<!--[if lte IE 8]>{{ Html::script('js/admin/ie/respond.min.js') }}<![endif]-->

</html>
