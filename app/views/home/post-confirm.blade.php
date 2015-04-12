@extends('home.templates.master')
@section('body')

<h1>Your Order is Complete</h1>

<p>Name: <strong>{{$person->name}}</strong></p>

<p>Email: <strong>{{$person->email}}</strong></p>

@if(isset($items))
<table class="table table-striped">
	<thead>
		<tr>
			<th>Item</th>
			<th>Cost</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Camping</td>
			<td>$53</td>
		</tr>
		@foreach($items as $item)
		<tr>
			<td>{{$item->name}}</td>
			<td>${{$item->price}}</td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr class="success">
			<th>Total</th>
			<th>${{number_format($person->total)}}</th>
		</tr>
	</tfoot>
</table>
@else

<table class="table orders-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Date Registered</th>
            <th>Items Ordered</th>
            <th>Total</th>
            <th>Payment Type</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tr data-order="{{$person->id}}">
        <td>{{$person->name}}</td>
        <td>{{date('n/d/Y',strtotime($person->date))}}</td>
        <td>{{rtrim($person->items,',')}}</td>
        <td>{{$person->total}}</td>
        <td>{{ucwords($person->payment_method)}}</td>
        <td>{{($person->is_paid)?'Paid':'Unpaid'}}</td>
    </tr>
</table>

@endif

<div class="text-center">
	<button type="button" class="btn btn-success btn-print-order">Print Your Order</button>
</div>

@stop

@section('footercode')
<script>

	$('.btn-print-order').click(function(event)
	{
		window.print();
	});

</script>
@stop