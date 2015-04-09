@extends('home.templates.master', array('var1'=>'', 'var2'=>''))
@section('body')
<h1>Admin Access</h1>

@if(Session::has('password_changed'))
<div class="alert alert-success alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	Password changed successfully.
</div>
@endif

<p>Welcome, {{Auth::user()->first_name}} {{Auth::user()->last_name}}. Check out the menu below.</p>

<ul>
	<li><a href="{{url('/')}}/admin/orders">Check Sign Ups</a></li>
	<li><a href="{{url('/')}}/admin/change-password">Change Your Password</a></li>
    <li><a href="{{url('/')}}/admin/logout">Logout</a></li>
</ul>

@stop

@section('footercode')
@stop