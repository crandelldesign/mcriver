@extends('home.templates.master', array('var1'=>'', 'var2'=>''))
@section('body')

<h1>Order Status</h1>

@if(Session::has('statusError'))
<div class="alert alert-danger alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
    Your name and email did not match any orders.
</div>
@endif

<p>Enter the name and email you used to find your order.</p>

<form action="{{url('/')}}/order-status" method="post" role="form">
  	<div class="form-group">
    	<label for="name">Name</label>
    	<input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" required="required">
  	</div>
  	<div class="form-group">
    	<label for="email">Email</label>
    	<input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required="required">
	</div>
	<button type="submit" class="btn btn-lg btn-default pull-right">Submit</button>
	<div class="clearfix"></div>
</form>
@stop

@section('footercode')
@stop