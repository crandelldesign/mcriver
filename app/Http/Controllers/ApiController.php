<?php

namespace mcriver\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;

use mcriver\Http\Requests;
use mcriver\Http\Controllers\Controller;
use mcriver\Category;
use mcriver\Item;
use mcriver\Order;

class ApiController extends Controller
{
    public function getCategories($category_id = null)
    {
        if (!$category_id) {
            return Category::orderBy('display_order')->get();
        } else {
            return Category::find($category_id);
        }
    }

    public function getItems($category_id, $item_id = null)
    {
        if (!$item_id) {
            return Item::where('category_id',$category_id)->orderBy('display_order')->get();
        } else {
            return Item::find($item_id);
        }
    }

    public function getOrder($order_id)
    {
        $order = Order::with('items')->with('persons')->find($order_id);
        return \Response::json($order);
    }

    public function postResetPassword(Request $request, PasswordBroker $passwords)
    {
        if( $request->ajax() )
        {
            $this->validate($request, ['email' => 'required|email']);

            $response = Password::sendResetLink(['email'=>$request->only('email')], function($message) {
                $message->subject('Your Password Reset Link');
            });

            switch ($response)
            {
                case PasswordBroker::RESET_LINK_SENT:
                    return[
                       'error' => false,
                       'message' => 'A password link has been sent to your email address'
                    ];

                case PasswordBroker::INVALID_USER:
                    return[
                       'error' => true,
                       'message' => 'We can\'t find a user with that email address'
                    ];
            }
        }
        return false;
    }
}
