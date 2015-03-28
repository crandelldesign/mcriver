@extends('home.templates.master')
@section('body')

<h1>Confirm Your Order</h1>

<p>Name: <strong>{{$basic_info['name']}}</strong></p>

<p>Email: <strong>{{$basic_info['email']}}</strong></p>

<p>Phone: <strong>{{$basic_info['phone']}}</strong></p>

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
			<th>${{$basic_info['total']}}</th>
		</tr>
	</tfoot>
</table>

<form class="order-data">
<input type="hidden" name="name" value="{{$basic_info['name']}}">
<input type="hidden" name="email" value="{{$basic_info['email']}}">
<input type="hidden" name="items" value="Camping,@foreach($items as $item) {{$item->name}},@endforeach">
<input type="hidden" name="total" value="{{$basic_info['total']}}">
<input type="hidden" name="is_rookie" value="{{$basic_info['rookie']}}">
<div>
	<h2>Select Your Payment Method</h2>
	<div class="radio">
		<label>
			<input type="radio" class="payment-method" name="paymentMethod" id="paymentMethod" value="check" checked>
			Check
		</label>
	</div>
	<div class="radio">
		<label>
			<input type="radio" class="payment-method" name="paymentMethod" id="paymentMethod" value="online">
			Pay Online
		</label>
	</div>
</div>
</form>

<div class="text-center">
	<button type="button" class="btn btn-default center-block btn-confirm-order">Submit Your Order</button>
</div>

<div class="modal fade" id="submitOrder">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Thank You.</h4>
			</div>
			<div class="modal-body">
				<p>Thank you, {{$basic_info['name']}}, for your order. Now for the next step:</p>
				<div class="check-order">
					<p>Send Check or Money Order to:<br>
						Jim McDonald<br>
						4323 Crestdale Ave<br>
						West Bloomfield, MI 48323<br>
						<strong>All Checks and Money Orders Due June 21, 2015</strong></p>
					<p><small>Out of courtesy and respect, please send your money as soon as you can so your order for McRiver gear can be placed! We can not wait to place your order at the last minute and you payment is needed to place the order…send the money ASAP!</small></p>
				</div>
				<div class="online-order">
					<p>Click the button below to continue:</p>
					<form id="stripeForm" action="/confirm" method="POST">
					  	<script
						    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
						    data-key="pk_live_HLWAvzdpzXU7NwFRSBm3SPZI"
						    data-image="{{url('/')}}/img/logo-default-square.png"
						    data-name="McRiver"
						    data-description="Camping,@foreach($items as $item) {{$item->name}},@endforeach"
						    data-amount="{{$basic_info['total']*100}}">
					  	</script>
					</form>
					<?php /* Test Mode data-key="pk_test_Jkq2zhGLCLGk8UTvuel8wu15" */ ?>
					<?php /* Test Mode data-key="pk_live_HLWAvzdpzXU7NwFRSBm3SPZI" */ ?>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-success btn-print-order">Print Order</button> 
				<a href="{{url('/')}}" class="btn btn-default">All Done.</a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('footercode')
<script>
	// Variables
	name = "{{$basic_info['name']}}";
	email = "{{$basic_info['email']}}";
	phone = "{{$basic_info['phone']}}";
	items = "Camping,@foreach($items as $item) {{$item->name}},@endforeach";
	total = "{{$basic_info['total']}}";

	$('.btn-confirm-order').click(function(event)
	{
		$.ajax({
			type: 'POST',
			url: '{{url("/")}}/submit-order',
			data: $('.order-data').serialize(),
			dataType: 'json',
			success: function(result)
			{
				$('.btn-confirm-order').prop('disabled', true);
				$('.payment-method').prop('disabled', true);
				if(result.payment_method == 'check')
				{
					$('.check-order').removeClass('hidden');
					$('.online-order').addClass('hidden');
					$('#submitOrder .modal-footer').removeClass('hidden');
				} else {
					$('.check-order').addClass('hidden');
					$('.online-order').removeClass('hidden');
					$('#submitOrder .modal-footer').addClass('hidden');
					var formurl = $("#stripeForm").attr('action');
					$("#stripeForm").attr('action', formurl+'/'+result.id);
				}
				$('#submitOrder').modal('show');
			}
		});
	});

	$('.btn-print-order').click(function(event)
	{
		$('#submitOrder').modal('hide');
		window.print();
	});

</script>
@stop