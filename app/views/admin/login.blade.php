@extends('home.templates.master', array('var1'=>'', 'var2'=>''))
@section('body')

@if(Session::has('signInError'))
<div class="alert alert-danger alert-dismissible fade in" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
  Your username or password were incorrect.
</div>
@endif


<form action="{{url('/')}}/admin/login" method="post" role="form">
  	<div class="form-group">
    	<label for="username">Username</label>
    	<input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
  	</div>
  	<div class="form-group">
    	<label for="password">Password</label>
    	<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
	</div>
	<button type="submit" class="btn btn-lg btn-default pull-right">Login</button>
	<div class="clearfix"></div>
</form>
@stop

@section('footercode')
@stop