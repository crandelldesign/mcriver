<title>{{isset($title) ? $title : ''}}</title>
<meta name="description" content="{{isset($description) ? $description : ''}}">

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link href="{{url('/')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Arimo:400,700,400italic,700italic|Balthazar' rel='stylesheet' type='text/css'>
<link href="{{url('/')}}/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="{{url('/')}}/css/style-sm.css" rel="stylesheet" media="all  and (min-width: 768px)" />
<!--<link href="{{url('/')}}/css/style-md.css" rel="stylesheet" media="screen  and (min-width: 992px)" />-->
<link href="{{url('/')}}/css/style-lg.css" rel="stylesheet" media="all  and (min-width: 1200px)" />
<link href="{{url('/')}}/css/style-xs.css" rel="stylesheet" media="all  and (max-width: 768px)" />

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	<script src="{{url('/')}}/js/html5shiv.min.js"></script>
	<script src="{{url('/')}}/js/respond.min.js"></script>
	<style>
	</style>
<![endif]-->