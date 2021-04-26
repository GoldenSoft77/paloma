<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

  

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        $request->validate([
        'first_name'=> 'required|string',
        'last_name'=> 'required|string',
        'date_birth'=> 'required',
        'country'=> 'required',
        'nationality'=> 'required',
        'sex'=> 'required',
        'phone_number'=> 'required',
        'user_type_id'=> 'required',
        'status'=> 'required',
        'email' => 'required|email',
        'password' => 'required|string',
    ]);
        $token = Str::random(80);
       
        if (User::where('email', '=', $request->email)->exists()) {

            return response()->json(['code'=> 0,"data"=>'The email is already taken'], 401); 
         }
         else{
            $user =  User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'date_birth' => $request->date_birth,
                'country' => $request->country,
                'nationality' => $request->nationality,
                'sex' => $request->sex,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'user_type_id' =>$request->user_type_id,
                'status' => $request->status,
                'password' =>bcrypt($request->password),
                'api_token' => hash('sha256', $token),
               
            ]);
        $success['token'] =  $token; 
        $success['user'] = $user;
        Auth::login($user);
        return response()->json(['code' => 1,"data"=>$success], 200);

       }

    }

  
}
