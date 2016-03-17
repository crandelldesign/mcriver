@extends('master.templates.master')
@section('body')
<h1>Complete Your Order</h1>

<form class="form-horizontal" method="post">
<div class="row">
	<div class="col-md-6">
            <h2>Names</h2>
            <div class="people-info">
                @for($i = 1; $i <= $order->people; $i++)
                <div class="form-group">
                    <label class="control-label col-sm-3">
                        Person #{{$i}}
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="{{($i == 1 && \Auth::check())?\Auth::user()->name:''}}" name="person{{$i}}" id="person-{{$i}}" class="form-control" data-person="{{$i}}">
                    </div>
                </div>
                @endfor
            </div>

            <h2>Credit Card Info</h2>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="card-holder-name">Name on Card</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
                </div>
            </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="card-number">Card Number</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="card-number" id="card-number" placeholder="Debit/Credit Card Number">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="expiry-month">Expiration Date</label>
                <div class="col-sm-9">
                  <div class="row">
                    <div class="col-xs-3">
                      <select class="form-control col-sm-2" name="expiry-month" id="expiry-month">
                        <option>Month</option>
                        <option value="01">Jan (01)</option>
                        <option value="02">Feb (02)</option>
                        <option value="03">Mar (03)</option>
                        <option value="04">Apr (04)</option>
                        <option value="05">May (05)</option>
                        <option value="06">June (06)</option>
                        <option value="07">July (07)</option>
                        <option value="08">Aug (08)</option>
                        <option value="09">Sep (09)</option>
                        <option value="10">Oct (10)</option>
                        <option value="11">Nov (11)</option>
                        <option value="12">Dec (12)</option>
                      </select>
                    </div>
                    <div class="col-xs-3">
                      <select class="form-control" name="expiry-year">
                        <option value="13">2013</option>
                        <option value="14">2014</option>
                        <option value="15">2015</option>
                        <option value="16">2016</option>
                        <option value="17">2017</option>
                        <option value="18">2018</option>
                        <option value="19">2019</option>
                        <option value="20">2020</option>
                        <option value="21">2021</option>
                        <option value="22">2022</option>
                        <option value="23">2023</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="cvv">Card CVV</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" name="cvv" id="cvv" placeholder="Security Code">
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
        <a href="{{url('/')}}/sign-up/4" class="btn btn-default center-block">Complete Your Order</a>
    </div>
</div>

</form>
@stop