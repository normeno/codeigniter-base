<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>{{ $setting->full_name }} - {{ $ci->lang->line('subtitle') }}</title>

	<link href="{{ base_url('assets/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ base_url('assets/css/landing-page.css') }}" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
	<div class="container topnav">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand topnav" href="#">
				@if($setting->logo)
					<img src="{{ base_url("assets/img/companies/{$setting->logo}") }}" alt="" style="max-width: 25px; display: inline-block;">
				@endif
				{{ $setting->full_name }}
			</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#about">{{ $ci->lang->line('about') }}</a>
				</li>
				<li>
					<a href="#features">{{ $ci->lang->line('features') }}</a>
				</li>
				<li>
					<a href="#contact">{{ $ci->lang->line('contact') }}</a>
				</li>
				<li>
					<a href="{{ site_url('set_lang/english') }}" style="display: inline-block;">EN</a> | <a href="{{ site_url('set_lang/spanish') }}" style="display: inline-block;">ES</a>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>


<!-- Header -->
<a name="about"></a>
<div class="intro-header">
	<div class="container">

		<div class="row">
			<div class="col-lg-12">
				<div class="intro-message">
					<h1>{{ $setting->full_name }}</h1>
					<h3>{{ $ci->lang->line('subtitle') }}</h3>
					<hr class="intro-divider">
					<ul class="list-inline intro-social-buttons">
						<li>
							<a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
						</li>
					</ul>
				</div>
			</div>
		</div>

	</div>
	<!-- /.container -->

</div>
<!-- /.intro-header -->

<!-- Page Content -->

<a  name="features"></a>
<div class="content-section-a">

	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-sm-6">
				<hr class="section-heading-spacer">
				<div class="clearfix"></div>
				<h2 class="section-heading">{{ $ci->lang->line('admin_panel') }}:<br>{{ $ci->lang->line('agile_admin') }}</h2>
				<p class="lead">{{ $ci->lang->line('admin_panel_desc') }}</p>
			</div>
			<div class="col-lg-5 col-lg-offset-2 col-sm-6">
				<img class="img-responsive" src="{{ base_url('assets/img/demo/desktop.png') }}" alt="">
			</div>
		</div>

	</div>
	<!-- /.container -->

</div>
<!-- /.content-section-a -->

<div class="content-section-b">

	<div class="container">

		<div class="row">
			<div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
				<hr class="section-heading-spacer">
				<div class="clearfix"></div>
				<h2 class="section-heading">{{ $ci->lang->line('features') }}</h2>
				<p class="lead">
					<ul>
						<li><a href="https://codeigniter.com/">Codeigniter 3.1.0</a></li>
						<li><a href="https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc">HMVC</a></li>
						<li><a href="https://github.com/PhiloNL/Laravel-Blade">Blade Template</a></li>
						<li><a href="https://almsaeedstudio.com/preview">AdminLTE 2</a></li>
						<li><a href="https://github.com/benedmunds/CodeIgniter-Ion-Auth">Ion Auth</a></li>
						<li><a href="https://github.com/jamierumbelow/codeigniter-base-model">Codeigniter Base Model</a></li>
						<li><a href="https://github.com/zepernick/Codeigniter-DataTables">Codeigniter Datatables</a></li>
						<li><a href="http://plugins.krajee.com/file-input">Bootstrap File Input</a></li>
						<li><a href="https://github.com/normeno/ci_utilities">Codeigniter Uploader</a></li>
						<li><a href="https://github.com/vlucas/phpdotenv">Dotenv</a></li>
					</ul>
				</p>
			</div>
			<div class="col-lg-5 col-sm-pull-6  col-sm-6">
				<img class="img-responsive" src="{{ base_url('assets/img/demo/features.png') }}" alt="">
			</div>
		</div>

	</div>
	<!-- /.container -->

</div>
<!-- /.content-section-b -->

<a  name="contact"></a>
<div class="banner">

	<div class="container">

		<div class="row">
			<div class="col-lg-6">
				<h2>{{ "{$ci->lang->line('connect_to')} {$setting->full_name}" }}</h2>
			</div>
			<div class="col-lg-6">
				<ul class="list-inline banner-social-buttons">
					<li>
						<a href="https://github.com/normeno/codeigniter-base" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
					</li>
				</ul>
			</div>
		</div>

	</div>
	<!-- /.container -->

</div>
<!-- /.banner -->

<!-- Footer -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<p class="copyright text-muted small">Copyright &copy; <a href="http://www.normeno.com">Normeno</a> 2016. {{ $ci->lang->line('rights') }}</p>
			</div>
		</div>
	</div>
</footer>

	<script src="{{ base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
	<script src="{{ base_url('assets/js/bootstrap.min.js') }}"></script>

</body>

</html>
