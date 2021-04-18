<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Socailmedia;

class SocailmediaController extends Controller
{
    public function index()
    {
        $socailmedia = Socailmedia::first();
        return view('socail_media',compact('socailmedia'));
    }

    public function update(Request $request)
    {
        $socailmedia = Socailmedia::first();

        $socailmedia->facebook = $request->facebook;
        $socailmedia->twitter = $request->twitter;
        $socailmedia->instagram = $request->instagram;
        $socailmedia->youtube = $request->youtube;
        $socailmedia->telegram = $request->telegram;
        $socailmedia->whatsapp = $request->whatsapp;

        $socailmedia->save();

        return redirect('socail_media')->with('message','The links has been edited successfully');

    }

    //API
    public function showapi(){
        $socailmedia = Socailmedia::first();
        return response()->json($socailmedia);
    }
}
