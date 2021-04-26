<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('stripe');
    }

     public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey("sk_test_51IiI5nEg8ppfY3tVlFyNLUslq1OMTOAhd6YEGy0eUK6eplZP6claaBQFf8gWii9RzjipvjiOja0gyshgiVymbfyE00PfH3sJu8");
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment" 
        ]);
  
        Session::flash('success', 'Payment successful!');
          
        return back();
    }
}

