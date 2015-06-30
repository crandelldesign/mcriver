@extends('home.templates.master', array('var1'=>'', 'var2'=>''))
@section('body')

<h1>Equipment Ordered</h1>

<table class="table table-striped orders-table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Quantity</th>
		</tr>
	</thead>
	<tr>
		<td>Regular Tube</td>
		<td>{{$regular_tube}}</td>
	</tr>
	<tr>
		<td>Regular Tube with Bottom</td>
		<td>{{$regular_tube_bottom}}</td>
	</tr>
	<tr>
		<td>Deluxe Tube</td>
		<td>{{$deluxe_tube}}</td>
	</tr>
	<tr>
		<td>Cooler Tube</td>
		<td>{{$cooler_tube}}</td>
	</tr>
	<tr>
		<td>Small Men's T-Shirt</td>
		<td>{{$small_mens_t}}</td>
	</tr>
	<tr>
		<td>Medium Men's T-Shirt</td>
		<td>{{$medium_mens_t}}</td>
	</tr>
	<tr>
		<td>Large Men's T-Shirt</td>
		<td>{{$large_mens_t}}</td>
	</tr>
	<tr>
		<td>XL Men's T-Shirt</td>
		<td>{{$xl_mens_t}}</td>
	</tr>
	<tr>
		<td>2XL Men's T-Shirt</td>
		<td>{{$xl2_mens_t}}</td>
	</tr>
	<tr>
		<td>3XL Men's T-Shirt</td>
		<td>{{$xl3_mens_t}}</td>
	</tr>
	@if($xl4_mens_t > 0)
	<tr>
		<td>4XL Men's T-Shirt</td>
		<td>{{$xl4_mens_t}}</td>
	</tr>
	@endif
	@if($small_mens_tank > 0)
	<tr>
		<td>Small Men's Tank Top</td>
		<td>{{$small_mens_tank}}</td>
	</tr>
	@endif
	@if($medium_mens_tank > 0)
	<tr>
		<td>Medium Men's Tank Top</td>
		<td>{{$medium_mens_tank}}</td>
	</tr>
	@endif
	@if($large_mens_tank > 0)
	<tr>
		<td>Large Men's Tank Top</td>
		<td>{{$large_mens_tank}}</td>
	</tr>
	@endif
	@if($xl_mens_tank > 0)
	<tr>
		<td>XL Men's Tank Top</td>
		<td>{{$xl_mens_tank}}</td>
	</tr>
	@endif
	@if($xl2_mens_tank > 0)
	<tr>
		<td>2XL Men's Tank Top</td>
		<td>{{$xl2_mens_tank}}</td>
	</tr>
	@endif

	@if($small_womens_tank > 0)
	<tr>
		<td>Small Women's Tank Top</td>
		<td>{{$small_womens_tank}}</td>
	</tr>
	@endif
	@if($medium_womens_tank > 0)
	<tr>
		<td>Medium Women's Tank Top</td>
		<td>{{$medium_womens_tank}}</td>
	</tr>
	@endif
	@if($large_womens_tank > 0)
	<tr>
		<td>Large Women's Tank Top</td>
		<td>{{$large_womens_tank}}</td>
	</tr>
	@endif
	@if($xl_womens_tank > 0)
	<tr>
		<td>XL Women's Tank Top</td>
		<td>{{$xl_womens_tank}}</td>
	</tr>
	@endif
	@if($xl2_womens_tank > 0)
	<tr>
		<td>2XL Women's Tank Top</td>
		<td>{{$xl2_womens_tank}}</td>
	</tr>
	@endif

	@if($small_crewneck > 0)
	<tr>
		<td>Small Crew Neck Sweatshirt</td>
		<td>{{$small_crewneck}}</td>
	</tr>
	@endif
	@if($medium_crewneck > 0)
	<tr>
		<td>Medium Crew Neck Sweatshirt</td>
		<td>{{$medium_crewneck}}</td>
	</tr>
	@endif
	@if($large_crewneck > 0)
	<tr>
		<td>Large Crew Neck Sweatshirt</td>
		<td>{{$large_crewneck}}</td>
	</tr>
	@endif
	@if($xl_crewneck > 0)
	<tr>
		<td>XL Crew Neck Sweatshirt</td>
		<td>{{$xl_crewneck}}</td>
	</tr>
	@endif
	@if($xl2_crewneck > 0)
	<tr>
		<td>2XL Crew Neck Sweatshirt</td>
		<td>{{$xl2_crewneck}}</td>
	</tr>
	@endif
	@if($xl3_crewneck > 0)
	<tr>
		<td>3XL Crew Neck Sweatshirt</td>
		<td>{{$xl3_crewneck}}</td>
	</tr>
	@endif
	@if($xl4_crewneck > 0)
	<tr>
		<td>4XL Crew Neck Sweatshirt</td>
		<td>{{$xl4_crewneck}}</td>
	</tr>
	@endif

	@if($small_hooded > 0)
	<tr>
		<td>Small Hooded Sweatshirt</td>
		<td>{{$small_hooded}}</td>
	</tr>
	@endif
	@if($medium_hooded > 0)
	<tr>
		<td>Medium Hooded Sweatshirt</td>
		<td>{{$medium_hooded}}</td>
	</tr>
	@endif
	@if($large_hooded > 0)
	<tr>
		<td>Large Hooded Sweatshirt</td>
		<td>{{$large_hooded}}</td>
	</tr>
	@endif
	@if($xl_hooded > 0)
	<tr>
		<td>XL Hooded Sweatshirt</td>
		<td>{{$xl_hooded}}</td>
	</tr>
	@endif
	@if($xl2_hooded > 0)
	<tr>
		<td>2XL Hooded Sweatshirt</td>
		<td>{{$xl2_hooded}}</td>
	</tr>
	@endif
	@if($xl3_hooded > 0)
	<tr>
		<td>3XL Hooded Sweatshirt</td>
		<td>{{$xl3_hooded}}</td>
	</tr>
	@endif
	@if($xl4_hooded > 0)
	<tr>
		<td>4XL Hooded Sweatshirt</td>
		<td>{{$xl4_hooded}}</td>
	</tr>
	@endif

	@if($hat > 0)
	<tr>
		<td>Hat</td>
		<td>{{$hat}}</td>
	</tr>
	@endif
</table>

@stop