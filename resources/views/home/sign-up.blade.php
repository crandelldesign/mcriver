@extends('master.templates.master')
@section('body')
<h1>McRiver Raid 2016</h1>

<div class="row">
	<div class="col-md-8">
		<p>Out of courtesy and respect, please send your money as soon as you can so your order for McRiver gear can be placed! We can not wait to place your order at the last minute and your payment is needed to place the order... send the money ASAP!</p>

		<!--Please fill this form out for each person that will be attending!-->

		@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

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
	  				<option value="1" {{(old('people_quantity') && old('people_quantity') == 1)?'selected':''}}>1</option>
	  				<option value="2" {{(old('people_quantity') && old('people_quantity') == 2)?'selected':''}}>2</option>
	  				<option value="3" {{(old('people_quantity') && old('people_quantity') == 3)?'selected':''}}>3</option>
	  				<option value="4" {{(old('people_quantity') && old('people_quantity') == 4)?'selected':''}}>4</option>
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
		  				<option value="0" {{(old($item->slug) && old($item->slug) == 0)?'selected':''}}>0</option>
		  				<option value="1" {{(old($item->slug) && old($item->slug) == 1)?'selected':''}}>1</option>
		  				<option value="2" {{(old($item->slug) && old($item->slug) == 2)?'selected':''}}>2</option>
		  				<option value="3" {{(old($item->slug) && old($item->slug) == 3)?'selected':''}}>3</option>
		  				<option value="4" {{(old($item->slug) && old($item->slug) == 4)?'selected':''}}>4</option>
		  			</select>
		  			@if(count($item->children) > 0)
		  				<div class="row change-sizes">
		  					@for($i = 1; $i <= 4; $i++)
		  						<div class="col-sm-6 col-lg-4 hidden {{$i}}">Shirt #{{$i}} <?php count($item->children) ?><br>
		  							<select class="form-control input-sm {{$item->slug.$i}}" name="{{$item->slug.$i}}" id="{{$item->slug.$i}}">
		  								@foreach($item->children as $child)
		  								<option value="{{$child->slug}}" data-value="{{$child->short_name}}-{{$child->price}}" data-size="{{$child->short_name}}" data-price="{{$child->price}}" {{(old($item->slug.$i) && old($item->slug.$i) == $child->slug)?'selected':''}}>{{$child->short_name}} - ${{$child->price}}</option>
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

		<div class="form-group form-total">
			<label class="total control-label col-sm-6 col-lg-4">Total:</label>
			<div class="col-sm-6">
				<p class="form-control-static"><strong><span class="price">$53</span></strong></p>
			</div>
		</div>

		<hr>

		<p>Do you agree to be fully paid before July 5th, 2016?<br>
		<label class="checkbox-inline">
			<input type="checkbox" id="agreement" name="agreement" value="yes"> Yes, I agree to be fully paid by the date given.
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
	$(document).ready(function()
	{
		updateForm();
		//var total = 0;
		$('form .price-control').change(function()
		{
			updateForm();
			priceUpdate();
		});
		$('.change-sizes').on('change','select',function()
		{
			priceUpdate();
		});
		function updateForm()
		{
			$('form .price-control').each(function()
			{
				if ($(this).data('price') != 0) {
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
			});
		}
		function priceUpdate()
		{
			var total = 0;
			$('.price-control').each(function()
			{
				var quantity = $(this).children('option:selected').val();
				var price = $(this).data('price');
				total+= quantity * price;
			});
			$('.change-sizes .count select').each(function()
			{
		 		total+=parseFloat($(this).children('option:selected').data('price'));    
			});
			$('.price-total').html(total);
			$('#total').val(total);
			$('.price-box .price').html('$'+total);
			$('.form-total .price').html('$'+total);
		}
	});
</script>
@stop