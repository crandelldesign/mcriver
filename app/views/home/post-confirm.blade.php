@extends('home.templates.master')
@section('body')

<h1>Your Order is Complete</h1>

<p>Name: <strong>{{$person->name}}</strong></p>

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
			<td>$49</td>
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