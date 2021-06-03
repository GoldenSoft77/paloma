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
// use Twilio\Rest\Client;
// use Twilio\Jwt\ClientToken;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use App\Mail\VerificationEmail;

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
        'email' => 'required|email',
        'password' => 'required|string',
    ]);
        $token = Str::random(80);
       
        if (User::where('email', '=', $request->email)->exists()) {

            return response()->json(['code'=> 0,"data"=>'The email is already taken'], 401); 
         }
         elseif (User::where('phone_number', '=', $request->phone_number)->exists()) {
            return response()->json(['code'=> 0,"data"=>'The phone number is already taken'], 401); 
         }
         else{
            $name ="";
            if($request->file('profile_img')){
                $file=$request->file('profile_img');
                // $file = $file->store('images/profiles');
                $path = 'images/profiles/';
                $name=$file->getClientOriginalName();
                $name = $path.$name;
                $file->move($path,$name);
              
            }
     
        //  try {
  
        //     $account_sid = "AC87e5aecc3f3b06d93f3c0ff1b6a853e1";
        //     $auth_token = "730da0612a1c1ffecedbedd48467a718";
        //     $twilio_number = "+447401764268";
        //     $receiverNumber ="+963958755323";
        //     $message = "This is testing";

        //     $client = new Client($account_sid, $auth_token);
        //     $client->messages->create($receiverNumber, [
        //         'from' => $twilio_number, 
        //         'body' => $message]);
  
           
  
        // } 
        // catch (Exception $e)
        // {
        //     echo "Error: " . $e->getMessage();
        // }
        

            $user =  User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'date_birth' => $request->date_birth,
                'country' => $request->country,
                'governorate'=> $request->governorate,
                'nationality' => $request->nationality,
                'sex' => $request->sex,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'user_type_id' =>'1',
                'status' => '0',
                'profile_img' => $name,
                'password' =>bcrypt($request->password),
                'api_token' => hash('sha256', $token),
                'email_verification_token' => Str::random(6)
               
            ]);
       $success['token'] =  $token; 
       $success['user'] = $user;
       \Mail::to($user->email)->send(new VerificationEmail($user));
       // Auth::login($user);
          return response()->json(['code'=> 1,"data"=>'Email Verification has sent'], 200); 

       }

    }
        

  
}
