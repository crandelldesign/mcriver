@extends('admin.templates.admin')
@section('content-header')
	<h1>Products</h1>
@stop
@section('body')
	<div class="row">
		<div class="col-lg-8">
			<div class="box">
				<div class="box-header">
					<h2 class="box-title">Product Categories</h2>
				</div>
				<div class="box-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
						@foreach($categories as $category)
							<tr>
								<td>{{$category->name}}</td>
								<td>{{$category->description}}</td>
								<td><button class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></button></td>
								<td><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
							</tr>
						@endforeach
						</tbody>
					</table>
					@if(empty($categories))
					<p>There are no catgeories yet for the products. Please enter one below.</p>
					@endif
				</div>

			</div>

			<div class="box">
				<div class="box-header">
					<h2 class="box-title">Enter New Category</h2>
				</div>
				<div class="box-body">
					<form method="post" action="{{url('/')}}/admin/post-products">
						<div class="form-group">
				            <label for="categoryName">Category Name</label>
				            <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Enter name">
				        </div>
				        <div class="form-group">
				            <label for="categoryDescription">Textarea</label>
				            <textarea class="form-control" rows="3" id="categoryDescription" name="categoryDescription" placeholder="Enter Description"></textarea>
				        </div>
				        <div class="form-group">
				        	<label for="isHasSizes">Do the products in this category have sizes?</label><br>
				        	<label class="radio-inline">
								<input type="radio" name="isHasSizes" id="isHasSizes1" value="1"> Yes
							</label>
							<label class="radio-inline">
								<input type="radio" name="isHasSizes" id="isHasSizes2" value="0" checked> No
							</label>
				        </div>
				        <div class="form-group">
				        	{!! csrf_field() !!}
				        	<button type="submit" class="btn btn-primary">Add Category</button>
				        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop