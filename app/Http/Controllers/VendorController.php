<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class VendorController extends Controller
{

    //Show all Vendors
    public function index()
    {
        $vendors = User::where('user_type_id', 2 )->get();
        return view('vendors.vendors',compact('vendors'));
    }
    //Show all Pending Vendors
    public function pending()
    {
        $pending_vendors = User::where('status', 'pending' )->get();
        return view('vendors.pending_vendors',compact('pending_vendors'));
    }
    //User request to be vendor account
    public function vendor_request(Request $request) {

        $userId = Auth::user()->id;
        $user = User::where('id', $userId )->first();
        $data = [
            'status' => 'pending',
        ];
      
        $user->update($data);
        return response()->json([
            "message" => "Vendor Request Created"
        ], 201);
    }
    //Admin approve request user to be vendor account
    public function approve_vendor(Request $request,$id) {

        $user = User::where('id', $id )->first();
        $data = [
            'status' => 'active',
            'user_type_id' => '2',
        ];
      
        $user->update($data);
        return response()->json([
            "message" => "Vendor Request Created"
        ], 201);
    }
}
