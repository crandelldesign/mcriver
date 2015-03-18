<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
        $vw = View::make('home.index');
        $vw->title = "McRiver Raid 2015";
        $vw->description = "";
        return $vw;
	}

	public function getSignUp()
	{
        $vw = View::make('home.signup');
        $vw->title = "Sign Up to Party";
        $vw->description = "";
        return $vw;
	}

	public function postSignUp()
	{
		$vw = View::make('home.confirm');
        $vw->title = "Confirm Your Order";
        $vw->description = "";

        print_r(Input::all());

        $vw->basic_info = Input::all();

        return $vw;
	}

}
