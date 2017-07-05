@extends('layouts.default')
@section('content')
<h1>Dishes for {{date('Y')}}</h1>

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
@stop
