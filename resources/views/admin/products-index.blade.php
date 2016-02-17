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
					@if(!empty($categories))
					<div class="dd" id="categories">
						<ol class="dd-list">
						@foreach($categories as $category)
							<li class="dd-item dd3-item" data-id="{{$category->id}}">
								<div class="dd-handle dd3-handle">Drag</div>
								<div class="dd3-content">
									{{$category->name}}
									<div class="pull-right">
										<a href="{{url('/')}}/admin/products/{{$category->id}}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit the Products for this Category"><i class="fa fa-chevron-right"></i></a>
										<button class="btn btn-info btn-sm btn-edit-category" data-toggle="tooltip" data-placement="top" title="Edit this Category"><i class="fa fa-pencil"></i></button>
										<button class="btn btn-danger btn-sm btn-delete-category" data-toggle="tooltip" data-placement="top" title="Delete this Category"><i class="fa fa-trash"></i></button>
									</div>
								</div>
							</li>
						@endforeach
						</ol>
					</div>
					@endif
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
					<form method="post" action="{{url('/')}}/admin/post-categories">
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
	<!-- Modal -->
	<div class="modal fade" id="editCategoryModal" role="dialog">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Category</h4>
				</div>
				<div class="modal-body">
					<form method="post" action="{{url('/')}}/admin/post-categories">
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
								<input type="radio" name="isHasSizes" id="editIsHasSizes1" value="1"> Yes
							</label>
							<label class="radio-inline">
								<input type="radio" name="isHasSizes" id="editIsHasSizes2" value="0"> No
							</label>
				        </div>
				        <div class="form-group">
				        	<button type="submit" class="btn btn-primary">Save Category</button>
				        </div>
					</form>
				</div>
		    </div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="deleteCategoryModal" role="dialog">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Delete Category</h4>
				</div>
				<div class="modal-body text-center">
					<p>Are you sure?</p>
					<p><a class="btn btn-delete-confirm btn-danger" href="{{url('/')}}/admin/delete-category">Yes</a>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">No</button></p>
				</div>
			</div>
		</div>
	</div>
@stop
@section('scripts')
<script>
	$(function () {
		var updateOutput = function(e)
	    {
	        var list = e.length ? e : $(e.target);
	        $.ajax({
		        type: 'POST',
		        url: '{{url("/")}}/admin/post-categories-order',
		        data: {categoryOrder :list.nestable('serialize')},
		        dataType: 'json',
		        async: true,
		        success: function(result)
	        	{

	        	}
        	});
	    };
		$('[data-toggle="tooltip"]').tooltip();
		$('#categories').nestable({
        	maxDepth: 1
    	}).on('change', updateOutput);
		$('.btn-edit-category').click(function()
		{
			var categoryID = $(this).parents('li').data('id');
			$.ajax({
		        type: 'GET',
		        url: '{{url("/")}}/api/products/'+categoryID,
		        data: {category : categoryID},
		        dataType: 'json',
		        async: true,
		        success: function(result)
	        	{
	        		console.log(result.is_no_sizes);
	        		$("#editCategoryModal form").attr('action', "{{url('/')}}/admin/post-categories/"+result.id);
	        		$('#editCategoryModal #categoryName').val(result.name);
	        		$('#editCategoryModal #categoryDescription').val(result.description);
	        		if(result.is_no_sizes) {
	        			$('#editCategoryModal #editIsHasSizes1').prop('checked',true);
	        			$('#editCategoryModal #editIsHasSizes2').prop('checked',false);
	        		} else {
	        			$('#editCategoryModal #editIsHasSizes1').prop('checked',false);
	        			$('#editCategoryModal #editIsHasSizes2').prop('checked',true);
	        		}
	        		//$('#editCategoryModal input[type=radio]').prop('checked',(result.is_no_sizes)?true:false);
	        		$('#editCategoryModal').modal('show');
	        	}
        	});
		});
		$('.btn-delete-category').click(function()
		{
			var categoryID = $(this).parents('li').data('id');
			$('#deleteCategoryModal .btn-delete-confirm').attr('href', "{{url('/')}}/admin/delete-category/"+categoryID);
			$('#deleteCategoryModal').modal('show');
		});
	});
</script>
@stop