<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\BalanceOrder;
use App\BalancePackage;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Token;
use App\User;


class BalanceOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function finish_orders()
    {
      $balanceorders = BalanceOrder::where('status','done')->get();
      return view('balance_orders.finished_orders',compact('balanceorders'));
    }
  
  
    //Show all MTN Pending Orders
  public function pending_mtn()
  {
    $balancepackages = BalancePackage::where('company','MTN')->get(); 
    $ids =[];
    foreach($balancepackages as $balancepackage){
        array_push($ids,$balancepackage);
        }
    $package_ids = array_column($ids, 'id');
    $balanceorders = BalanceOrder::whereIn('package_id', $package_ids)->where('status','pending')->get();
    return view('balance_orders.pending_mtn_orders',compact('balanceorders'));
  }

    //Show all Syriatel Pending Orders
    public function pending_syriatel()
    {
      $balancepackages = BalancePackage::where('company','Syriatel')->get(); 
      $ids =[];
      foreach($balancepackages as $balancepackage){
          array_push($ids,$balancepackage);
          }
      $package_ids = array_column($ids, 'id');
      $balanceorders = BalanceOrder::whereIn('package_id', $package_ids)->where('status','pending')->get();
      return view('balance_orders.pending_syriatel_orders',compact('balanceorders'));
    }
  

    //Admin approve request charge balance
    public function charge_balance(Request $request,$id) {

        $balanceorders = BalanceOrder::where('id',$id)->first();

        $data = [
            'status' => 'done',
        ];
      
        $balanceorders->update($data);
        return redirect('/admin/balanceorders')->with('message', 'Balance Charged Successfully');

    }


    //API
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
                  'package_id' => $request->package_id,
                  'phone_number' => $request->phone_number,
                   'status' => 'pending',
                            ];
                          
                 $balance_order = BalanceOrder::create($data);
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
