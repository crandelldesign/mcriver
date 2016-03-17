@extends('master.templates.master')
@section('body')
<h1>McRiver Raid 2016</h1>

<div class="row">
	<div class="col-md-8">
		<p>Out of courtesy and respect, please send your money as soon as you can so your order for McRiver gear can be placed! We can not wait to place your order at the last minute and your payment is needed to place the order... send the money ASAP!</p>

		<!--Please fill this form out for each person that will be attending!-->

		<form class="form-horizontal" method="post">
		<h2>$53 per person for Fri &amp; Sat &quot;Camping Experience&quot;<br>
			<small>Note: Additional days will be extra and due to the campground.</small></h2>
		
		<!--<p>Full Name : Please register each person individually! $53 per person *</p>-->

		<div class="form-group">
			<label class="control-label col-sm-6 col-lg-4">
				People in Your Group
			</label>
			<div class="col-sm-6">
				<select class="form-control price-control" id="people_quantity" name="people_quantity" data-price="53">
	  				<option value="1">1</option>
	  				<option value="2">2</option>
	  				<option value="3">3</option>
	  				<option value="4">4</option>
	  			</select>
			</div>
		</div>

		<hr>

		@foreach($categories as $category)
		<h2>{{$category->name}}</h2>
			<?php // print_r($category) ?>
			@foreach($category->items as $item)
			<div class="form-group">
				<label class="control-label col-sm-6 col-lg-4">{{$item->name}} @if($item->price != 0) - ${{$item->price}} each @endif</label>
				<div class="col-sm-6">
					<select class="form-control price-control" id="{{$item->slug}}" name="{{$item->slug}}" data-price="{{$item->price}}">
		  				<option value="0">0</option>
		  				<option value="1">1</option>
		  				<option value="2">2</option>
		  				<option value="3">3</option>
		  				<option value="4">4</option>
		  			</select>
		  			@if(count($item->children) > 0)
		  				<div class="row change-sizes">
		  					@for($i = 1; $i < 3; $i++)
		  						<div class="col-sm-6 col-lg-4 hidden {{$i}}">Shirt #{{$i}} <?php count($item->children) ?><br>
		  							<select class="form-control input-sm {{$item->slug.$i}}" name="{{$item->slug.$i}}" id="{{$item->slug.$i}}">
		  								@foreach($item->children as $child)
		  								<option value="{{$child->slug}}" data-value="{{$child->short_name}}-{{$child->price}}" data-size="{{$child->short_name}}" data-price="{{$child->price}}">{{$child->short_name}} - ${{$child->price}}</option>
										@endforeach
		  							</select>
		  						</div>
							@endfor
		  				</div>
		  			@endif
				</div>
			</div>
				
			@endforeach
		<hr>
		@endforeach
		<p>Do you agree to pay before June 21, 2016?<br>
		<label class="checkbox-inline">
			<input type="checkbox" id="agreement" name="agreement" value="yes" required="required"> Yes, I agree to these terms stated!
		</label></p>
		<input type="hidden" name="total" id="total" value="53" />
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<button type="submit" class="btn btn-lg center-block btn-primary">Submit Order Form to Party!</button>
		</form>
	</div>
</div>

<div class="price-box img-circle"><span class="total">Total:</span><span class="price">$53</span></div>
@stop
@section('scripts')
<script>
	//var total = 0;
	$('form .price-control').change(function()
	{
		if ($(this).data('price') != 0) {
			//total = ($(this).val() * $(this).data('price'));
			priceUpdate();
		} else {
			var quantity = $(this).val();
			var parentDiv = $(this).parent();
			parentDiv.find('.row > div').addClass('hidden').removeClass('count');
			for (i = 1; i <= quantity; i++) {
				parentDiv.find('div.'+i).removeClass('hidden').addClass('count');
			}
		}
		priceUpdate();
		//$('.price-box .price').html('$'+total);
		//console.log(total);
	});
	$('.change-sizes').on('change','select',function()
	{
		priceUpdate();
	});
	function priceUpdate()
	{
		//var total = 53;
		var total = 0;
		$('.price-control').each(function()
		{
			var quantity = $(this).children('option:selected').val();
			//console.log(quantity);
			var price = $(this).data('price');
			total+= quantity * price;
			console.log(total);
		});
		$('.change-sizes .count select').each(function()
		{
	    	//console.log($(this).children('option:selected').data('price'));

			console.log(total);
	 		total+=parseFloat($(this).children('option:selected').data('price'));    
		});
		$('.price-total').html(total);
		$('#total').val(total);
		$('.price-box .price').html('$'+total);
	}
</script>
@stop