<?php

namespace App\Http\Controllers;

use App\Models\Singer;
use Illuminate\Http\Request;

class SingerController extends Controller
{
    public function index()
    {
        $singers = Singer::all();
        return response()->json($singers);
    }

    public function add(Request $request)
    {
        $singer = new Singer();
        $singer->name =$request->input('name');
        $singer->save();
        return response()->json($singer, 201);
    }
}


