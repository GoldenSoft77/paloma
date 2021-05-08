<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Vendor;
class VendorController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }
    //Show all Vendors
    public function index()
    {
        $users = User::where('user_type_id', 2 )->get();
        $ids =[];
    foreach($users as $user){
        array_push($ids,$user);
        }
    $user_ids = array_column($ids, 'id');
        // $id = $user->id;
        $vendors = Vendor::whereIn('user_id',$user_ids )->get();

        return view('vendors.vendors',compact('vendors'));
    }
    //Show all Pending Vendors
    public function pending()
    {
        $users = User::where('status', 'vendor_pending' )->get();
        $ids =[];
    foreach($users as $user){
        array_push($ids,$user);
        }
    $user_ids = array_column($ids, 'id');
        // $id = $user->id;
        $pending_vendors = Vendor::whereIn('user_id',$user_ids )->get();

        return view('vendors.pending_vendors',compact('pending_vendors'));
    }


    //Admin approve request user to be vendor account
    public function approve_vendor(Request $request,$id) {

        $user = User::where('id', $id )->first();
        $data = [
            'status' => 'active',
            'user_type_id' => '2',
        ]; 
     
        $user->update($data);
        return redirect('/admin/vendors')->with('message', 'Vendor Added Successfully');

    }

    //API

    //User request to be vendor account
    public function vendor_request(Request $request) {

        $token = $request->api_token;
        $user = User::where('api_token',$token)->where('user_type_id',1)->first();
       

        $data = [
            'status' => 'vendor_pending',
        ];
        Vendor::insert( [
            'user_id'=> $user->id,
            'shop_name'=>  $request->shop_name,
            'shop_phone_number'=> $request->shop_phone_number,
            'shop_address'=> $request->shop_address
        ]);
      
        $user->update($data);
        return response()->json([
            "message" => "Vendor Request Created"
        ], 201);
    }

    
}
