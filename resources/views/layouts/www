<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>
<link href="{{ url('/') }}/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"><!-- Loading Bootstrap -->
<link href="{{ url('/') }}/dist/css/flat-ui.min.css" rel="stylesheet"><!-- Loading Flat UI -->
<link href="{{ url('/') }}/css/starter-template.css" rel="stylesheet"><!--Bootstrap theme(Starter)-->

<link rel="shortcut icon" href="/dist/img/favicon.ico">

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<nav class="navbar navbar-inverse .justify-content-center">
<div class="container">
<div class="navbar-header">
<center>
<a class="navbar-brand" href="{{ route('top') }}"style="position: absolute; left: 45%; top: 0.5%"/>nAVigator</a>
</center>
<div id="navbar" class="collapse navbar-collapse">
<ul class="nav navbar-nav">
</ul>
</div><!--/.nav-collapse -->
</div>
</nav>

<div class="container">
@yield('content')
</div><!-- /.container -->

<!-- footer -->
<footer class="footer">
<div class="container">
</div>
</footer>

<script src="{{ url('/') }}/dist/js/vendor/jquery.min.js"></script>
<script src="{{ url('/') }}/dist/js/vendor/video.js"></script>
<script src="{{ url('/') }}/dist/js/flat-ui.min.js"></script>

<script src="{{ url('/') }}/assets/js/prettify.js"></script>
<script src="{{ url('/') }}/assets/js/application.js"></script>

<script>
videojs.options.flash.swf = "{{ url('/') }}/dist/js/vendors/video-js.swf"
</script>
</body>
</html>
