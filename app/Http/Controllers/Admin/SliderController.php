<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Slider;
use App\ApiRequest;
use Image;
use Carbon\Carbon;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
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
            $image=$request->file('slide_img');

            $input['slide_img'] = $image->getClientOriginalName();
            $path = 'images/thumbnail/';
            $destinationPath = public_path('/images/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'. $input['slide_img']);
       
            $destinationPath = public_path('/images/sliders');
            $image->move($destinationPath,  $input['slide_img']);
       
    
            // $path = 'images/sliders/';
            // $name=$file->getClientOriginalName();
            // $name = $path.$name;
            // $file->move($path,$name);
         
            // $pathToImage = 'http://'.$_SERVER['HTTP_HOST'].'/'.$name;
            // // $optimizerChain = OptimizerChainFactory::create();
            // // $optimizerChain->optimize($pathToImage);
         
           
            $name = $path.$input['slide_img'];
            
        
        }
        $data = [
            'url' => $request->url,
            'img' =>$name
        ];

        Slider::create($data);

        $api_request = ApiRequest::where('api_request','slider')->first(); 
        $data = [
      
            'api_request'=>  'slider',
            'edit_time' =>Carbon::now()
        ];
        $api_request->update($data);


        return redirect('/admin/slider')->with('message','New Slide has been added successfully');
    }

    public function destroy($id)
    {
        $slides = Slider::where('id',$id)->delete();
        $api_request = ApiRequest::where('api_request','slider')->first(); 
        $data = [
            'api_request'=>  'slider',
            'edit_time' =>Carbon::now()
        ];
        $api_request->update($data);

        return redirect('/admin/slider')->with('message','The Slide has been removed successfully');
    }

   
}
