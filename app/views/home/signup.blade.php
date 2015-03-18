@extends('home.templates.master')
@section('body')

<h1>Sign Up to Party</h1>

<p>Out of courtesy and respect, please send your money as soon as you can so your order for McRiver gear can be placed! We can not wait to place your order at the last minute and you payment is needed to place the order…send the money ASAP!</p>

<p>Please fill this form out for each person that will be attending!</p>

<div class="row">
	<div class="col-sm-8">

		<h2>$49 per person for Fri &amp; Sat &quot;Camping Experience&quot;<br>
		<small>Note: Additional days will be extra and due to the campground.</small></h2>
		<form class="form-horizontal" method="post">
			<div class="form-group full-width">
				<label class="col-xs-12">Full Name : Please register each person individually! $49 per person *</label>
				<div class="col-xs-12">
					<input type="text" class="form-control" id="name" name="name" placeholder="First and Last Name" required="required">
				</div>
			</div>
			<h2>Tube Rental</h2>
			<div class="form-group">
				<label class="control-label col-sm-6 col-md-4">Regular Tube NO BOTTOM - $15 each</label>
				<div class="col-sm-6">
					<select class="form-control price-control" id="regTube" name="regTube" data-price="15">
		  				<option value="0">0</option>
		  				<option value="1">1</option>
		  				<option value="2">2</option>
		  			</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-6 col-md-4">Regular Tube WITH BOTTOM - $17 each</label>
				<div class="col-sm-6">
					<select class="form-control price-control" id="regTubeWBottom" name="regTubeWBottom" data-price="17">
		  				<option value="0">0</option>
		  				<option value="1">1</option>
		  				<option value="2">2</option>
		  			</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-6 col-md-4">Deluxe Tube (Don't skimp out this year) - $20 each</label>
				<div class="col-sm-6">
					<select class="form-control price-control" id="deluxeTube" name="deluxeTube" data-price="20">
		  				<option value="0">0</option>
		  				<option value="1">1</option>
		  				<option value="2">2</option>
		  			</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-6 col-md-4">Cooler Tube (you will want one!) - $11 each</label>
				<div class="col-sm-6">
					<select class="form-control price-control" id="coolerTube" name="coolerTube" data-price="11">
		  				<option value="0">0</option>
		  				<option value="1">1</option>
		  				<option value="2">2</option>
		  			</select>
		  			<div class="text-muted">Seriously, get one!</div>
				</div>
			</div>
			<h2>McRiver Gear</h2>
			<div class="form-group">
				<label class="col-xs-12">Men's T-Shirts</label>
				<label class="control-label col-sm-6 col-md-4">Select Quanity</label>
				<div class="col-sm-6">
					<select class="form-control tshirt-quantity" name="tshirtQuanity" id="tshirtQuanity">
		  				<option value="0">0</option>
		  				<option value="1">1</option>
		  				<option value="2">2</option>
		  				<option value="3">3</option>
		  				<option value="4">4</option>
		  			</select>
		  			<div class="row change-sizes">
		  			</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12">Men's Tank Tops</label>
				<label class="control-label col-sm-6 col-md-4">Select Quanity</label>
				<div class="col-sm-6">
					<select class="form-control mtanktop-quantity" name="mtanktopQuanity" id="mtanktopQuanity">
		  				<option value="0">0</option>
		  				<option value="1">1</option>
		  				<option value="2">2</option>
		  				<option value="3">3</option>
		  				<option value="4">4</option>
		  			</select>
		  			<div class="row change-sizes">
		  			</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12">Women's Tank Tops</label>
				<label class="control-label col-sm-6 col-md-4">Select Quanity</label>
				<div class="col-sm-6">
					<select class="form-control wtanktop-quantity" name="wtanktopQuanity" id="wtanktopQuanity">
		  				<option value="0">0</option>
		  				<option value="1">1</option>
		  				<option value="2">2</option>
		  				<option value="3">3</option>
		  				<option value="4">4</option>
		  			</select>
		  			<div class="row change-sizes">
		  			</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12">Crew Neck Sweatshirts</label>
				<label class="control-label col-sm-6 col-md-4">Select Quanity</label>
				<div class="col-sm-6">
					<select class="form-control crewnecksweatshirts-quantity" name="crewnecksweatshirtsQuanity" id="crewnecksweatshirtsQuanity">
		  				<option value="0">0</option>
		  				<option value="1">1</option>
		  				<option value="2">2</option>
		  				<option value="3">3</option>
		  				<option value="4">4</option>
		  			</select>
		  			<div class="row change-sizes">
		  			</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12">Hooded Sweatshirts</label>
				<label class="control-label col-sm-6 col-md-4">Select Quanity</label>
				<div class="col-sm-6">
					<select class="form-control hoodedsweatshirts-quantity" name="hoodedsweatshirtsQuanity" id="hoodedsweatshirtsQuanity">
		  				<option value="0">0</option>
		  				<option value="1">1</option>
		  				<option value="2">2</option>
		  				<option value="3">3</option>
		  				<option value="4">4</option>
		  			</select>
		  			<div class="row change-sizes">
		  			</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12">Hats</label>
				<label class="control-label col-sm-6 col-md-4">Select Quanity</label>
				<div class="col-sm-6">
					<select class="form-control price-control" id="hat" name="hat" data-price="13">
		  				<option value="0">0</option>
		  				<option value="1">1</option>
		  				<option value="2">2</option>
		  			</select>
				</div>
			</div>
			<h2>Contact Info</h2>
			<div class="form-group">
				<label class="control-label col-sm-6 col-md-4">Email Address</label>
				<div class="col-sm-6">
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-6 col-md-4">Phone Number</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-6 col-md-4">Are you a McRiver Rookie?</label>
				<div class="col-sm-6">
					<label class="radio-inline">
						<input type="radio" name="rookie" id="rookie" value="yes" checked> Yes
					</label>
					<label class="radio-inline">
						<input type="radio" name="rookie" id="rookie" value="no"> No
					</label>
		  			<div class="text-muted">If this is your first year, do yourself a favor and admit it.</div>
		  			<div><a href="#" data-toggle="modal" data-target="#rookieRequirements">Click here for Rookie Requirements</a></div>
				</div>
			</div>
			<hr>
			<div class="form-group">
				<label class="control-label col-xs-6 col-md-4">Total</label>
				<div class="col-xs-6 price-total-container">
					$<span class="price-total">49</span>
				</div>
				<input type="hidden" name="total" id="total" value="49">
			</div>
			<hr>
			<p>Do you agree to mail a Check or Money Order (for the above amount) to Jim McDonald before June 21, 2015? (There will be an email sent with this information to you following your submission for your records)<br>
			<label class="checkbox-inline">
				<input type="checkbox" id="agreement" name="agreement" value="yes" required="required"> Yes, I agree to these terms stated!
			</label></p>
			<div>
				<button type="submit" class="btn btn-default center-block">Submit Order Form to Party!</button>
			</div>
		</form>
	</div>
	<div class="col-sm-4 hidden-xs">
		<img src="{{url('/')}}/img/mcriver-jim.jpg" class="img-responsive" alt="McRiver Jim">
	</div>
