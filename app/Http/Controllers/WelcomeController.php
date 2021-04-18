<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Welcome;

class WelcomeController extends Controller
{

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
            'slide_title' => 'required',
            'slide_para' => 'required',
            'slide_img' => 'required|image'
        ]);

        $data = [
            'title' => $request->slide_title,
            'paragraph' => $request->slide_para,
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

        return redirect('welcome_page')->with('message','New Slide has been added successfully');
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
            'slide_title' => 'required',
            'slide_para' => 'required',
            'slide_img' => 'image'
        ]);

        $welcome->title = $request->slide_title;
        $welcome->paragraph = $request->slide_para;

        if($request->file('slide_img')){
            $file=$request->file('slide_img');
            
            $path = 'images/welcome_page/';
            $name=$file->getClientOriginalName();
            $name = $path.$name;
            $file->move($path,$name);
            
            $welcome->img = $name;
        }

        $welcome->save();

        return redirect('welcome_page/edit/'.$welcome->id)->with('message','The slide has been edited successfully');

    }

    public function destroy($id)
    {
        $welcome = Welcome::where('id',$id)->delete();

        return redirect('welcome_page')->with('message','The Slide has been removed successfully');
    }

    //API
    public function showapi(){
        $welcome = Welcome::all();
        return response()->json($welcome);
    }
}
