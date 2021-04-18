<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\BalanceOrder;

class BalanceOrderController extends Controller
{
    public function store(Request $request) {

        // $userId = Auth::user()->id;
        $data = [
            'user_id' => $request->user_id,
            'package_id ' => $request->package_id,
            'phone_number' => $request->phone_number,
            'status' => 'Pending',
        ];
      
        $balance_order = BalanceOrder::create($data);
        return response()->json([
            "message" => "New Order Created"
        ], 201);
    }
}
