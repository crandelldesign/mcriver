@extends('layouts.admin')
@section('content-header')
	<h1>{{$category->name}}</h1>
@stop
@section('content')
	<div class="row">
        <div class="col-lg-8">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Products</h2>
                </div>
                <div class="box-body">
                @if(count($items) != 0)
                	<div class="dd" id="items">
						<ol class="dd-list">
                		@foreach($items as $item)
                			<li class="dd-item dd3-item" data-id="{{$item->id}}">
								<div class="dd-handle dd3-handle">Drag</div>
								<div class="dd3-content">
									{{$item->name}}
									<div class="pull-right">
                                        @if($item->price != 0)
                                        ${{number_format($item->price, 2)}}&nbsp;&nbsp;&nbsp;
                                        @endif
										<button class="btn btn-info btn-sm btn-edit-item" data-toggle="tooltip" data-placement="top" title="Edit this Product"><i class="fa fa-pencil"></i></button>
										<button class="btn btn-danger btn-sm btn-delete-item" data-toggle="tooltip" data-placement="top" title="Delete this Product"><i class="fa fa-trash"></i></button>
									</div>
								</div>
                                @if(count($item->children) != 0)
                                <ol class="dd-list">
                                    @foreach($item->children as $item)
                                    <li class="dd-item dd3-item" data-id="{{$item->id}}">
                                        <div class="dd-handle dd3-handle">Drag</div>
                                        <div class="dd3-content">
                                            {{$item->name}}
                                            <div class="pull-right">
                                                @if($item->price != 0)
                                                ${{number_format($item->price, 2)}}&nbsp;&nbsp;&nbsp;
                                                @endif
                                                <button class="btn btn-info btn-sm btn-edit-item" data-toggle="tooltip" data-placement="top" title="Edit this Product"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-sm btn-delete-item" data-toggle="tooltip" data-placement="top" title="Delete this Product"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ol>
                                @endif
							</li>
                		@endforeach
                		</ol>
                	</div>
                @endif
                @if(count($items) == 0)
                <p>There are no products added yet. Please enter one below.</p>
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
                        @if(!$category->is_no_sizes)
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
				        <input type="hidden" name=isOneSize value="1">
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
    <!-- Modal -->
    <div class="modal fade" id="editProductModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Product</h4>
                </div>
                <div class="modal-body">
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
                        @if(!$category->is_no_sizes)
                        <div class="form-group">
                            <label for="isOneSize">Is this one size fits all?</label><br>
                            <label class="radio-inline">
                                <input type="radio" name="isOneSize" id="editIsOneSize1" value="1"> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="isOneSize" id="editIsOneSize2" value="0" checked> No
                            </label>
                        </div>
                        @else
                        <input type="hidden" name=isOneSize value="1">
                        @endif
                        <div class="form-group">
                            <input type="hidden" name=categoryId value="{{$category->id}}">
                            <button type="submit" class="btn btn-primary">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteProductModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Product</h4>
                </div>
                <div class="modal-body text-center">
                    <p>Are you sure?</p>
                    <p><a class="btn btn-delete-confirm btn-danger" href="{{url('/')}}/admin/delete-item/{{$category->id}}">Yes</a>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">No</button></p>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
<script>
	$(function () {
        var categoryId = {{$category->id}};
        var nestableDepth = {{($category->is_no_sizes)?1:2}};
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
        	maxDepth: nestableDepth
    	}).on('change', updateOutput);
        $('.btn-edit-item').click(function()
        {
            var itemID = $(this).parents('li').data('id');
            $.ajax({
                type: 'GET',
                url: '{{url("/")}}/api/items/'+categoryId+'/'+itemID,
                data: {item : itemID},
                dataType: 'json',
                async: true,
                success: function(result)
                {
                    $("#editProductModal form").attr('action', "{{url('/')}}/admin/post-item/"+result.id);
                    $('#editProductModal #productName').val(result.name);
                    $('#editProductModal #productShortName').val(result.short_name);
                    $('#editProductModal #productPrice').val(result.price);
                    if(result.is_no_sizes) {
                        $('#editProductModal #editIsOneSize1').prop('checked',true);
                        $('#editProductModal #editIsOneSize2').prop('checked',false);
                    } else {
                        $('#editProductModal #editIsOneSize1').prop('checked',false);
                        $('#editProductModal #editIsOneSize2').prop('checked',true);
                    }
                    //$('#editCategoryModal input[type=radio]').prop('checked',(result.is_no_sizes)?true:false);
                    $('#editProductModal').modal('show');
                }
            });
        });
        $('.btn-delete-item').click(function()
        {
            var itemID = $(this).parents('li').data('id');
            $('#deleteProductModal .btn-delete-confirm').attr('href', "{{url('/')}}/admin/delete-item/"+categoryId+'/'+itemID);
            $('#deleteProductModal').modal('show');
        });
	});
</script>
@stop