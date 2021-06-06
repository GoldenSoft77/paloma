<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Vendor;
use App\Notification;

class VendorController extends Controller
{

    public function __construct()
     {
        $this->middleware('auth:admin');
    }

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
        $vendor = Vendor::where('id', $id )->first();
        $user_id = $vendor->user_id;
        $user = User::where('id', $user_id )->first();
        $data = [
            'status' => 'active',
            'user_type_id' => '2',
        ]; 
     
        $user->update($data);
        Notification::insert( [
            'notification_message'=>  'Your Vendor request has been accepted',
            'user_id'=> $user->id,
            'status' =>0
        ]);
        return redirect('/admin/vendors')->with('message', 'Vendor Added Successfully');

    }
   
    
}
