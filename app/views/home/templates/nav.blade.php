@if(!isset($active_page))
<?php $active_page = ''; ?>
@endif
<div class="site-container">
	<header class="header">
		<div class="container-fluid logo-container">
			<a href="{{url('/')}}"><img class="img-responsive center-block" src="{{url('/')}}/img/logo-default-gold.png" alt="McRiver"></a>
		</div>
		<nav class="navbar navbar-default">
		  	<div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
			      	</button>
			      	<a class="navbar-brand" href="{{url('/')}}"><img class="img-responsive center-block" src="{{url('/')}}/img/logo-default.png" alt="McRiver"></a>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="mainNav">
				    <ul id="menu-menu" class="nav navbar-nav">
				    	<li class="{{$active_page=='home'?'active':''}}"><a href="{{url('/')}}">Home</a></li>
				    	<li class="{{$active_page=='signup'?'active':''}}"><a href="{{url('/')}}/sign-up">Sign Up to Party</a></li>
				    	<li class="{{$active_page=='rookies'?'active':''}}"><a href="{{url('/')}}/rookies">Rookie Requirements</a></li>
					</ul>				
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</header>
	<div class="page container-fluid">