<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InternationalOrder;
use App\InternationalOrderDetails;

class InternationalOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

     //Show all international_store Orders
     public function index()
     {
         $orders = InternationalOrder::where('status', 'Done')->get();
         return view('international_store.finished_orders',compact('orders'));
     }

     //Show all Pending Orders
     public function pending()
     {
         $pending_orders = InternationalOrder::where('status', 'New')->orWhere('status', 'Awaiting payment')->orWhere('status', 'Encapsulation')->orWhere('status', 'Shipping')->get();
         return view('international_store.pending_orders',compact('pending_orders'));
     }

    //Edit a specific order 
    public function edit($id)
    {
        $order = InternationalOrder::where('id',$id)->first();
        $order_details = InternationalOrderDetails::where('order_id',$id)->get();
        return view('international_store.add_shipping', compact('order','order_details'));
    }
     //Add Shipping Cost
    public function add_shipping_cost(Request $request,$id) {

        $order = InternationalOrder::where('id',$id)->first();
        $amount = $request->amount;
        $shipping = $request->shipping;
        $total_amount = $amount + $shipping;

        $data = [
             'amount' =>  $total_amount,
             'status' =>  'Awaiting payment'
        ];
        
        $order->update($data);
        return redirect('/admin/inter_pending_orders')->with('message','The shipping cost has been Added successfully');

    }

     //change status view
     public function change($id)
     {
         $order = InternationalOrder::where('id',$id)->first();
         $order_details = InternationalOrderDetails::where('order_id',$id)->get();
         return view('international_store.change_status', compact('order','order_details'));
     }

      //change status for international order
      public function change_status(Request $request,$id)
      {
          $order = InternationalOrder::where('id',$id)->first();
          $data = [
            'status' =>  $request->status
       ];
       $order->update($data);
       return redirect('/admin/inter_pending_orders')->with('message','The order status has been Added successfully');
      }

}