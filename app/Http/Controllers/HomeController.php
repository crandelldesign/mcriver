<?php

namespace mcriver\Http\Controllers;

use Illuminate\Http\Request;
use mcriver\Http\Requests;
use mcriver\Http\Controllers\Controller;
use mcriver\Category;
use mcriver\Item;
use \stdClass;
use \Auth;

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
            return $this->signupStep2();
        } elseif ($step == 3) {
            return $this->signupStep3($request);
        } elseif ($step == 4) {
            return $this->signupStep4();
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
            return $this->signupStep3();
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
        return $view;
    }

    protected function postsignupStep1(Request $request)
    {
        //print_r($request->all());

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

    protected function signupStep2()
    {
        if (Auth::check()) {
            return redirect('/sign-up/3');
        }
        $view = view('home.sign-up2');
        $view->title = "McRiver Raid 2016";
        $view->description = "";
        $view->active_page = "sign-up";
        return $view;
    }

    protected function signupStep3(Request $request)
    {
        if (!$request->session()->has('order')) {
            return redirect('/sign-up');
        }
        /*if (\Auth::check()) {
            return redirect('/sign-up/3');
        }*/
        $view = view('home.sign-up3');
        $view->title = "McRiver Raid 2016";
        $view->description = "";
        $view->active_page = "sign-up";
        $view->order = $request->session()->get('order');
        return $view;
    }

    protected function signupStep4()
    {
        /*if (\Auth::check()) {
            return redirect('/sign-up/3');
        }*/
        $view = view('home.sign-up4');
        $view->title = "McRiver Raid 2016";
        $view->description = "";
        $view->active_page = "sign-up";
        return $view;
    }

    public function postSignin(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if(\Auth::attempt($credentials)) {
            //$user = \Auth::user();
            //$user->password = bcrypt($request->get('password'));
            //$user->save();
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('Incorrect old password.')->with('message', 'Password changed successfully.');
        }
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
