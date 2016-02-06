@extends('admin.templates.admin')
@section('content-header')
	<h1>Welcome {{\Auth::user()->name}}</h1>
@stop
@section('body')
	<div class="row">
		<div class="col-sm-6 margin-bottom">
			<a href="#" class="btn btn-lg btn-block btn-success">Check Sign Ups</a>
		</div>
		<div class="col-sm-6 margin-bottom">
			<a href="#" class="btn btn-lg btn-block btn-primary">Check Equipment Totals</a>
		</div>
		<div class="col-sm-6 margin-bottom">
			<a href="{{url('/')}}/admin/products" class="btn btn-lg btn-block bg-maroon">Change Products</a>
		</div>
	</div>
@stop