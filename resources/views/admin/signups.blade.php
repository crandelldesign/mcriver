@extends('admin.templates.admin')
@section('head')
<link rel="stylesheet" type="text/css" href="{{ url('/css/datatables.min.css') }}" />
@stop
@section('content-header')
    <h1>Sign Ups</h1>
@stop
@section('body')
    <div class="row">
        <div class="col-lg-10">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Sign Ups for {{date('Y')}}</h2>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped orders">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Registered</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td data-search="{{$order->name}}"><a href="#" class="btn-order-details" data-order="{{$order->id}}">{{$order->person1}}</a></td>
                                    <td>{{$order->phone}}</td>
                                    <td>{{date('n/d/Y',strtotime($order->created_at))}}</td>
                                    <td>${{$order->total}}</td>
                                    <td>{{ucfirst($order->payment_method)}}</td>
                                    <td class="is-paid">{{($order->is_paid)?'Paid':'Unpaid'}}</td>
                                    <td>@if($order->is_paid)
                                    <button data-order="{{$order->id}}" class="btn btn-default btn-xs btn-mark-unpaid">Make Unpaid</button>
                                    @else
                                    <button data-order="{{$order->id}}" class="btn btn-default btn-xs btn-mark-paid">Make Paid</button>
                                    @endif</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/t/bs/dt-1.10.11/datatables.js"></script>
<script>
    $(document).ready(function()
    {
        $('.orders').DataTable({
            paging: false,
        });

        $('.orders').on('click','.btn-mark-unpaid',function(event)
        {
            element = $(this);
            order_id = element.data('order');
            $.ajax({
                type: 'GET',
                url: '{{url("/")}}/admin/order-mark-unpaid',
                data: 'id='+ encodeURIComponent(order_id),
                dataType: 'json',
                success: function(result)
                {
                    element.removeClass('btn-mark-unpaid').addClass('btn-mark-paid').html('Make Paid');
                    element.parents('tr').children('.is-paid').html('Unpaid');
                }
            });
        });
        $('.orders').on('click','.btn-mark-paid',function(event)
        {
            element = $(this);
            order_id = element.data('order');
            $.ajax({
                type: 'GET',
                url: '{{url("/")}}/admin/order-mark-paid',
                data: 'id='+ encodeURIComponent(order_id),
                dataType: 'json',
                success: function(result)
                {
                    element.removeClass('btn-mark-paid').addClass('btn-mark-unpaid').html('Make Unpaid');
                    element.parents('tr').children('.is-paid').html('Paid');
                }
            });
        });
        $('.orders').on('click','.btn-order-details',function(event)
        {
            element = $(this);
            order_id = element.data('order');
            $.ajax({
                type: 'GET',
                url: '{{url("/")}}/api/order/'+order_id,
                success: function(result)
                {
                    console.log(result);
                    //element.removeClass('btn-mark-unpaid').addClass('btn-mark-paid').html('Make Paid');
                    //element.parents('tr').children('.is-paid').html('Unpaid');
                }
            });
        });

    });
</script>
@stop