</div>

<div class="modal fade" id="rookieRequirements" tabindex="-1" role="dialog">
	<div class="modal-dialog">
    	<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title">Rookie Requirements</h4>
      		</div>
      		<div class="modal-body">
      			<p>All McRiver Rookies are REQUIRED to bring:</p>

      			<ul>
      				<li>No less than 50 Jello Shots</li>
      				<li>A total of 3 garbage bags for camp cleanup (one for each night)</li>
      				<li>One bag for the river for empty cans that you will collect during the river trip (Mesh bags work the best).</li>
      				<li>Costume for the theme for this years event (Try and go all out!)</li>
      				<li>Men will make ice runs for the campers each morning and at dusk (You will not pay out of your pocket)</li>
      				<li>Men will also get fire wood for the group (You will not pay out of your pocket)</li>
      			</ul>
      			<p>***You are not a Rookie the moment you and all tubes are off the river***</p>
      		</div>
    	</div>
  	</div>
</div>

@stop

@section('footercode')
<script>
	$('.tshirt-quantity').change(function()
	{
		var element = $(this);
		var container = element.parent().find('.change-sizes');
		container.empty();
		if(element.val() > 0)
		{
			for(var i = 1; i <= $(this).val(); i++)
			{
		    	container.append('<div class="col-sm-6 col-md-4">Shirt #'+i+'<br><select class="form-control tshirt-size'+i+'" name="tshirtSize'+i+'" id="tshirtSize'+i+'"><option value="s-13" data-size="s" data-price="13">Small - $13</option><option value="m-13" data-size="m" data-price="13">Medium - $13</option><option value="l-13" data-size="l" data-price="13">Large - $13</option><option value="xl-13" data-size="xl" data-price="13">XL - $13</option><option value="2xl-14" data-size="2xl" data-price="14">2XL - $14</option><option value="3xl-14" data-size="3xl" data-price="14">3XL - $14</option><option value="4xl-14" data-size="4xl" data-price="14">4XL - $14</option></select></div>');
		    }
		    priceUpdate();
		}
	});
	$('.mtanktop-quantity').change(function()
	{
		var element = $(this);
		var container = element.parent().find('.change-sizes');
		container.empty();
		if(element.val() > 0)
		{
			for(var i = 1; i <= $(this).val(); i++)
			{
		    	container.append('<div class="col-sm-6 col-md-3">Tank Top #'+i+'<br><select class="form-control mtanktop-size'+i+'" name="mtanktopSize'+i+'" id="mtanktopSize'+i+'"><option value="s-13" data-size="s" data-price="13">Small - $13</option><option value="m-13" data-size="m" data-price="13">Medium - $13</option><option value="l-13" data-size="l" data-price="13">Large - $13</option><option value="xl-13" data-size="xl" data-price="13">XL - $13</option><option value="2xl-14" data-size="2xl" data-price="14">2XL - $14</option></select></div>');
		    }
		}
		priceUpdate();
	});
	$('.wtanktop-quantity').change(function()
	{
		var element = $(this);
		var container = element.parent().find('.change-sizes');
		container.empty();
		if(element.val() > 0)
		{
			for(var i = 1; i <= $(this).val(); i++)
			{
		    	container.append('<div class="col-sm-6 col-md-3">Tank Top #'+i+'<br><select class="form-control wtanktop-size'+i+'" name="wtanktopSize'+i+'" id="wtanktopSize'+i+'"><option value="s-14" data-size="s" data-price="14">Small - $14</option><option value="m-14" data-size="m" data-price="14">Medium - $14</option><option value="l-14" data-size="l" data-price="14">Large - $14</option><option value="xl-14" data-size="xl" data-price="14">XL - $14</option><option value="2xl-15" data-size="2xl" data-price="15">2XL - $15</option></select></div>');
		    }
		}
		priceUpdate();
	});
	$('.crewnecksweatshirts-quantity').change(function()
	{
		var element = $(this);
		var container = element.parent().find('.change-sizes');
		container.empty();
		if(element.val() > 0)
		{
			for(var i = 1; i <= $(this).val(); i++)
			{
		    	container.append('<div class="col-sm-6 col-md-3">Sweatshirts #'+i+'<br><select class="form-control wtanktop-size'+i+'" name="crewnecksweatshirtsSize'+i+'" id="crewnecksweatshirtsSize'+i+'"><option value="s-23" data-size="s" data-price="23">Small - $23</option><option value="m-23" data-size="m" data-price="23">Medium - $23</option><option value="l-23" data-size="l" data-price="23">Large - $23</option><option value="xl-23" data-size="xl" data-price="23">XL - $23</option><option value="2xl-26" data-size="2xl" data-price="26">2XL - $26</option><option value="3xl-27" data-size="3xl" data-price="27">3XL - $27</option><option value="4xl-27" data-size="4xl" data-price="27">4XL - $27</option></select></div>');
		    }
		}
		priceUpdate();
	});
	$('.hoodedsweatshirts-quantity').change(function()
	{
		var element = $(this);
		var container = element.parent().find('.change-sizes');
		container.empty();
		if(element.val() > 0)
		{
			for(var i = 1; i <= $(this).val(); i++)
			{
		    	container.append('<div class="col-sm-6 col-md-3">Hoodie #'+i+'<br><select class="form-control wtanktop-size'+i+'" name="hoodedsweatshirtsSize'+i+'" id="hoodedsweatshirtsSize'+i+'"><option value="s-29" data-size="s" data-price="29">Small - $29</option><option value="m-29" data-size="m" data-price="29">Medium - $29</option><option value="l-29" data-size="l" data-price="29">Large - $29</option><option value="xl-29" data-size="xl" data-price="29">XL - $29</option><option value="2xl-30" data-size="2xl" data-price="30">2XL - $30</option><option value="3xl-31" data-size="3xl" data-price="31">3XL - $31</option><option value="4xl-31" data-size="4xl" data-price="31">4XL - $31</option></select></div>');
		    }
		}
		priceUpdate();
	});
	$('.price-control').change(function()
	{
		priceUpdate();
	});
	$('.change-sizes').on('change','select',function()
	{
		priceUpdate();
	});
	function priceUpdate()
	{
		var total = 49;
		$('.price-control').each(function()
		{
			var quantity = $(this).children('option:selected').val();
			var price = $(this).data('price');
			total+= quantity * price;
		});
		$('.change-sizes select').each(function(){
	    	//console.log($(this).children('option:selected').data('price'));
	 		total+=parseFloat($(this).children('option:selected').data('price'));    
		});
		$('.price-total').html(total);
		console.log(total);
		$('#total').val(total);
	}
</script>
@stop