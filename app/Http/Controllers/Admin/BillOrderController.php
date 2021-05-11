<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\BillOrder;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Token;
use App\User;

class BillOrderController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function finish_orders()
    {
      $billorders = BillOrder::where('status','done')->get();
      return view('bill_orders.finished_orders',compact('billorders'));
    }

    public function pending_electricity()
    {
      $billorders = BillOrder::where('status','pending')->where('type','electricity')->get();
      return view('bill_orders.pending_electricity_orders',compact('billorders'));
    }

    public function pending_water()
    {
      $billorders = BillOrder::where('status','pending')->where('type','water')->get();
      return view('bill_orders.pending_water_orders',compact('billorders'));
    }

    public function pending_phone()
    {
      $billorders = BillOrder::where('status','pending')->where('type','phone')->get();
      return view('bill_orders.pending_phone_orders',compact('billorders'));
    }
     //Admin approve request bill
    public function approve_bill(Request $request,$id) {

        $billorders = BillOrder::where('id',$id)->first();

        $data = [
            'status' => 'done',
        ];
      
        $billorders->update($data);
        return redirect('/admin/billorders')->with('message', 'Bill Charged Successfully');

    }

   
}
