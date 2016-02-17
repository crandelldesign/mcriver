@extends('admin.templates.admin')
@section('content-header')
	<h1>{{$category->name}}</h1>
@stop
@section('body')
	<div class="row">
        <div class="col-lg-8">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Products</h2>
                </div>
                <div class="box-body">
                @if(!empty($items))
                	<div class="dd" id="items">
						<ol class="dd-list">
                		@foreach($items as $item)
                			<li class="dd-item dd3-item" data-id="{{$item->id}}">
								<div class="dd-handle dd3-handle">Drag</div>
								<div class="dd3-content">
									{{$item->name}}
									<div class="pull-right">
										<button class="btn btn-info btn-sm btn-edit-item" data-toggle="tooltip" data-placement="top" title="Edit this Product"><i class="fa fa-pencil"></i></button>
										<button class="btn btn-danger btn-sm btn-delete-item" data-toggle="tooltip" data-placement="top" title="Delete this Product"><i class="fa fa-trash"></i></button>
									</div>
								</div>
							</li>
                		@endforeach
                		</ol>
                	</div>
                @endif
                @if(empty($items))
                <p>There are no products add yet. Please enter one below.</p>
                @endif
                </div>
            </div>

            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Enter New Product</h2>
                </div>
                <div class="box-body">
                    <form method="post" action="{{url('/')}}/admin/post-item">
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="productShortName">Product Nick Name</label>
                            <input type="text" class="form-control" id="productShortName" name="productShortName" placeholder="Enter nick name">
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Price</label>
                            <input type="text" class="form-control" id="productPrice" name="productPrice" placeholder="Enter price">
                        </div>
                        @if($category->is_no_sizes)
                        <div class="form-group">
				        	<label for="isOneSize">Is this one size fits all?</label><br>
				        	<label class="radio-inline">
								<input type="radio" name="isOneSize" id="isOneSize1" value="1"> Yes
							</label>
							<label class="radio-inline">
								<input type="radio" name="isOneSize" id="isOneSize2" value="0" checked> No
							</label>
				        </div>
				        @else
				        <input type="hidden" name=isOneSize value="0">
				        @endif
                        <div class="form-group">
                            <input type="hidden" name=categoryId value="{{$category->id}}">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
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
		        url: '{{url("/")}}/admin/post-items-order',
		        data: {itemOrder :list.nestable('serialize')},
		        dataType: 'json',
		        async: true,
		        success: function(result)
	        	{

	        	}
        	});
	    };
		$('[data-toggle="tooltip"]').tooltip();
		$('#items').nestable({
        	maxDepth: 2
    	}).on('change', updateOutput);
	});
</script>
@stop