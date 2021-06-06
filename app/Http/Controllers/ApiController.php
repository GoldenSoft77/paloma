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
use App\FavoriteProduct;
use App\ProductImage;
use App\Socailmedia;
use App\Slider;
use App\OnlineOrder;
use App\OnlineOrderDetails;
use App\InternationalOrder;
use App\InternationalOrderDetails;
use App\Vendor;
use App\Welcome;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Token;
use App\ApiRequest;
use App\Notification;
use DB;


class ApiController extends Controller
{

     //API For Balance Packages
     public function showBalancePackage(Request $request){
      
        $balance_package = BalancePackage::where('company',$request->company)->get();
        $success['balance_package'] = $balance_package;
        return response()->json(['code' => 1,"data"=>$success], 200);
    }
    //Show all Balance Pending Orders
    public function pending_balance_orders(Request $request)
    {
        $user = User::where('api_token', $request->api_token)->first();

        $pending_balance_orders = BalanceOrder::where('status', 'pending')->where('user_id',$user->id)->get();
        return response()->json($pending_balance_orders);
    }

    //Show all Balance Done Orders
    public function done_balance_orders(Request $request)
    {        
        $user = User::where('api_token', $request->api_token)->first();

        $balance_orders = BalanceOrder::where('status', 'done')->where('user_id',$user->id)->get();
        return response()->json($balance_orders);
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

    //Show all Bill Pending Orders
    public function pending_bill_orders(Request $request)
    {
        $user = User::where('api_token', $request->api_token)->first();

        $pending_bill_orders = BillOrder::where('status', 'pending')->where('user_id',$user->id)->get();
        return response()->json($pending_bill_orders);
    }

    //Show all Bill Done Orders
    public function done_bill_orders(Request $request)
    {      
        $user = User::where('api_token', $request->api_token)->first();

        $bill_orders = BillOrder::where('status', 'done')->where('user_id',$user->id)->get();
        return response()->json($bill_orders);
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
     //Show All Api requests
     public function api_requests(){
        $api_requests = ApiRequest::all();
        return response()->json($api_requests);
    }

    //Show All Notifications
     public function show_notification(Request $request){
        $user = User::where('api_token', $request->api_token)->first();
         $notification = Notification::where('user_id',$user->id)->get();
         return response()->json($notification);
     }
     //Change notification status
     public function edit_notification(Request $request){
         $user = User::where('api_token', $request->api_token)->first();
         $notification = Notification::where('id', $request->notification_id)->where('user_id',$user->id)->first();
         $data = [
            'status' => 1
        ];
        $notification->update($data);
        return response()->json([
            "message" => 'Notification #'.' '. $notification->id.' '.'Done'
        ], 201);
      
         
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
        $user = User::where('api_token',$token)->first();
        if($user->user_type_id	== 2){
        $user_id = $user->id;
        $vendor = Vendor::where('user_id',$user_id)->first();
        // Product Main Image
        if($request->file('main_img')){
            $main_file = $request->file('main_img');
            $path = 'images/products/';
            $main_name = $main_file->getClientOriginalName();
            $main_name = $path.time().$main_name;
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
                $name = $path.time().$name;
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
    else{
        return response()->json([
            "message" => "You can not add product"
        ], 401);
    }

    }

    //Show Products for specific vendor
    public function my_products(Request $request){
        $token = $request->api_token;
        $user = User::where('api_token',$token)->where('user_type_id',2)->first();
        $user_id = $user->id;
        $vendor = Vendor::where('user_id',$user_id)->first();
        $vendor_id = $vendor->id;
        $products = Product::where('status','active')->where('vendor_id', $vendor_id)->with('vendor')->get();

        $products->map(function ($item, $key) {
            
        $product_images = ProductImage::where('product_id', $item->id)->get();
        $images = [];
             foreach ($product_images as $image) {
                 array_push($images,$image->img);
            }
            $item->setAttribute('secondary_images', $images);
             return $item;
         });
         return response()->json($products);
         
    }

     //Show All Products 
     public function all_products(Request $request){
        
        $products = Product::where('status','active')->with('vendor')->get();
        $user = User::where('api_token',$request->api_token)->first();
        foreach ($products as $product) {
         
            if(FavoriteProduct::where('user_id', '=', $user->id)->where('product_id','=',$product->id)->exists()){
                $product->setAttribute('Favorite', 'true');
               }
               else{
                $product->setAttribute('Favorite', 'False');
               }
            }
         
         
    
        $products->map(function ($item, $key) {
          $product_images = ProductImage::where('product_id', $item->id)->get();
          $images = [];
             foreach ($product_images as $image) {
                 array_push($images,$image->img);
            }
            $item->setAttribute('secondary_images', $images);
             return $item;

             
         });
        
        
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
        //Add Product to Favorite
    public function add_favorite_product(Request $request)
    {
        $user = User::where('api_token', $request->api_token)->first();
        $product = Product::where('id',$request->product_id)->first();
        $user_id = $user->id;
        if(FavoriteProduct::where('user_id', '=', $user_id)->where('product_id','=',$request->product_id)->exists()){
         return response()->json(['code' =>0,"data"=>'You already added product'.' '.$product->name.' '. 'to your favorite'], 401);

        }
        else{
      
        $data = [
            'product_id' => $product->id,
            'user_id' => $user_id
        ];
        $favorite = FavoriteProduct::create($data);
        return response()->json(['code' => 1,"data"=>'Product'.' '.$product->name.' '.'is added successfully to favorite'], 200);
       }
    }

        //Add Product to Favorite
        public function remove_favorite_product(Request $request)
        {
            $user = User::where('api_token', $request->api_token)->first();
            $product = Product::where('id',$request->product_id)->first();
            $user_id = $user->id;
         
            if(FavoriteProduct::where('user_id', '=', $user_id)->where('product_id','=',$request->product_id)->exists()){
             $product = FavoriteProduct::where('user_id', '=', $user_id)->where('product_id','=',$request->product_id)->delete();
          
             return response()->json(['code' => 1 ,"data"=>'You remove a product from your favorite'], 200);
    
            }
          
            
           
        }
        //Show all Favorite products for specific user
    public function my_favorite(Request $request)
    {

        
        $user = User::where('api_token', $request->api_token)->first();
        $favorite_products = FavoriteProduct::where('user_id',$user->id)->get();

        $favorite_products->map(function ($item, $key) {
            
          $favorites = Product::where('id', $item->product_id)->get();
          $products = [];
             foreach ($favorites as $favorite) {
                 array_push($products,$favorite);
            }
            $item->setAttribute('product', $products);
             return $item;
         });

       
        return response()->json($favorite_products);
    }
//online store

    //Online Store Request order
    public function online_order_request(Request $request)
    {
        $user = User::where('api_token', $request->api_token)->first();
        $data = [
              'user_id' => $user->id,
              'status' => 'New',
              'amount' =>$request->amount
        ];
                     
           $online_request = OnlineOrder::create($data);
           $order_id =  $online_request->id;
           $products = json_encode($request->products);
           $products = json_decode($products);
            foreach($products as $product){

                OnlineOrderDetails::insert( [
                    'order_id' =>  $order_id,
                      'product_id' => $product->id,
                      'price' =>$product->price,
                      'quantity' => $product->count
                ]);
    
             }

      return response()->json(['code' => 1,"data"=>"Your order is created successfully"], 200);
    }

    //Show all Online Pending Orders
    public function pending_online_orders(Request $request)
    {
        $user = User::where('api_token', $request->api_token)->first();

        $pending_online_orders = OnlineOrder::where('user_id',$user->id)->whereIn('status', ['New', 'Awaiting payment','Encapsulation','Shipping'])->get();
        return response()->json($pending_online_orders);
    }

     //Show all Online Done Orders
     public function online_orders(Request $request)
     {
        $user = User::where('api_token', $request->api_token)->first();

         $finished_online_orders = OnlineOrder::where('status', 'done')->where('user_id',$user->id)->get();
         return response()->json($finished_online_orders);
     }

 //Charge Online Store Order
 public function charge_online_order(Request $request)
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
              'status' => 'Encapsulation'
         
                         ];
            $id= $request->order_id;
           $order = OnlineOrder::where('id',$id)->first();
           $order->update($data);
              return response()->json(['code' => 1,"data"=>"Your order is submit successfully"], 200);
         }else{
             $status_code = "D";
             return response()->json(['code' => 0,"data"=>"Your order is Failed"], 401);
         }
     
       
     } catch (\Exception $ex) {
         return $ex->getMessage();
     }
 }


//International store

 //International Store Request order
 public function international_order_request(Request $request)
 {
    
 
     $user = User::where('api_token', $request->api_token)->first();
     $data = [
           'user_id' => $user->id,
           'status' => 'New',
           'receiver_city' => $request->receiver_city,
           'receiver_address' => $request->receiver_address,
           'receiver_name' => $request->receiver_name,
           'receiver_number' => $request->receiver_number,
     ];
                  
        $international_request = InternationalOrder::create($data);
        $order_id =  $international_request->id;
      
        $website_link = json_encode($request->website_link);
        $website_links = json_decode($website_link);
         foreach($website_links as $website_link){

            InternationalOrderDetails::insert( [
                 'order_id' =>  $order_id,
                   'website_link' => $website_link,
                 
             ]);
 
          }
        // $data = [
        //     'order_id' =>  $order_id,
        //     'website_link' => $website_link,
        //     'receiver_city' => $request->receiver_city,
        //     'receiver_address' => $request->receiver_address,
        //     'receiver_name' => $request->receiver_name,
        //     'receiver_number' => $request->receiver_number,
        //     'status' => 'pending'
       
        //                ];
                     
            // $international_order = InternationalOrderDetails::create($data);
      
   return response()->json(['code' => 1,"data"=>"Your order is created successfully"], 200);

}

        //Show all International Pending Orders
    public function pending_international_orders(Request $request)
    {
        $user = User::where('api_token', $request->api_token)->first();

        $pending_international_orders = InternationalOrder::where('user_id',$user->id)->whereIn('status', ['New', 'Awaiting payment','Encapsulation','Shipping'])->get();
        return response()->json($pending_international_orders);
    }

     //Show all International Done Orders
     public function international_orders(Request $request)
     {
        $user = User::where('api_token', $request->api_token)->first();

         $finished_international_orders = InternationalOrder::where('status', 'done')->where('user_id',$user->id)->get();
         return response()->json($finished_international_orders);
     }

     //Charge International Store Order
 public function charge_international_order(Request $request)
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
              'status' => 'Encapsulation'
         
                         ];
            $id= $request->order_id;
           $order = InternationalOrder::where('id',$id)->first();
           $order->update($data);
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