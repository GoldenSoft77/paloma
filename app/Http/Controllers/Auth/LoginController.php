<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['register', 'login']);
    }


    public function login(Request $request){ 
      
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            if($user->email_verified == 1){
            $success['token'] =  $user->api_token; 
            $success['user'] = $user;
            return response()->json(['code' => 1,"data"=>$success], 200); 
            } 
            else{
                return response()->json(['code' => 0,"data"=>"Not Verified"], 401); 
            }
        }
        else{ 
            return response()->json(['code'=> 0,"data"=>'Unauthorized'], 401); 
        } 
    
    }
   
    // public function logout()
    // {   $user = Auth::user(); 
    //      Auth::logout($user);
    //     return response()->json(['success' => 'Successfully logged out']);
    // }

}
