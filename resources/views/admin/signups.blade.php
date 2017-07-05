@extends('layouts.admin')
@section('head')
<link rel="stylesheet" type="text/css" href="{{ url('/css/datatables.min.css') }}" />
@stop
@section('content-header')
    <h1>Sign Ups</h1>
@stop
@section('content')
    <div class="box">
        <div class="box-header">
            <h2 class="box-title">Sign Ups for {{date('Y')}}</h2>
            <div class="box-tools">
                Total: <strong>{{$sign_up_total}}</strong>&nbsp;&nbsp;
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#notify-all-modal">Send Notification Emails</button>
            </div>
        </div>
        <div class="box-body">
            @if(count($orders) > 0)
            <div class="table-responsive">
                <table class="table table-striped orders">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>People in Party</th>
                            <th>Email</th>
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
                            <td data-search="{{$order->name}}"><a href="#" class="btn-order-details" data-order="{{$order->id}}">{{$order->name}}</a></td>
                            <td>{{$order->person_count}}</td>
                            <td>{{$order->email}}</td>
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
                    <tfoot>
                        <tr>
                            <th class="text-right" colspan="9">Total: <strong>{{$sign_up_total}}</strong></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @else
            <p>There are no orders for {{date('Y')}}.</p>
            @endif
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h2 class="box-title">Rookies for {{date('Y')}}</h2>
            <div class="box-tools">
                Total: <strong>{{count($rookies)}}</strong>
            </div>
        </div>
        <div class="box-body">
            @if(count($rookies) > 0)
            <div class="table-responsive">
                <table class="table table-striped orders">
                    <thead>
                        <tr>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rookies as $rookie)
                        <tr>
                            <td>{{$rookie->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h2 class="box-title">Dishes for {{date('Y')}}</h2>
        </div>
        <div class="box-body">
            <p><small>Note: If somebody has volunteered to bring food more than one day, it will show up for all days.</small></p>
            <div class="row">
                @if(count($friday_meals) > 0)
                    <div class="col-md-6">
                        <h2>Friday</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Dishes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($friday_meals as $meal)
                                <tr>
                                    <td>{{$meal->person1}}</td>
                                    <td>{{(strlen($meal->dish_description) > 0)?$meal->dish_description:'N/A'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @if(count($saturday_meals) > 0)
                    <div class="col-md-6">
                        <h3>Saturday</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Dishes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($saturday_meals as $meal)
                                <tr>
                                    <td>{{$meal->person1}}</td>
                                    <td>{{(strlen($meal->dish_description) > 0)?$meal->dish_description:'N/A'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @if(count($sunday_meals) > 0)
                    <div class="col-md-6">
                        <h3>Sunday</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Dishes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sunday_meals as $meal)
                                <tr>
                                    <td>{{$meal->person1}}</td>
                                    <td>{{(strlen($meal->dish_description) > 0)?$meal->dish_description:'N/A'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            @if(count($friday_meals) == 0 && count($saturday_meals) == 0 && count($sunday_meals) == 0)
            <p>Nobody has volunteered to bring food this year.</p>
            @endif
        </div>
    </div>

    <div class="modal fade" id="modal-order" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Order Details</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped order-details">
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer no-print">
                    <button type="button" class="btn btn-lg btn-success print-modal">Print</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="notify-all-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <p><strong>Warning:</strong> This will send an email to all orders. Are you sure you want to continue?</p>
                    </div>
                    <div class="alert alert-success notify-all-success" style="display:none">
                        <p>Emails have been sent successfully.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-send-notifcation-emails">Send</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script id="order-details-template" type="x-tmpl-mustache">
        @{{#each persons}}
            <tr>
                <td>@{{name}}@{{#if is_rookie}}<small> (rookie)</small>@{{/if}}</td>
                <td class="text-right">$53</td>
            </tr>
        @{{/each}}
        @{{#each items}}
            <tr>
                <td>@{{name}}</td>
                <td class="text-right">$@{{price}}</td>
            </tr>
        @{{/each}}
        <tr>
            <th>Total</th>
            <th class="text-right">$@{{total}}</th>
        </tr>
    </script>
@stop
@section('scripts')
<script type="text/javascript" src="{{url('/')}}/js/datatables.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/jQuery.print.js"></script>
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
            event.preventDefault();
            element = $(this);
            order_id = element.data('order');
            $.ajax({
                type: 'GET',
                url: '{{url("/")}}/api/order/'+order_id,
                success: function(result)
                {
                    var persons = result.persons;
                    var source = $("#order-details-template").html();
                    var template = Handlebars.compile(source);
                    var html = template({
                        items: result.items,
                        persons: persons,
                        total: result.total
                    });
                    $('.order-details tbody').html(html);
                    $('#modal-order').modal('show');
                }
            });
        });
        $('.print-modal').click(function(event)
        {
            $('.modal.in .modal-content').print();
        });
        $('.btn-send-notifcation-emails').on('click', function(event)
        {
            $(this).prop('disabled', true);
            $.ajax({
                type: 'GET',
                url: '{{url("/")}}/admin/notify-sign-ups',
                data: 'year={{date("Y")}}',
                dataType: 'json',
                success: function(result)
                {
                    $('.notify-all-success').show();
                    setTimeout(function()
                    {
                        $('#notify-all-modal').modal('hide');
                        $('.notify-all-success').hide();
                        $(this).prop('disabled', false);
                    }, 3000);
                }
            });
        });
    });
</script>
@stop
