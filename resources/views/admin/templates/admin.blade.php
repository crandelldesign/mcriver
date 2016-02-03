<!DOCTYPE html>
<html>
	<head>
		@include('admin.templates.head')
	</head>
	<body class="skin-blue">
		<div class="wrapper">
			@include('admin.templates.header')
			@include('admin.templates.sidebar')
			<div class="content-wrapper">
				<section class="content">
				</section>
			</div>
		@include('admin.templates.footer')
		</div>
		<script type="text/javascript" src="{{ elixir('js/admin.js') }}"></script>
	</body>
</html>