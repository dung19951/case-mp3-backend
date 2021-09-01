<?php

namespace App\Http\Controllers;

use App\Models\Singer;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function index()
    {
        $songs=Song::all();
       return response()->json($songs);
    }
    public function store(Request $request)
    {
        $song=new Song();
        $song->song_name=$request->input('song_name');
        $song->song_image=$request->input('song_image');
        $song->singer_id=$request->input('singer_id');
        $song->path=$request->input('path');
        $song->save();

        return response()->json($song,201);
    }

    public function destroy($id)
    {

        $song=Song::findOrFail($id);
        $song->delete();
        $songs=Song::all();
      return response()->json($songs);
    }

    public function update(Request $request,$id)
    {
        $song=Song::findOrFail($id);
        $song->song_name=$request->input('song_name');
        $song->song_image=$request->input('song_image');
        $song->singer_id=$request->input('singer_id');
        $song->path=$request->input('path');
        $song->save();
        return response()->json($song,201);
    }

    public function show5()
    {
        $song=Song::whereNotNull('created_at')->limit(5);
        return response()->json($song);
    }
}
