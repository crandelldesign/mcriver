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
                <?php
                    print_r($category)
                ?>
                @foreach($category->items as $item)
                @endforeach
                @if(empty($category->items))
                <p>There are no catgeories yet for the products. Please enter one below.</p>
                @endif
                </div>
            </div>
        </div>
    </div>
@stop