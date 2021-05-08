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

    public function charge(Request $request)
    {
       
        $user = User::where('api_token', $request->api_token)->first();
      
        try {
            Stripe::setApiKey("sk_test_51IiI5nEg8ppfY3tVlFyNLUslq1OMTOAhd6YEGy0eUK6eplZP6claaBQFf8gWii9RzjipvjiOja0gyshgiVymbfyE00PfH3sJu8");
        
            $token = Token::create([
                        'card' => [
                              'number'    => $request->card_number,
                               'exp_month' =>$request->exp_month,
                               'exp_year'  => $request->exp_year,
                                'cvc'       => $request->cvc,
                           ]
                        ]);
           
            $customer = Customer::create(array(
                'email' => $user->email,
                'source' => $token->id
            ));

        
            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => $request->amount,
                'currency' => 'usd'
            ));
           
            $status_msg= $charge->status;
             
              if($status_msg == "succeeded"){
                $status_msg ="Authorised";
                $status_code = "A";
                $data = [
                 'user_id' => $user->id,
                 'type' => $request->type,
                 'name' => $request->name,
                 'city' => $request->city,
                 'amount' => $request->amount,
                 'number' => $request->number,
                 'counter_number' => $request->counter_number,
                 'status' => 'pending'
            
                            ];
                          
                 $bill_order = BillOrder::create($data);
                 return response()->json(['code' => 1,"data"=>"Your order is submit successfully"], 200);
            }else{
                $status_code = "D";
                return response()->json(['code' => 0,"data"=>"Your order is Failed"], 401);
            }
        
          
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

}
