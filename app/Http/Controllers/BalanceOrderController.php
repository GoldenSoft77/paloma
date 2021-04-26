<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\BalanceOrder;

class BalanceOrderController extends Controller
{
    public function store(Request $request) {

        $data = [
            // 'user_id' => $request->user_id,
            'package_id ' => auth()->user()->id,
            'phone_number' => $request->phone_number,
            'status' => 'pending',
        ];
      
        $balance_order = BalanceOrder::create($data);

        Stripe\Stripe::setApiKey("sk_test_51IiI5nEg8ppfY3tVlFyNLUslq1OMTOAhd6YEGy0eUK6eplZP6claaBQFf8gWii9RzjipvjiOja0gyshgiVymbfyE00PfH3sJu8");
        $response = \Stripe\Token::create(array(
            "card" => array(
              "number"    => $request->card_number,
              "exp_month" => $request->exp_month,
              "exp_year"  => $request->exp_year,
              "cvc"       => $request->cvc,
              "name"      => auth()->user()->first_name . " " . auth()->user()->last_name
          )));
        
        Stripe\Charge::create ([
                "amount" =>  $request->amount,
                "currency" => "usd",
                "source" => $response,
                "description" => "Balance Order" 
        ]);
        return response()->json([
            "message" => "New Order Created"
        ], 201);
    }
}
