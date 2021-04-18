<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{

    public function index()
    {
        $slides = Slider::all();
        return view('slider',compact('slides'));
    }

    public function create()
    {
        return view('slider_add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'slide_img' => 'required|image'
        ]);

        if($request->file('slide_img')){
            $file=$request->file('slide_img');
            
            $path = 'images/sliders/';
            $name=$file->getClientOriginalName();
            $name = $path.$name;
            $file->move($path,$name);
            
            $data['img'] = $name;
        }

        Slider::create($data);

        return redirect('slider')->with('message','New Slide has been added successfully');
    }

    public function destroy($id)
    {
        $slides = Slider::where('id',$id)->delete();

        return redirect('slider')->with('message','The Slide has been removed successfully');
    }

    //API
    public function showapi(){
        $slides = Slider::all();
        return response()->json($slides);
    }
}
