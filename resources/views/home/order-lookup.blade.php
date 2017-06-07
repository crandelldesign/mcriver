@extends('layouts.default')
@section('content')
<h1>Order Lookup</h1>

@if (isset($error))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
@endif

<form method="get">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label">Email</label>
                <input type="text" class="form-control" placeholder="Your Email" name="email" value="{{$lookup_email}}">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label">Order ID</label>
                <input type="text" class="form-control" placeholder="Order ID" name="order" value="{{$lookup_order}}">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label">&nbsp;</label><br>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </div>
</form>

@if (isset($order))

<a href="{{url('/order-lookup?email='.$order->email.'&order='.$order->friendly_order_id)}}">{{url('/order-lookup?email='.$order->email.'&order='.$order->friendly_order_id)}}</a>

<hr>

<p>Your Order Number: <strong>{{$order->friendly_order_id}}</strong></p>

@if($order->payment == 'check')
<p>Please send a check or money order to the address below by July 5, 2016.</p>
<address>
    Jim McDonald<br>
    4323 Crestdale Ave<br>
    West Bloomfield, MI 48323<br>
</address>
@endif

<h2 class="margin-top-0">Your Order</h2>
<table class="table table-striped">
@if(isset($order->persons))
@foreach($order->persons as $person)
    <tr>
        <td>{{$person->name}}</td>
        <td>$53</td>
    </tr>
@endforeach
@endif
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

@endif

@stop
