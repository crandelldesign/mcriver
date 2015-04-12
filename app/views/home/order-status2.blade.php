@extends('home.templates.master', array('var1'=>'', 'var2'=>''))
@section('body')

<h1>Order Status</h1>

<p>Name: <strong>{{$person->name}}</strong></p>

<p>Email: <strong>{{$person->email}}</strong></p>

<table class="table orders-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Date Registered</th>
            <th>Items Ordered</th>
            <th>Total</th>
            <th>Payment Type</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tr data-order="{{$person->id}}">
        <td>{{$person->name}}</td>
        <td>{{date('n/d/Y',strtotime($person->date))}}</td>
        <td>{{rtrim($person->items,',')}}</td>
        <td>{{$person->total}}</td>
        <td>{{ucwords($person->payment_method)}}</td>
        <td>{{($person->is_paid)?'Paid':'Unpaid'}}</td>
    </tr>
</table>

@if($person->is_paid)

<p>Thank you for your order. See you in August!</p>

@elseif($person->payment_method == 'check')

<hr>

<p>If you haven't sent your check in yet, send it to:<br>
    Jim McDonald<br>
    4323 Crestdale Ave<br>
    West Bloomfield, MI 48323<br>
    <strong>All Checks and Money Orders Due June 21, 2015</strong></p>

<p>However, if you want to pay online, click below.</p>

<p><form id="stripeForm" action="/confirm" method="POST">
    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_live_HLWAvzdpzXU7NwFRSBm3SPZI"
        data-image="{{url('/')}}/img/logo-default-square.png"
        data-name="McRiver"
        data-description="{{rtrim($person->items,',')}}"
        data-amount="{{$person->total*100}}">
    </script>
</form></p>

@elseif($person->payment_method == 'online')

<hr>

<p>Your online payment never posted. Please click the button below:</p>

<p><form id="stripeForm" action="/confirm" method="POST">
    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_live_HLWAvzdpzXU7NwFRSBm3SPZI"
        data-image="{{url('/')}}/img/logo-default-square.png"
        data-name="McRiver"
        data-description="{{rtrim($person->items,',')}}"
        data-amount="{{$person->total*100}}">
    </script>
</form></p>

<p>However, if you'd like to send a check, please click below</p>

<p><button class="btn btn-default btn-pay-check" data-order="{{$person->id}}">Pay by Check</button></p>

@endif

<div class="modal fade" id="payByCheck" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mail Your Check</h4>
            </div>
            <div class="modal-body">

                <p>Mail your check to the address below:</p>

                <p>Jim McDonald<br>
                    4323 Crestdale Ave<br>
                    West Bloomfield, MI 48323<br>
                    <strong>All Checks and Money Orders Due June 21, 2015</strong></p>


            </div>
        </div>
    </div>
</div>

@stop

@section('footercode')
<script>
    $('.btn-pay-check').click(function(event)
    {
        element = $(this);
        order_id = element.data('order');
        $.ajax({
            type: 'GET',
            url: '{{url("/")}}/pay-check',
            data: 'id='+ encodeURIComponent(order_id),
            dataType: 'json',
            success: function(result)
            {
                //element.removeClass('btn-mark-paid').addClass('btn-mark-unpaid').html('Make Unpaid');
                $('#payByCheck').modal('show');
            }
        });
    });
</script>
@stop