@extends('admin.templates.admin')
@section('head')
<link rel="stylesheet" type="text/css" href="{{ url('/css/datatables.min.css') }}" />
@stop
@section('content-header')
    <h1>Sign Ups</h1>
@stop
@section('body')
    <div class="row">
        <div class="col-lg-8">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Sign Ups for {{date('Y')}}</h2>
                </div>
                <div class="box-body">
                    <table class="table table-striped orders">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Registered</th>
                                <th style="width: 450px">Items Ordered</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->name}}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
<script src="{{ url('/js/datatables.min.js') }}"></script>
<script>
    $('.orders').DataTable();
</script>
@stop