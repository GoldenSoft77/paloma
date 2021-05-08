<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class VerifyController extends Controller
{
    public function VerifyEmail(Request $request)
    {

        $code = $request->code;
    	if($code == null) {

            return response()->json(['code' => 0,"data"=>  "Verification failed"], 401);

    	}
        else{

       $user = User::where('email_verification_token',$code)->first();

     

       $user->update([
        'status' => 1,
        'email_verified' => 1,
        'email_verified_at' => Carbon::now(),
        'email_verification_token' => ''

       ]);
       
       return response()->json(['code' => 1,"data"=>  "Your account is verified"], 200);
       }
    }
}
