<?php

namespace mcriver\Http\Controllers;

use Illuminate\Http\Request;
use mcriver\Http\Requests;
use mcriver\Http\Controllers\Controller;
use mcriver\Category;
use mcriver\Item;
use mcriver\Order;
use mcriver\Rookie;
use mcriver\User;
use \stdClass;
use \Auth;
use Mail;

class HomeController extends Controller
{
    public function getIndex()
    {
        $view = view('home.index');
        $view->title = "McRiver Raid 2016";
        $view->description = "";
        $view->active_page = "home";
        return $view;
    }

    public function getSignUp(Request $request, $step = null)
    {
        if (!$step) {
            return $this->signupStep1();
        } elseif ($step == 2) {
            return $this->signupStep2($request);
        } elseif ($step == 3) {
            return $this->signupStep3($request);
        } elseif ($step == 4) {
            return $this->signupStep4($request);
        } else {
            return redirect('/sign-up');
        }
    }

    public function postSignUp(Request $request, $step = null)
    {
        if (!$step) {
            return $this->postSignupStep1($request);
        } elseif ($step == 2) {
            return $this->signupStep2();
        } elseif ($step == 3) {
            return $this->postSignupStep3($request);
        } elseif ($step == 4) {
            return $this->signupStep4();
        } else {
            return redirect('/sign-up');
        }
    }

    protected function signupStep1($step = null)
    {
        $view = view('home.sign-up');
        $view->title = "McRiver Raid 2016";
        $view->description = "";
        $view->active_page = "sign-up";
        $categories = Category::orderBy('display_order')->get();
        foreach ($categories as $category) {
            $category->items = $category->items()->where('parent_id',0)->orderBy('display_order')->get();
            foreach ($category->items as $item) {
                $item->children = $item->children()->orderBy('display_order')->get();
            }
        }
        $view->categories = $categories;
        $view->active_page = "signup";
        return $view;
    }

    protected function postsignupStep1(Request $request)
    {

        $validator = $this->validate(
            $request,
            [
                'agreement' => 'required'
            ],
            [
                'agreement.required' => 'Please check the checkbox to agree.'
            ]
        );

        $order = new stdClass;
        $categories = Category::orderBy('display_order')->get();
        //$order->items = new stdClass;
        $order_item = 0;
        foreach ($categories as $category) {
            $category->items = $category->items()->where('parent_id',0)->orderBy('display_order')->get();
            foreach ($category->items as $item) {

                if ($request->get($item->slug) > 0)
                {
                    if ($item->is_one_size) {
                        for ($i = 1; $i <= $request->get($item->slug); $i++) {
                            $order->items[$order_item] = new stdClass;
                            $order->items[$order_item]->item_id = $item->id;
                            $order->items[$order_item]->name = $item->name;
                            $order->items[$order_item]->price = $item->price;
                            $order_item++;
                        }
                    } else {
                        $quantity = 0;
                        for ($i = 1; $i <= $request->get($item->slug); $i++) {
                            $child_item = Item::slug($request->get($item->slug.$i))->first();
                            $order->items[$order_item] = new stdClass;
                            $order->items[$order_item]->item_id = $child_item->id;
                            $order->items[$order_item]->name = $child_item->name;
                            $order->items[$order_item]->price = $child_item->price;
                            $order_item++;
                        }
                    }
                }
            }
        }
        $order->people = $request->people_quantity;
        $order->total = $request->total;

        $request->session()->put('order', $order);

        return redirect('/sign-up/2');
    }

    protected function signupStep2(Request $request)
    {
        if (Auth::check() || $request->session()->has('guest')) {
            return redirect('/sign-up/3');
        }
        $view = view('home.sign-up2');
        $view->title = "McRiver Raid 2016";
        $view->description = "";
        $view->active_page = "sign-up";
        $view->order = $request->session()->get('order');
        $view->active_page = "signup";
        return $view;
    }

    protected function signupStep3(Request $request)
    {
        if (!$request->session()->has('order') && (!Auth::check() || !$request->session()->has('guest'))) {
            return redirect('/sign-up');
        }
        /*if (\Auth::check()) {
            return redirect('/sign-up/3');
        }*/

        if (Auth::check()) {
            $person1 = Auth::user()->name;
        } else {
            $person1 = $request->session()->get('guest');
        }

        $view = view('home.sign-up3');
        $view->title = "McRiver Raid 2016";
        $view->description = "";
        $view->active_page = "sign-up";
        $view->order = $request->session()->get('order');
        $view->person1 = $person1;
        $view->active_page = "signup";
        return $view;
    }

