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
                @if(!empty($category->items))
                @foreach($category->items as $item)
                @endforeach
                @endif
                @if(empty($category->items))
                <p>There are no products add yet. Please enter one below.</p>
                @endif
                </div>
            </div>

            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Enter New Product</h2>
                </div>
                <div class="box-body">
                    <form method="post" action="{{url('/')}}/admin/post-product">
                        <div class="form-group">
                            <label for="categoryName">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="categoryName">Product Nick Name</label>
                            <input type="text" class="form-control" id="productShortName" name="productShortName" placeholder="Enter nick name">
                        </div>
                        <div class="form-group">
                            <label for="categoryName">Price</label>
                            <input type="text" class="form-control" id="productPrice" name="productPrice" placeholder="Enter price">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name=categoryId value="{{$category->id}}">
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop