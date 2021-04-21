<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
     //Show all products
    public function index()
    {
        $products = Product::all();
        return view('products.products',compact('products'));
    }
    //Show all Pending Products
    public function pending()
    {
        $pending_products = Product::where('status', 'pending' )->get();
        return view('products.pending_products',compact('pending_products'));
    }
   
    //store New Product
    public function store(Request $request) {
      
        $data = [
            'name' => $request->name,
            'price ' => $request->price,
            'description' => $request->description,
            'count' => $request->count,
            'status' => 'pending',
            'section_id' => $request->section_id,
            'vendor_id' => $request->vendor_id,
        ];
      
        $product = Product::create($data);
        return response()->json([
            "message" => "New Product Created"
        ], 201);
      
    }
   
    //Delete a specific product
    public function destroy($id)
    {
        $product = Product::where('id',$id)->first();
        $data = [
            'status' => 'Delete',
        ];
        $product->update($data);

        return response()->json([
            "message" => "Delete Request"
        ], 201);  
      }
      //Admin approve request vendor to add product
    public function approve_product(Request $request,$id) {

        $product = Product::where('id',$id)->first();

        $data = [
            'status' => 'active',
        ];
      
        $product->update($data);
        return response()->json([
            "message" => "Active product"
        ], 201);
    }
  //Admin approve Delete Product
  public function approve_product_delete(Request $request,$id) {

    $product = Product::where('id',$id)->delete();

    return redirect('products')->with('message','The Product has been removed successfully');
  
}

   
   
}