    protected function postsignupStep3(Request $request)
    {
        $order = $request->session()->get('order');

        for ($i = 1; $i <= $order->people; $i++) {
            $validator = $this->validate(
                $request,
                [
                    'person'.$i => 'required'
                ],
                [
                    'person'.$i.'.required' => 'Please enter a name for Person #'.$i
                ]
            );
        }

        $validator = $this->validate(
            $request,
            [
                'phone' => 'required',
                'email' => 'required'
            ],
            [
                'phone.required' => 'Please enter a phone number.',
                'email.required' => 'Please enter an email address.'
            ]
        );

        if(Auth::check())
        {
            $user = Auth::user();
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->save();
        }

        $error = '';
        $success = '';

        if ($request->payment_method == 'credit card') {

            $validator = $this->validate(
                $request,
                [
                    'card_holder_name' => 'required',
                    'card_number' => 'required'
                ],
                [
                    'card_holder_name.required' => 'Please enter the name on your credit card.',
                    'card_number.required' => 'Please enter your card number.'
                ]
            );

            try {
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                $myCard = \Stripe\Token::create(array("card" => array('number' => $request->card_number, 'exp_month' => $request->expiry_month, 'exp_year' => $request->expiry_year, 'name' => $request->card_holder_name, 'cvc' => $request->cvc)));
                $charge = \Stripe\Charge::create(array('card' => $myCard, 'amount' => $order->total.'00', 'currency' => 'usd', 'receipt_email' => $request->email));
                //echo $charge;
                $success = 1;
                //$paymentProcessor="Credit card (www.stripe.com)";
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network problem, perhaps try again.
                $error = $e->getMessage();
            } catch (\Stripe\Error\InvalidRequest $e) {
                // You screwed up in your programming. Shouldn't happen!
                $error = $e->getMessage();
            } catch (\Stripe\Error\Api $e) {
                // Stripe's servers are down!
                $error = $e->getMessage();
            } catch (\Stripe\Error\Card $e) {
                // Card was declined.
                $error = $e->getMessage();
            }
        } else {
             $success = 1;
        }

        if ($success != 1) {
            return redirect('/sign-up/3')->with('stripe_errors', $error);
        } else {

            $names = '';
            for ($i = 1; $i <= $order->people; $i++) {
                $names .= $request->get('person'.$i).',';
                if ($request->get('is_rookie_person'.$i)) {
                    $rookie = New Rookie;
                    $rookie->name = $request->get('person'.$i);
                    $rookie->year = date('Y');
                    $rookie->save();
                }
            }
            $names = rtrim($names, ',');

            $new_order = New Order;
            $new_order->email = $request->email;
            $new_order->name = $names;
            $new_order->user_id = (isset($user))?$user->id:'';
            $new_order->year = date('Y');
            $new_order->total = $order->total;
            $new_order->payment_method = $request->payment_method;
            $new_order->is_paid = ($request->payment_method == 'credit card')?1:0;
            $new_order->save();

            if(isset($order->items)) {
                foreach ($order->items as $item) {
                    $item_order = \DB::table('item_order')->insertGetId(
                        ['order_id' => $new_order->id, 'item_id' => $item->item_id]
                    );
                }
            }

            $order = Order::with('items')->find($new_order->id);

            $data = array(
                'inputs' => $request->all(),
                'order' => $order
            );

            Mail::send('emails.confirm', $data, function($message) use ($request)
            {
                $message->to($request->get('email'), $request->get('person1'));
                $message->from('matt@crandelldesign.com', 'Matt Crandell');
                $message->subject('Thank You For Your Order!');
            });

            //return redirect('/sign-up/4?order='.$new_order->id)->with('new_order',$new_order);
            $request->session()->forget('order');
            return redirect('/sign-up/4')->with('new_order',$new_order);
        }

    }

    protected function signupStep4(Request $request)
    {
        /*if (\Auth::check()) {
            return redirect('/sign-up/3');
        }*/

        if($request->order)
        {
            $order = Order::with('items')->find($request->order);
        } elseif ($request->session()->has('new_order')) {
            $new_order = $request->session()->get('new_order');
            $order = Order::with('items')->find($new_order->id);
        } else {
            return redirect('/sign-up/4');
        }

        $names = explode(',',$order->name);

        $view = view('home.sign-up4');
        $view->title = "McRiver Raid 2016";
        $view->description = "";
        $view->active_page = "sign-up";
        $view->order = $order;
        $view->names = $names;
        $view->active_page = "signup";
        return $view;
    }

    public function postSignin(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if(\Auth::attempt($credentials)) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('login_errors', 'Email or password are incorrect.');
        }
    }

    public function postCreateAccount(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();

        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if(\Auth::attempt($credentials)) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('register_errors', 'User not registered properly.');
        }
    }

    public function postGuestCheckout(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $name = $request->get('name');

        $request->session()->put('guest', $name);

        return redirect('/sign-up/3');
    }

    public function getNotPermitted()
    {
        $view = view('home.not-permitted');
        $view->title = "McRiver Raid 2016";
        $view->description = "";
        $view->active_page = "home";
        return $view;
    }
}
