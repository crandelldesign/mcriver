@extends('home.templates.master')
@section('body')

<h1>Sign Up to Party</h1>

<p>Please fill this form out for each person that will be attending!</p>

<h2>$49 per person for Fri &amp; Sat &quot;Camping Experience&quot;<br>
<small>Note: Additional days will be extra and due to the campground.</small></h2>
<form class="form-horizontal">
	<div class="form-group full-width">
		<label class="col-xs-12">Full Name : Please register each person individually! $49 per person *</label>
		<div class="col-xs-12">
			<input type="text" class="form-control" placeholder="First and Last Name">
		</div>
	</div>
	<h2>Tube Rental</h2>
	<div class="form-group">
		<label class="control-label col-sm-6 col-md-4">Regular Tube NO BOTTOM - $15 each</label>
		<div class="col-sm-6">
			<select class="form-control">
  				<option>0</option>
  				<option>1</option>
  				<option>2</option>
  			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-6 col-md-4">Regular Tube WITH BOTTOM - $17 each</label>
		<div class="col-sm-6">
			<select class="form-control">
  				<option>0</option>
  				<option>1</option>
  				<option>2</option>
  			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-6 col-md-4">Deluxe Tube (Don't skimp out this year) - $20 each</label>
		<div class="col-sm-6">
			<select class="form-control">
  				<option>0</option>
  				<option>1</option>
  				<option>2</option>
  			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-6 col-md-4">Cooler Tube (you will want one!) - $11 each</label>
		<div class="col-sm-6">
			<select class="form-control">
  				<option>0</option>
  				<option>1</option>
  				<option>2</option>
  			</select>
  			<div class="text-muted">Seriously, get one!</div>
		</div>
	</div>
	<h2>McRiver Gear</h2>
	<div class="form-group">
		<label class="col-xs-12">Men's T-Shirts</label>
		<label class="control-label col-sm-6 col-md-4">Select Quanity</label>
		<div class="col-sm-6">
			<select class="form-control">
  				<option>0</option>
  				<option>1</option>
  				<option>2</option>
  			</select>
		</div>
	</div>
</form>

@stop