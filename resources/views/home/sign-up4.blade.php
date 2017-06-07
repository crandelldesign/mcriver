@extends('layouts.default')
@section('content')
<h1>Thank You for Your Order</h1>

<p>Your Order Number: <strong>{{$order->friendly_order_id}}</strong></p>

<p>You will receive an email with your order.</p>

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

@stop
