<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Newsticker;
use App\BalanceOrder;
use App\BalancePackage;
use App\BillOrder;
use App\User;
use App\Product;
use App\ProductSection;
use App\ProductImage;
use App\Socailmedia;
use App\Slider;
use App\Vendor;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Token;


class ApiController extends Controller
{

     //API For Balance Packages
     public function showBalancePackage(Request $request){
      
        $balance_package = BalancePackage::where('company',$request->company)->get();
        $success['balance_package'] = $balance_package;
        return response()->json(['code' => 1,"data"=>$success], 200);
    }

    //Charge Balance Order
    public function charge_balance(Request $request)
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


     //Charge Bill Order
    public function charge_bill(Request $request)
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


     //Show All newsticker for Api
     public function show_newsticker(){
        $bars = Newsticker::all();
        return response()->json($bars);
    }

     //Show All sliders
     public function show_slider(){
        $slides = Slider::all();
        return response()->json($slides);
    }

     //Show All social media
     public function show_socialmedia(){
        $socailmedia = Socailmedia::first();
        return response()->json($socailmedia);
    }

     //User request to be vendor account
     public function vendor_request(Request $request) {

        $token = $request->api_token;
        $user = User::where('api_token',$token)->first();
       

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

      //show all welcome
      public function show_welcome(){
        $welcome = Welcome::all();
        return response()->json($welcome);
    }

    //Products section
    public function add_product(Request $request)
    {

        $token = $request->api_token;
        $user = User::where('api_token',$token)->where('user_type_id',2)->first();
        $user_id = $user->id;
        $vendor = Vendor::where('user_id',$user_id)->first();
        // Product Main Image
        if($request->file('main_img')){
            $main_file = $request->file('main_img');
            $path = 'images/products/';
            $main_name = $main_file->getClientOriginalName();
            $main_name = $path.$main_name;
            $main_file -> move($path,$main_name);
        
        }

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'count' => $request->count,
            'status' => 'pending',
            'main_img' => $main_name,
            'section_id' => $request->section_id,
            'vendor_id' => $vendor->id
        ];

      
        $product = Product::create($data);
          // Product Secondary Images
        if($request->file('images')){
            $files = $request->file('images');
            foreach($files as $file){
                $path = 'images/products/';
                $name=$file->getClientOriginalName();
                $name = $path.$name;
                $file->move($path,$name);
                ProductImage::insert( [
                    'img'=>  $name,
                    'product_id'=> $product->id
                ]);
                $images[]=$name;
            }
        }
    
 
        return response()->json([
            "message" => "New Product Created"
        ], 201);

    }

    //Show Products for specific vendor
    public function my_products(Request $request){
        $token = $request->api_token;
        $user = User::where('api_token',$token)->where('user_type_id',2)->first();
        $user_id = $user->id;
        $vendor = Vendor::where('user_id',$user_id)->first();
        $vendor_id = $vendor->id;
        $products = Product::where('vendor_id',$vendor_id)->get();
        return response()->json($products);
    }

     //Show All Products 
     public function all_products(Request $request){
        $products = Product::where('status','active')->get();
        return response()->json($products);
    }

     //Show All Products sections
     public function product_sections(Request $request){
        $product_sections = ProductSection::all();
        return response()->json($product_sections);
    }

   


     //Delete Product
     public function delete_product(Request $request){
        $token = $request->api_token;
        $user = User::where('api_token',$token)->where('user_type_id',2)->first();
        $product_id =  $request->product_id;
        $product = Product::where('id',$product_id)->first();
        $data = [
            'status' => 'deleted_pending',
        ];
        $product->update($data);
        return response()->json([
            "message" => "Delete Request Created"
        ], 201);
        
    }

}