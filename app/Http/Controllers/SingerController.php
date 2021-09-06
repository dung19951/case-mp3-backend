<?php

namespace App\Http\Controllers;

use App\Models\Singer;
use Illuminate\Http\Request;

class SingerController extends Controller
{
    public function getAll()
    {
        $singers = Singer::all();
        return view('admin.singer-manager.list', compact('singers'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $singers = Singer::where('name', 'LIKE', '%' . $keyword . '%')->get();
        return view('admin.singer-manager.list', compact('singers'));
    }

    public function delete($id)
    {
        $singer = Singer::findOrFail($id);
        $singer->delete();
        return redirect()->route('home');
    }

    public function edit($id)
    {
        $singer = Singer::findOrFail($id);
        return view('admin.singer-manager.edit',compact('singer'));
    }

    public function update(Request $request,$id)
    {
        $singer = Singer::findOrFail($id);
        $singer->name = $request->input('name');
        $singer->save();
        return redirect()->route('home');
    }
}


