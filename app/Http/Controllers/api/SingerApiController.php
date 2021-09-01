<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Singer;
use Illuminate\Http\Request;

class SingerApiController extends Controller
{
    public function getAll()
    {
        $singers = Singer::all();
        return response()->json($singers);
    }

    public function store(Request $request)
    {
        $singer = new Singer();
        $singer->name =$request->input('name');
        $singer->save();
        return response()->json($singer, 201);
    }

    public function update(Request $request,$id)
    {
        $singer = Singer::findOrFail($id);
        $singer->name = $request->input('name');
        $singer->save();
        return response()->json($singer,202);
    }

    public function destroy($id)
    {
        $singer = Singer::findOrFail($id);
        $singer->delete();
    }

    public function find(Request $request)
    {
        $keyword = $request->input('search');
        $singer = Singer::where('name','LIKE','%'.$keyword.'%')->get();
        return response()->json($singer,201);
    }
}
