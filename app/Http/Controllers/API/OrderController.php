<?php

namespace App\Http\Controllers\API;

use App\Item;
use App\Person;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $order->name = $request->input('order.persons.0.name');
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
                /*$names .= $request->get('person'.$i).',';
                if ($request->get('is_rookie_person'.$i)) {

                }*/
            }

            for ($i = 0; $i < count($request->input('order.items')); $i++) {
                \Log::debug($request->input('order.items.'.$i.'.item'));
                for ($x = 0; $x < $request->input('order.items.'.$i.'.item.quantity'); $x++) {
                    $item_order = \DB::table('item_order')->insertGetId(
                        ['order_id' => $order->id, 'item_id' => $request->input('order.items.'.$i.'.item.id'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                    );
                }
            }

            $order = Order::with('items')->find($order->id);

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
        //
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