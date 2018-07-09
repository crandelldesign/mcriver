<?php

namespace App\Http\Controllers\API;

use App\Item;
use App\Person;
use App\Order;
use App\User;
use App\Mail\OrderConfirm;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return response()->json($request->all());

        $orders = Order::with(['persons' => function ($query) use($request) {
        }]);
        if ($request->input('camping')) {
            $orders = $orders->has('persons');
        }
        $orders = $orders->with(['items' => function ($query) use($request) {
            if ($request->input('camping')) {
                $query->where('slug','camping-people-in-group');
            }
        }]);
        if ($request->input('year')) {
            $orders = $orders->where('year', $request->input('year'));
        }
        $orders = $orders->get();
        foreach ($orders as $order) {
            $order->person_count = count($order->persons);
            $order->item_count = count($order->items);
        }

        return response()->json($orders);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error = '';
        $success = 0;
        
        if ($request->input('order.paymentMethod') == 'credit card') {
            try {
                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

                $charge = \Stripe\Charge::create(array(
                    'source' => $request->input('token'),
                    'amount' => $request->input('order.total').'00',
                    'currency' => 'usd',
                    'receipt_email' => $request->input('order.email')
                ));
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
            return response()->json($error);
        } else {

            $order = New Order;
            $order->email = $request->input('order.email');
            $order->name = $request->input('order.name');
            $order->user_id = $request->input('order.user.id');
            $order->year = date('Y');
            $order->total = $request->input('order.total');
            $order->payment_method = $request->input('order.paymentMethod');
            $order->is_paid = ($request->input('order.paymentMethod') == 'credit card')?1:0;
            $order->phone = $request->input('order.phone');
            //$order->dish_day = ($request->get('dish_day'))?implode(',',$request->get('dish_day')):' ';
            //$order->dish_description = ($request->get('dish_description'))?$request->get('dish_description'):' ';
            // Generate a Friendly Order ID
            while (true) {
                $friendly_order_id = uniqid();
                $orders_check = \DB::table('orders')->where('friendly_order_id',$friendly_order_id)->first();
                if (!$orders_check){
                    $order->friendly_order_id = $friendly_order_id;
                    break;
                }
            }
            $order->save();

            for ($i = 0; $i < count($request->input('order.persons')); $i++) {
                
                $person = New Person;
                $person->name = $request->input('order.persons.'.$i.'.name');
                $person->is_rookie = ($request->input('order.persons.'.$i.'.isRookie'))?1:0;
                $person->year = date('Y');
                $person->order_id = $order->id;
                $person->save();
                
            }

            for ($i = 0; $i < count($request->input('order.items')); $i++) {
                \Log::debug($request->input('order.items.'.$i.'.item'));
                for ($x = 0; $x < $request->input('order.items.'.$i.'.item.quantity'); $x++) {
                    $item_order = \DB::table('item_order')->insertGetId(
                        ['order_id' => $order->id, 'item_id' => $request->input('order.items.'.$i.'.item.id'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                    );
                }
            }

            $camping = $order->items->where('slug','camping-people-in-group')->first();
            if ($camping) {
                foreach ($order->persons as $person) {
                    $person->price = $camping->price;
                }
            }

            $mail = Mail::to($order->email);
            $admins = User::admin()->get();
            foreach ($admins as $admin) {
                $mail->bcc($admin->email);
            }
            $mail->send(new OrderConfirm($order));

            return response()->json($order);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::where('friendly_order_id',$id)->with('items')->with('persons')->first();
        if ($order) {
            $camping = $order->items->where('slug','camping-people-in-group')->first();
            if ($camping) {
                foreach ($order->persons as $person) {
                    $person->price = $camping->price;
                }
            }
        }
        return response()->json($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
