<!DOCTYPE html>
<html>
	<head>
		@include('admin.templates.head')
		@yield('head')
	</head>
	<body class="skin-blue">
		<div class="wrapper">
			@include('admin.templates.header')
			@include('admin.templates.sidebar')
			<div class="content-wrapper">
				<section class="content-header">
				@yield('content-header')
				</section>
				<section class="content">
				@yield('body')
				</section>
			</div>
		@include('admin.templates.footer')
		</div>
		<script type="text/javascript" src="{{ elixir('js/admin.js') }}"></script>
		@yield('scripts')
	</body>
</html>