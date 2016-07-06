<!DOCTYPE html>
<html>
	<head>
		@include('layouts.admin-head')
		@yield('head')
	</head>
	<body class="skin-blue">
		<div class="wrapper">
			@include('layouts.admin-header')
			@include('layouts.admin-sidebar')
			<div class="content-wrapper">
				<section class="content-header">
				@yield('content-header')
				</section>
				<section class="content">
				@yield('content')
				</section>
			</div>
		@include('layouts.admin-footer')
		</div>
		<script type="text/javascript" src="{{ elixir('js/admin.js') }}"></script>
		@yield('scripts')
	</body>
</html>