@extends('home.templates.master')
@section('body')

<h1>Confirm Your Order</h1>

<p>Name: <strong>{{$basic_info['name']}}</strong></p>

<p>Email: <strong>{{$basic_info['email']}}</strong></p>

<p>Phone: <strong>{{$basic_info['phone']}}</strong></p>

<p>Total: <strong>${{$basic_info['total']}}</strong></p>

@stop