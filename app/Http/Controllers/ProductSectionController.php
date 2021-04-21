<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductSection;

class ProductSectionController extends Controller
{
    //Show all Product sections
    public function index()
    {
        $product_sections = ProductSection::all();
        return view('product_sections.product_sections',compact('product_sections'));
    }
    //Add New Product Section
    public function create()
    {
        return view('product_sections.add_product_section');
    }
    //Save New Product Section
    public function store(Request $request) {
      
      
        $data = [
            'name' => $request->name,
          
        ];
        if($request->file('icon')){
            $file=$request->file('icon');
            
            $path = 'images/icons/';
            $name=$file->getClientOriginalName();
            $name = $path.$name;
            $file->move($path,$name);
            $data['icon'] = $name;
        }

      
        $product_section = ProductSection::create($data);
        return redirect('productsections')->with('message','New Product Section has been added successfully');
    }
    //Edit a specific Product Section
    public function edit($id)
    {
        $product_section = ProductSection::where('id',$id)->first();
        return view('product_sections.edit_product_section', compact('product_section'));
    }
   //Update a specific Product Section
    public function update(Request $request, $id)
    {
        $product_section = ProductSection::where('id',$id)->first();

        $data = [
            'name' => $request->name,
          
        ];
        if($request->file('icon')){
            $file=$request->file('icon');
            
            $path = 'images/icons/';
            $name=$file->getClientOriginalName();
            $name = $path.$name;
            $file->move($path,$name);
            $data['icon'] = $name;
        }

        $product_section->update($data);

        return redirect("productsections")->with('message', 'Product Section has been updated successfully');

    }
    //Delete a specific Product Section
    public function destroy($id)
    {
        $product_section = ProductSection::where('id',$id)->delete();

        return redirect('productsections')->with('message','The Product Section has been removed successfully');
    }

    //API For Product Section
    public function showProductSectionApi(){
        $product_section = ProductSection::all();
        return response()->json($product_section);
    }
}
