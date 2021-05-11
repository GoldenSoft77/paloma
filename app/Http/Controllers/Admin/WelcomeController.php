<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Welcome;

class WelcomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $welcome = Welcome::all();
        return view('welcome_page',compact('welcome'));
    }

    public function create()
    {
        return view('welcome_page_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slide_title_en' => 'required',
            'slide_title_ar' => 'required',
            'slide_paragraph_en' => 'required',
            'slide_paragraph_ar' => 'required',
            'slide_img' => 'required|image'
        ]);
        $slide_title_en = $request->slide_title_en;
        $slide_title_ar = $request->slide_title_ar;

        $slide_paragraph_en = $request->slide_paragraph_en;
        $slide_paragraph_ar = $request->slide_paragraph_ar;

        $data = [
            'en' => [
                'title' => $slide_title_en,
                'paragraph' => $slide_paragraph_en
            ],
            'ar' => [
                'title' => $slide_title_ar,
                'paragraph' => $slide_paragraph_ar
            ]
        ];


        if($request->file('slide_img')){
            $file=$request->file('slide_img');
            
            $path = 'images/welcome_page/';
            $name=$file->getClientOriginalName();
            $name = $path.$name;
            $file->move($path,$name);
            
            $data['img'] = $name;
        }

        Welcome::create($data);

        return redirect('admin/welcome_page')->with('message','New Slide has been added successfully');
    }

    public function edit($id)
    {
        $welcome = Welcome::where('id',$id)->first();
        return view('welcome_page_edit', compact('welcome'));
    }

    public function update(Request $request, $id)
    {
        $welcome = Welcome::where('id',$id)->first();

        $request->validate([
            'slide_title_en' => 'required',
            'slide_title_ar' => 'required',
            'slide_paragraph_en' => 'required',
            'slide_paragraph_ar' => 'required'
        ]);
        $slide_title_en = $request->slide_title_en;
        $slide_title_ar = $request->slide_title_ar;

        $slide_paragraph_en = $request->slide_paragraph_en;
        $slide_paragraph_ar = $request->slide_paragraph_ar;

        $data = [
            'en' => [
                'title' => $slide_title_en,
                'paragraph' => $slide_paragraph_en
            ],
            'ar' => [
                'title' => $slide_title_ar,
                'paragraph' => $slide_paragraph_ar
            ]
        ];

        if($request->file('slide_img')){
            $file=$request->file('slide_img');
            
            $path = 'images/welcome_page/';
            $name=$file->getClientOriginalName();
            $name = $path.$name;
            $file->move($path,$name);
            
            $welcome->img = $name;
        }
        $welcome->update($data);
       

        return redirect('admin/welcome_page/edit/'.$welcome->id)->with('message','The slide has been edited successfully');

    }

    public function destroy($id)
    {
        $welcome = Welcome::where('id',$id)->delete();

        return redirect('admin/welcome_page')->with('message','The Slide has been removed successfully');
    }

  
}
