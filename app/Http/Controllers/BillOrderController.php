<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillOrder;

class BillOrderController extends Controller
{
    public function store(Request $request) {

        $bill_order = new BillOrder;
        $bill_order->type = $request->type;
        $bill_order->amount = $request->amount;
        $bill_order->name = $request->name;
        $bill_order->city = $request->city;
        $bill_order->number = $request->number;
        $bill_order->status = $request->status;
        $bill_order->user_id = auth('api')->user()->id;
        $bill_order->save();
        // // $userId = Auth::user()->id;
        // $data = [
        //     'type' => $request->type,
        //     'amount ' => $request->amount,
        //     'name' => $request->name,
        //     'city' => $request->city,
        //     'number ' => $request->number,
        //     'status' => $request->status,
        //     'user_id' => $request->user_id,
       
        // ];
      
        // $bill_order = BillOrder::create($data);
        return response()->json([
            "message" => "New Order Created"
        ], 201);
    }
}
