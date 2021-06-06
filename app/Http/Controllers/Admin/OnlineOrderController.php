<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OnlineOrder;
use App\OnlineOrderDetails;
use App\Notification;

class OnlineOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

     //Show all online Orders
     public function index()
     {
         $orders = OnlineOrder::where('status', 'Done')->get();
         return view('online_store.finished_orders',compact('orders'));
     }

     //Show all Pending Orders
     public function pending()
     {
         $pending_orders = OnlineOrder::where('status', 'New')->orWhere('status', 'Awaiting payment')->orWhere('status', 'Encapsulation')->orWhere('status', 'Shipping')->get();
         return view('online_store.pending_orders',compact('pending_orders'));
     }

    //Edit a specific order 
    public function edit($id)
    {
        $order = OnlineOrder::where('id',$id)->first();
        $order_details = OnlineOrderDetails::where('order_id',$id)->get();
        return view('online_store.add_shipping', compact('order','order_details'));
    }
     //Add Shipping Cost
    public function add_shipping_cost(Request $request,$id) {

        $order = OnlineOrder::where('id',$id)->first();
        $amount = $request->amount;
        $shipping = $request->shipping;
        $total_amount = $amount + $shipping;

        $data = [
             'amount' =>  $total_amount,
             'status' =>  'Awaiting payment'
        ];
        
        $order->update($data);
        Notification::insert( [
            'notification_message'=>  'Shipping cost'.' '.$shipping.' '.'has been added Successfully to your order number'.' '. $order->id,
            'user_id'=> $order->user_id,
            'status' => 0
        ]);
        return redirect('/admin/pending_orders')->with('message','The shipping cost has been Added successfully');

    }

     //change status view
     public function change($id)
     {
         $order = OnlineOrder::where('id',$id)->first();
         $order_details = OnlineOrderDetails::where('order_id',$id)->get();
         return view('online_store.change_status', compact('order','order_details'));
     }

      //change status for online order
      public function change_status(Request $request,$id)
      {
          $order = OnlineOrder::where('id',$id)->first();
          $data = [
            'status' =>  $request->status
       ];
       $order->update($data);
       Notification::insert( [
        'notification_message'=>  'Your Order number'.' '.$order->id.' '.'status is'.' '.$order->status,
        'user_id'=> $order->user_id,
        'status' => 0
         ]);
       return redirect('/admin/pending_orders')->with('message','The order status has been Added successfully');
      }

}