<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        @include('master.templates.head')
    </head>
    <body style="background-image: url({{url('/')}}/img/default-background{{rand(1,4)}}.jpg)">
    	<div class="site-container">
		    <header class="header">
		        <div class="container-fluid logo-container">
		            <a href="{{url('/')}}"><img class="img-responsive center-block" src="{{url('/')}}/img/logo-default-gold.png" alt="McRiver"></a>
		        </div>
		    </header>
		    <div class="page container-fluid">
				<h1>McRiver Raid 2016<br>
				<small>New Site Coming Soon.</small></h1>

				<p class="text-center featured-img-container"><img src="{{url('/')}}/img/group-shot-2015.jpg" class="img-responsive center-block featured-img" alt="2015's Group"></p>

				<div class="row">
					<div class="col-md-11 col-lg-offset-1">
						<h2>What?</h2>
						<p>McRiver Raid is an annual camping event.</p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4 col-lg-3 col-lg-offset-1">
						<h2>When?</h2>
						<p><strong>Starting:</strong> Friday Aug 12, 2016<br>
							<strong>Ending:</strong> Sunday Aug 14, 2016</p>
					</div>
					<div class="col-md-4">
						<h2>Theme?</h2>
						<p>TBD <i class="fa fa-beer"></i><!--70’s Disco &quot;Staying Alive&quot;--></p>
					</div>
					<div class="col-md-4 col-lg-3">
						<h2>Where?</h2>
						<address>
							Rifle River Campground<br>
							5825 Townline Rd<br>
							Sterling, MI 48659
						</address>
					</div>
				</div>
			</div> <!--.page-->
			<footer class="footer">
				<p>Copyright &copy; {{date("Y")}} McRiver Raid. All Rights Reserved.</p>
				<p>Designated trademarks and brands are the property of their respective owners.</p>
				<p>Website and graphics are created by Cap'n Matt Crandell. Check out his other great work at <a href="http://www.crandelldesign.com" target="_blank">Crandell Design</a>.</p>
			</footer>
		</div> <!--.site-container-->
		<script type="text/javascript" src="{{ elixir('js/master.js') }}"></script>
    </body>
</html>