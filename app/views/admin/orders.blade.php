@extends('home.templates.master', array('var1'=>'', 'var2'=>''))
@section('body')

<h1>Orders</h1>

<h3>Total: {{count($orders)}}</h3>

	<div><strong><small>Filter By Name</small></strong></div>
	<form class="form-inline margin-bottom-10">
		<div class="form-group">
	    	<input type="text" class="form-control" id="name" name="name" placeholder="Filter By Name" {{isset($filter)?'value="'.$filter.'"':''}}>
	  	</div>
		<button type="submit" class="btn btn-default btn-filter">Submit</button>
	</form>

@if(count($orders) > 0)
	<table class="table table-striped orders-table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Registered</th>
			<th style="width: 450px">Items Ordered</th>
			<th>Total</th>
			<th>Payment</th>
			<th>Phone</th>
			<th>Status</th>
			<th></th>
		</tr>
	</thead>
	@foreach($orders as $order)
	<tr data-order="{{$order->id}}">
		<td><a class="pointer" data-toggle="modal" data-target="#{{$order->id}}OrderModal">{{$order->name}}</a></td>
		<td>{{date('n/d/Y',strtotime($order->date))}}</td>
		<td>{{rtrim($order->items,',')}}</td>
		<td>{{$order->total}}</td>
		<td>{{ucwords($order->payment_method)}}</td>
		<td>{{$order->phone}}</td>
		<td>{{($order->is_paid)?'Paid':'Unpaid'}}</td>
		<td>@if($order->is_paid)
			<button data-order="{{$order->id}}" class="btn btn-default btn-xs btn-mark-unpaid">Make Unpaid</button>
			@else
			<button data-order="{{$order->id}}" class="btn btn-default btn-xs btn-mark-paid">Make Paid</button>
			@endif</td>
	</tr>
	@endforeach
	</table>

	@foreach($orders as $order)
	<?php
		$items = explode(',', $order->items);
	?>
	<div class="modal fade" id="{{$order->id}}OrderModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Order Details</h4>
				</div>
				<div class="modal-body">
					<p>Name: {{$order->name}}<br>
						Email: {{$order->email}}<br>
						Phone: {{$order->phone}}</p>
					<table class="table table-striped orders-table">
					<thead>
						<tr>
							<th>Items</th>
							<th></th>
						</tr>
					</thead>
					@foreach($items as $item)
					<tr>
						<td colspan="2">{{$item}}</td>
					</tr>
					@endforeach
					<tr>
						<td><strong>Total</strong></td>
						<td class="text-right"><strong>{{$order->total}}</strong></td>
					</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-lg btn-success print-modal">Print</button>
				</div>
			</div>
		</div>
	</div>
	@endforeach


@elseif((count($orders) == 0) && isset($filter))

	<p>There are no orders with a name staring with <strong>&quot;{{$filter}}&quot;</strong></p>

@else

	<p>There are no orders at this time.</p>

@endif

<p><a class="btn btn-default" href="{{url('/')}}/admin">Return to Main Admin Page</a></p>

@stop

@section('footercode')

<script>
	$('.btn-mark-unpaid').click(function(event)
	{
		element = $(this);
		order_id = element.data('order');
		$.ajax({
			type: 'GET',
			url: '{{url("/")}}/admin/order-mark-unpaid',
			data: 'id='+ encodeURIComponent(order_id),
			dataType: 'json',
			success: function(result)
			{
				element.removeClass('btn-mark-unpaid').addClass('btn-mark-paid').html('Make Paid');
			}
		});
	});
	$('.btn-mark-paid').click(function(event)
	{
		element = $(this);
		order_id = element.data('order');
		$.ajax({
			type: 'GET',
			url: '{{url("/")}}/admin/order-mark-paid',
			data: 'id='+ encodeURIComponent(order_id),
			dataType: 'json',
			success: function(result)
			{
				element.removeClass('btn-mark-paid').addClass('btn-mark-unpaid').html('Make Unpaid');
			}
		});
	});
	$('.btn-filter').click(function(event)
	{
		filterNames();
	});
	$('#name').keypress(function(e) {
	    if(e.which == 13) {
	        filterNames();
	    }
	});
	$('.print-modal').click(function(event)
	{
		$('.modal.in .modal-body').print();
	});
	function filterNames()
	{
		name = $('#name').val();
		window.location = '{{url("/")}}/admin/orders?name='+name;
	}
</script>

@stop