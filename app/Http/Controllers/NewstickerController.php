<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsticker;

class NewstickerController extends Controller
{
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
            'sentence' => 'required'
        ]);

        $data = [
            'sentencs' => $request->sentence
        ];

        Newsticker::create($data);

        return redirect('animated_bar')->with('message','New Sentence has been added successfully');
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
            'sentence' => 'required'
        ]);

        $bar->sentencs = $request->sentence;

        $bar->save();

        return redirect('animated_bar/edit/'.$bar->id)->with('message','The Sentence has been edited successfully');

    }

    public function destroy($id)
    {
        $bar = Newsticker::where('id',$id)->delete();

        return redirect('animated_bar')->with('message','The Sentence has been removed successfully');
    }

    //API
    public function showapi(){
        $bars = Newsticker::all();
        return response()->json($bars);
    }
}
