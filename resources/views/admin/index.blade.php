@extends('admin.templates.admin')
@section('content-header')
	<h1>Welcome {{\Auth::user()->name}}</h1>
@stop
@section('body')
	<div class="box">
        <div class="box-body">
			@if (session('message'))
			    <div class="alert alert-info">
			    	<h4><i class="fa fa-thumbs-up"></i> Message</h4>
			        {{ session('message') }}
			    </div>
			    <hr>
			@endif
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
		</div>
	</div>
@stop