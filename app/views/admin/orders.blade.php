@extends('home.templates.master', array('var1'=>'', 'var2'=>''))
@section('body')

<h1>Orders</h1>

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
			<th>Date Registered</th>
			<th>Items Ordered</th>
			<th>Total</th>
			<th>Payment Type</th>
			<th>Status</th>
			<th></th>
		</tr>
	</thead>
	@foreach($orders as $order)
	<tr data-order="{{$order->id}}">
		<td>{{$order->name}}</td>
		<td>{{date('n/d/Y',strtotime($order->date))}}</td>
		<td>{{rtrim($order->items,',')}}</td>
		<td>{{$order->total}}</td>
		<td>{{ucwords($order->payment_method)}}</td>
		<td>{{($order->is_paid)?'Paid':'Unpaid'}}</td>
		<td>@if($order->is_paid)
			<button data-order="{{$order->id}}" class="btn btn-default btn-xs btn-mark-unpaid">Make Unpaid</button>
			@else
			<button data-order="{{$order->id}}" class="btn btn-default btn-xs btn-mark-paid">Make Paid</button>
			@endif</td>
	</tr>
	@endforeach
	</table>
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
	function filterNames()
	{
		name = $('#name').val();
		window.location = '{{url("/")}}/admin/orders?name='+name;
	}
</script>

@stop