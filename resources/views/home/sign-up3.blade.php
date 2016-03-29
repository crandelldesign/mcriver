@extends('master.templates.master')
@section('body')
<h1>Complete Your Order</h1>

@if (session('stripe_errors'))
    <div class="alert alert-danger">
        <ul>
            <li>{{ session('stripe_errors') }}</li>
        </ul>
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="form-horizontal" method="post">
<div class="row">
	<div class="col-md-6">
        <h2 class="margin-top-0">Names</h2>
        <div class="people-info">
            @for($i = 1; $i <= $order->people; $i++)
            <div class="form-group">
                <label class="control-label col-sm-3">
                    Person #{{$i}}
                </label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input type="text" value="{{($i == 1 && \Auth::check())?\Auth::user()->name:''}}" name="person{{$i}}" id="person-{{$i}}" class="form-control" data-person="{{$i}}">
                        <span class="input-group-addon">
                            <span>Is this person a rookie?&nbsp;</span>
                            <input type="checkbox" aria-label="Is this person a rookie?" name="is_rookie_person{{$i}}" id="is-rookie-person-{{$i}}">
                        </span>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <h2>Contact Info</h2>
        <div class="form-group">
            <label class="control-label col-sm-3">
                Email
            </label>
            <div class="col-sm-9">
                <input type="email" value="{{(\Auth::check())?\Auth::user()->email:''}}" name="email" id="email\" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">
                Phone
            </label>
            <div class="col-sm-9">
                <input type="text" value="{{(\Auth::check())?\Auth::user()->phone:''}}" name="phone" id="phone" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">
                Payment Method
            </label>
            <div class="col-sm-9">
                <label class="radio-inline">
                    <input type="radio" name="payment_method" id="payment-method1" value="credit card" checked class="payment-method-toggle"> Credit Card
                </label>
                <label class="radio-inline">
                    <input type="radio" name="payment_method" id="payment-method2" value="check" class="payment-method-toggle"> Check
                </label>
            </div>
        </div>

        <div class="credit-card-section">
            <h2>Credit Card Info</h2>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="card-holder-name">Name on Card</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="card_holder_name" id="card-holder-name" placeholder="Card Holder's Name">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="card-number">Card Number</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="card_number" id="card-number" placeholder="Debit/Credit Card Number" data-stripe="number">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="expiry_month">Expiration Date</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-xs-3">
                            <select class="form-control col-sm-2" name="expiry_month" id="expiry-month" data-stripe="exp-month">
                                <option>Month</option>
                                <option value="1">Jan (01)</option>
                                <option value="2">Feb (02)</option>
                                <option value="3">Mar (03)</option>
                                <option value="4">Apr (04)</option>
                                <option value="5">May (05)</option>
                                <option value="6">June (06)</option>
                                <option value="7">July (07)</option>
                                <option value="8">Aug (08)</option>
                                <option value="9">Sep (09)</option>
                                <option value="10">Oct (10)</option>
                                <option value="11">Nov (11)</option>
                                <option value="12">Dec (12)</option>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="expiry_year" data-stripe="exp-year">
                                <option>Year</option>
                                @for($i = 0; $i <= 10; $i++)
                                <option value="{{date('y', strtotime('+'.$i.' years'))}}">{{date('Y', strtotime('+'.$i.' years'))}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="cvc">Card CVC</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="cvc" id="cvc" placeholder="Security Code" data-stripe="cvc">
                </div>
            </div>
        </div>
	</div>
	<div class="col-md-6">
		<h2 class="margin-top-0">Review Your Order</h2>
        <table class="table table-striped">
        @for($i = 1; $i <= $order->people; $i++)
            <tr class="person-{{$i}}-row" data-person="{{$i}}">
                <td>{{($i == 1 && \Auth::check())?\Auth::user()->name:'Person #'.$i}}</td>
                <td>$53</td>
            </tr>
        @endfor
        @foreach($order->items as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>${{$item->price}}</td>
            </tr>
        @endforeach
            <tr>
                <th>Total</th>
                <th>${{$order->total}}</th>
            </tr>
        </table>
	</div>
</div>
<div class="row">
    <div class="col-md-4">
        <button type="submit" class="btn btn-lg center-block btn-primary">Complete Your Order</button>
    </div>
</div>

<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

</form>
@stop
@section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
    $('.payment-method-toggle').change(function()
    {
        if ($(this).val() == 'credit card') {
            $('.credit-card-section').show();
        } else {
            $('.credit-card-section').hide();
        }
    });
</script>
@stop