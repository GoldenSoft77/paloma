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


  

}
