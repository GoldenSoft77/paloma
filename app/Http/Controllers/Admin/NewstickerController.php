<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Newsticker;

class NewstickerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $sentences = Newsticker::all();
        return view('animated_bar',compact('sentences'));
    }

    public function create()
    {
        return view('animated_bar_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sentence_en' => 'required',
            'sentence_ar' => 'required'
        ]);
        $sentence_en = $request->sentence_en;
        $sentence_ar = $request->sentence_ar;

        $data = [
            'static' =>'Static Value',
            'en' => [
                'sentencs' => $sentence_en,
               
            ],
            'ar' => [
                'sentencs' => $sentence_ar,
              
            ]
        ];
      

        Newsticker::create($data);

        return redirect('/admin/animated_bar')->with('message','New Sentence has been added successfully');
    }

    public function edit($id)
    {
        $sentence = Newsticker::where('id',$id)->first();
        return view('animated_bar_edit', compact('sentence'));
    }

    public function update(Request $request, $id)
    {
        $bar = Newsticker::where('id',$id)->first();

        $request->validate([
            'sentence_en' => 'required',
            'sentence_ar' => 'required'
        ]);
        $sentence_en = $request->sentence_en;
        $sentence_ar = $request->sentence_ar;

        $data = [
            'static' =>'Static Value',
            'en' => [
                'sentencs' => $sentence_en,
               
            ],
            'ar' => [
                'sentencs' => $sentence_ar,
              
            ]
        ];

        $bar->update($data);

        return redirect('/admin/animated_bar/edit/'.$bar->id)->with('message','The Sentence has been edited successfully');

    }

    public function destroy($id)
    {
        $bar = Newsticker::where('id',$id)->delete();

        return redirect('/admin/animated_bar')->with('message','The Sentence has been removed successfully');
    }

   
}
