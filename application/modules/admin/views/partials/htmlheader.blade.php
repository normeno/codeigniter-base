<meta charset="UTF-8">
<base href="{{ base_url() }}" />
<title> @yield('htmlheader_title', 'Your title here') </title>
<meta name="{{ $csrf['name'] }}" content="{{ $csrf['hash'] }}">
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" />

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />

<link href="assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />

<link href="assets/css/skins/skin-green-light.css" rel="stylesheet" type="text/css" />

<link href="assets/plugins/iCheck/square/green.css" rel="stylesheet" type="text/css" />

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<link href="assets/bower/alertify.js/themes/alertify.core.css" rel="stylesheet" type="text/css" />
<link href="assets/bower/alertify.js/themes/alertify.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="assets/bower/imagelightbox/dist/imagelightbox.min.css" rel="stylesheet" type="text/css" />

<link href="assets/bower/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/bower/datatables.net-select-bs/css/select.bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="assets/bower/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet" type="text/css" />

@if($debugbar_renderer)
    {!! $debugbar_renderer->renderHead() !!}
@endif
<style>
    .container {
        width: 100%;
    }

    .left-25 {
        margin-left: 25px;
    }

    .top-10 {
        margin-top: 10px;
    }
</style>

<script>
    var siteUrl = "{{ site_url() }}",
        baseUrl = "{{ base_url() }}"
</script>

@stack('css')