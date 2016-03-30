@extends('master.templates.master')
@section('body')
<h1>Complete Your Order</h1>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('login_errors'))
    <div class="alert alert-danger">
        <ul>
            <li>{{ session('login_errors') }}</li>
        </ul>
    </div>
@endif

<div class="row">
	<div class="col-md-5">
		<h2 class="margin-top-0">Select an option to continue.</h2>

        <h3>Login</h3>
        <form class="form-horizontal" role="form" method="POST" action="{{url('/signin')}}">
            <div class="form-group">
                <label class="col-md-4 control-label">Email</label>
                <div class="col-md-8">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Password</label>
                <div class="col-md-8">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                {!! csrf_field() !!}
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        Continue
                    </button>
                </div>
            </div>
        </form>

        <hr>

        <h3>Register</h3>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/create-account') }}">
            {!! csrf_field() !!}
            <div class="form-group">
                <label class="col-md-4 control-label">Name</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">E-Mail Address</label>
                <div class="col-md-8">
                    <input type="email" class="form-control" name="email">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Password</label>
                <div class="col-md-8">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Confirm Password</label>
                <div class="col-md-8">
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-btn fa-user"></i> Register
                    </button>
                </div>
            </div>
        </form>

        <hr>

        <h3>Continue as a Guest</h3>
        <form class="form-horizontal" role="form" method="POST" action="{{url('/guest-checkout')}}">
            {!! csrf_field() !!}
            <div class="form-group">
                <label class="col-md-4 control-label">Name</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        Continue
                    </button>
                </div>
            </div>
        </form>
	</div>
	<div class="col-md-7">
		<h2 class="margin-top-0">Review Your Order</h2>
        <table class="table table-striped">
        @for($i = 1; $i <= $order->people; $i++)
            <tr class="person-{{$i}}-row" data-person="{{$i}}">
                <td>{{($i == 1 && \Auth::check())?\Auth::user()->name:'Person #'.$i}}</td>
                <td>$53</td>
            </tr>
        @endfor
        @if(isset($order->items))
        @foreach($order->items as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>${{$item->price}}</td>
            </tr>
        @endforeach
        @endif
            <tr>
                <th>Total</th>
                <th>${{$order->total}}</th>
            </tr>
        </table>
	</div>
</div>

@stop