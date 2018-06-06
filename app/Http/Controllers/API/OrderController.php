<?php

namespace App\Http\Controllers\API;

use App\Order;
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
        try {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            //$myCard = \Stripe\Token::create(array("card" => array('number' => $request->card_number, 'exp_month' => $request->expiry_month, 'exp_year' => $request->expiry_year, 'name' => $request->card_holder_name, 'cvc' => $request->cvc)));

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

        if ($success != 1) {
            return response()->json($error);
        } else {
            return response()->json('hi');
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
