<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductSection;
use App\ProductImage;
use App\Vendor;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
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

       //Add New Product
       public function create()
       {
            $sections = ProductSection::all();
            $vendors = Vendor::all();
           return view('products.add_product',compact('sections','vendors'));
       }
   
    //store New Product
    public function store(Request $request) {
      
        $data = [
            'name' => $request->product_name,
            'price' => $request->product_price,
            'description' => $request->product_desc,
            'count' => $request->product_count,
            'status' => 'pending',
            'section_id' => $request->product_section,
            'vendor_id' => $request->vendor_id,
        ];
      
     // Product Main Image
     if($request->file('img')){
        $file = $request->file('img');
        $path = 'images/product/';
        $name = $file->getClientOriginalName();
        $name = $path.$name;
        $file -> move($path,$name);
        $data['main_img'] = $name;
    }
    
    $product = Product::create($data);
    
    // Product Secondary Images
    if($request->file('images')){
        $files = $request->file('images');
        foreach($files as $file){
            $path = 'images/'.$product->name.'/';
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

    return redirect('/admin/products')->with('message','The Product has been Added successfully');

      
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
        return redirect('/admin/products')->with('message','The Product has been Added successfully');

    }
     //Admin approve Delete Product
    public function approve_product_delete(Request $request,$id) {

        $product = Product::where('id',$id)->delete();

        return redirect('/admin/products')->with('message','The Product has been removed successfully');
    }

   
   
}
