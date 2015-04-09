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
        $vw->active_page = "home";
        return $vw;
	}

	public function getSignUp()
	{
        $vw = View::make('home.signup');
        $vw->title = "Sign Up to Party";
        $vw->description = "";
        $vw->active_page = "signup";
        return $vw;
	}

	public function postSignUp()
	{
		$vw = View::make('home.confirm');
        $vw->title = "Confirm Your Order";
        $vw->description = "";
        $vw->active_page = "signup";

        $basic_info = Input::all();
        $itemArray = array();
        for($i = 1; $i <= Input::get('regTube'); $i++)
        {
        	$item = new stdClass;
        	$item->name = 'Regular Tube';
        	$item->price = 15;
        	$itemArray[] = $item;
        }
        for($i = 1; $i <= Input::get('regTubeWBottom'); $i++)
        {
        	$item = new stdClass;
        	$item->name = 'Regular Tube with Bottom';
        	$item->price = 17;
        	$itemArray[] = $item;
        }
        for($i = 1; $i <= Input::get('deluxeTube'); $i++)
        {
        	$item = new stdClass;
        	$item->name = 'Deluxe Tube';
        	$item->price = 20;
        	$itemArray[] = $item;
        }
        for($i = 1; $i <= Input::get('coolerTube'); $i++)
        {
        	$item = new stdClass;
        	$item->name = 'Cooler Tube';
        	$item->price = 11;
        	$itemArray[] = $item;
        }
        for($i = 1; $i <= Input::get('tshirtQuanity'); $i++)
        {
        	$item = new stdClass;
        	$attire = explode('-',$basic_info['tshirtSize'.$i]);
        	$item->name = $this->sizeTranslator($attire[0]).' Men\'s T-Shirt';
        	$item->price = $attire[1];
        	$itemArray[] = $item;
        }
        for($i = 1; $i <= Input::get('mtanktopQuanity'); $i++)
        {
        	$item = new stdClass;
        	$attire = explode('-',$basic_info['mtanktopSize'.$i]);
        	$item->name = $this->sizeTranslator($attire[0]).' Men\'s Tank Top';
        	$item->price = $attire[1];
        	$itemArray[] = $item;
        }
        for($i = 1; $i <= Input::get('wtanktopQuanity'); $i++)
        {
        	$item = new stdClass;
        	$attire = explode('-',$basic_info['wtanktopSize'.$i]);
        	$item->name = $this->sizeTranslator($attire[0]).' Women\'s Tank Top';
        	$item->price = $attire[1];
        	$itemArray[] = $item;
        }
        for($i = 1; $i <= Input::get('crewnecksweatshirtsQuanity'); $i++)
        {
        	$item = new stdClass;
        	$attire = explode('-',$basic_info['crewnecksweatshirtsSize'.$i]);
        	$item->name = $this->sizeTranslator($attire[0]).' Crew Neck Sweatshirt';
        	$item->price = $attire[1];
        	$itemArray[] = $item;
        }
        for($i = 1; $i <= Input::get('hoodedsweatshirtsQuanity'); $i++)
        {
        	$item = new stdClass;
        	$attire = explode('-',$basic_info['hoodedsweatshirtsSize'.$i]);
        	$item->name = $this->sizeTranslator($attire[0]).' Hooded Sweatshirts';
        	$item->price = $attire[1];
        	$itemArray[] = $item;
        }
        for($i = 1; $i <= Input::get('hat'); $i++)
        {
        	$item = new stdClass;
        	$item->name = 'Hat';
        	$item->price = 13;
        	$itemArray[] = $item;
        }
        $vw->items = $itemArray;
        Session::put('itemArray', $itemArray);

        $vw->basic_info = Input::all();

        return $vw;
	}

    public function postSubmitOrder()
    {
        if(!Input::all())
            return Redirect::to(url('/'), 301);

        $person = new Person;
        $person->year = date('Y');
        $person->name = Input::get('name');
        $person->date = date('Y-m-d H:i:s');
        $person->items = rtrim(Input::get('items'),',');
        $person->total = Input::get('total');
        $person->is_rookie = Input::get('is_rookie');
        $person->payment_method = Input::get('paymentMethod');
        $person->save();

        $data = array(
            'email' => Input::get('email'),
            'name' => Input::get('name'),
            'person' => $person,
            'items' => Session::get('itemArray')
        );
        Mail::send('emails.confirm', $data, function($message)
        {
            $message->to(Input::get('email'), Input::get('name'));
            $message->from('matt@5inalldesign.com', 'Matt Crandell');
            $message->subject('Thank You For Your Order!');
        });

        return $person;
    }

    /*public function getOrderEmail()
    {
        $person = Person::find(2);
        $vw = View::make('emails.confirm');
        $vw->title = "Confirm Your Order";
        $vw->description = "";
        $vw->active_page = "signup";

        $vw->items = Session::get('itemArray');
        $vw->person = $person;

        return $vw;
    }*/

    public function postConfirm($order_id)
    {
        $person = Person::find($order_id);
        if(!$person)
            return Redirect::to(url('/'), 301);

        $person->is_paid = 1;
        $person->save();

        $vw = View::make('home.post-confirm');
        $vw->title = "Confirm Your Order";
        $vw->description = "";
        $vw->active_page = "signup";

        $vw->items = Session::get('itemArray');
        $vw->person = $person;

        return $vw;
    }

    public function getRookies()
    {
        $vw = View::make('home.rookies');
        $vw->title = "Rookie Requirements";
        $vw->description = "";
        $vw->active_page = "rookies";
        return $vw;
    }

	protected function sizeTranslator($size)
	{
		switch ($size)
		{
			case 's':
		        $sizeName = 'Small';
		        break;
			case 'm':
		        $sizeName = 'Medium';
		        break;
		    case 'l':
		        $sizeName = 'Large';
		        break;
		    case 'l':
		        $sizeName = 'Large';
		        break;
		    default:
        		$sizeName = strtoupper($size);
		}
		return $sizeName;
    }

}
