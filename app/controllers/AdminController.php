<?php

class AdminController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Admin Controller
	|--------------------------------------------------------------------------
	*/

	public function __construct()
    {
		$this->beforeFilter(function()
        {
            if(!Auth::check())
                return Redirect::to('/admin/login');
        }, array('except' => array('getLogin', 'postLogin', 'getLogout')));

	}

	public function getIndex()
    {
        $code = array();
        $vw = View::make('admin.index')->with('code', implode(' ', $code));
        $vw->title = "Admin | McRiver";
        $vw->description = "McRiver Admin Panel";
        return $vw;
    }

    public function getLogin()
    {
        $code = array();
        $vw = View::make('admin.login')->with('code', implode(' ', $code));
        $vw->title = "Login | McRiver";
        $vw->description = "Login for McRiver Admin Panel";
        return $vw;
    }

    public function postLogin()
	{
		$username = Input::get('username');
        $password = Input::get('password');
        if(Auth::attempt(array('username'=>$username,'password'=>$password)))
        {
        	return Redirect::to(url('/').'/admin');
        } else {
        	return Redirect::to(url('/').'/admin/login')->with(array('signInError' => true));
        }
	}

	public function getChangePassword()
	{
		$code = array();
        //$code[] = View::make('home.jscode.index');
        $vw = View::make('admin.change-password')->with('code', implode(' ', $code));
        $vw->title = "Change Your Password - McRiver";
        $vw->description = "";

        return $vw;
	}

	public function postChangePassword()
	{
		$validator = Validator::make(
            Input::all(),
            array(
                'current_password' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            )
        );
        if ($validator->fails())
        {
            return Redirect::to(url('/').'/admin/change-password')->withErrors($validator);
        }
        if(!Auth::validate(array('email' => Auth::User()->email, 'password' => Input::get('current_password'))))
        {
            return Redirect::to(url('/').'/admin/change-password')->with(array('invalid_password' => 'true'));
        }
        $user = Auth::User();
        $user->password = Input::get('password');
        $user->save();
        return Redirect::to(url('/').'/admin')->with(array('password_changed' => 'true'));
	}

	public function getLogout()
    {
        Auth::logout();
        return Redirect::to(url('/').'/admin/login');
    }

    public function getOrders()
    {
        $code = array();
        $vw = View::make('admin.orders')->with('code', implode(' ', $code));
        $vw->title = "Admin | McRiver";
        $vw->description = "McRiver Admin Panel";

        $orders = Person::where('year','=',2015);
        if(Input::get('name'))
        	$orders = $orders->where('name','LIKE',Input::get('name').'%');
        $vw->orders = $orders->get();

        if(Input::get('name'))
        	$vw->filter = Input::get('name');

        return $vw;
    }

    public function getOrderMarkUnpaid()
    {
    	$person = Person::find(Input::get('id'));
        if(!$person)
            return;

        $person->is_paid = 0;
        $person->save();

        return $person;
    }

    public function getOrderMarkPaid()
    {
    	$person = Person::find(Input::get('id'));
        if(!$person)
            return;

        $person->is_paid = 1;
        $person->save();

        return $person;
    }

}