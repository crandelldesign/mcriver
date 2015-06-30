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

    public function getEquipment()
    {
        $code = array();
        $vw = View::make('admin.equipment')->with('code', implode(' ', $code));
        $vw->title = "Admin | McRiver";
        $vw->description = "McRiver Admin Panel";

        $orders = Person::where('year','=',2015)->get();
        $equipment = '';
        foreach ($orders as $order)
        {
            $equipment = $equipment.', '.$order->items;
        }
        $vw->regular_tube = substr_count($equipment, 'Regular Tube');
        $vw->regular_tube_bottom = substr_count($equipment, 'Regular Tube with Bottom');
        $vw->deluxe_tube = substr_count($equipment, 'Deluxe Tube');
        $vw->cooler_tube = substr_count($equipment, 'Cooler Tube');
        $vw->small_mens_t = substr_count($equipment, "Small Men's T-Shirt");
        $vw->medium_mens_t = substr_count($equipment, "Medium Men's T-Shirt");
        $vw->large_mens_t = substr_count($equipment, "Large Men's T-Shirt");
        $vw->xl_mens_t = substr_count($equipment, "XL Men's T-Shirt");
        $vw->xl2_mens_t = substr_count($equipment, "2XL Men's T-Shirt");
        $vw->xl3_mens_t = substr_count($equipment, "3XL Men's T-Shirt");
        $vw->xl4_mens_t = substr_count($equipment, "4XL Men's T-Shirt");
        $vw->small_mens_tank = substr_count($equipment, "Small Men's Tank Top");
        $vw->medium_mens_tank = substr_count($equipment, "Medium Men's Tank Top");
        $vw->large_mens_tank = substr_count($equipment, "Large Men's Tank Top");
        $vw->xl_mens_tank = substr_count($equipment, "XL Men's Tank Top");
        $vw->xl2_mens_tank = substr_count($equipment, "2XL Men's Tank Top");
        $vw->small_womens_tank = substr_count($equipment, "Small Women's Tank Top");
        $vw->medium_womens_tank = substr_count($equipment, "Medium Women's Tank Top");
        $vw->large_womens_tank = substr_count($equipment, "Large Women's Tank Top");
        $vw->xl_womens_tank = substr_count($equipment, "XL Women's Tank Top");
        $vw->xl2_womens_tank = substr_count($equipment, "2XL Women's Tank Top");
        $vw->small_crewneck = substr_count($equipment, "Small Crew Neck Sweatshirt");
        $vw->medium_crewneck = substr_count($equipment, "Medium Crew Neck Sweatshirt");
        $vw->large_crewneck = substr_count($equipment, "Large Crew Neck Sweatshirt");
        $vw->xl_crewneck = substr_count($equipment, "XL Crew Neck Sweatshirt");
        $vw->xl2_crewneck = substr_count($equipment, "2XL Crew Neck Sweatshirt");
        $vw->xl3_crewneck = substr_count($equipment, "3XL Crew Neck Sweatshirt");
        $vw->xl4_crewneck = substr_count($equipment, "4XL Crew Neck Sweatshirt");
        $vw->small_hooded = substr_count($equipment, "Small Hooded Sweatshirts");
        $vw->medium_hooded = substr_count($equipment, "Medium Hooded Sweatshirts");
        $vw->large_hooded = substr_count($equipment, "Large Hooded Sweatshirts");
        $vw->xl_hooded = substr_count($equipment, "XL Hooded Sweatshirts");
        $vw->xl2_hooded = substr_count($equipment, "2XL Hooded Sweatshirts");
        $vw->xl3_hooded = substr_count($equipment, "3XL Hooded Sweatshirts");
        $vw->xl4_hooded = substr_count($equipment, "4XL Hooded Sweatshirts");
        $vw->hat = substr_count($equipment, "Hat");

        if(Input::get('name'))
            $vw->filter = Input::get('name');

        return $vw;
    }

}