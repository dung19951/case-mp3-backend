<?php

namespace App\Http\Controllers;

use App\Models\Singer;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use function Symfony\Component\String\s;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::all();
        return response()->json($songs);
    }

    public function store(Request $request)
    {
        $song = new Song();
        $song->song_name = $request->input('song_name');
        $song->song_image = $request->input('song_image');
        $song->singer_id = $request->input('singer_id');
        $song->path = $request->input('path');
        $song->lyric = $request->input('description');
        $song->author = $request->input('author');
        $song->category_id = $request->input('category_id');
        $song->user_id = $request->input('user_id');
        $song->save();

        return response()->json($song, 201);
    }

    public function destroy($id)
    {

        $song = Song::findOrFail($id);
        $song->delete();
        $songs = Song::all();
        return response()->json($songs);
    }

    public function update(Request $request, $id)
    {
        $song = Song::findOrFail($id);
        $song->song_name = $request->input('song_name');
        $song->song_image = $request->input('song_image');
        $song->singer_id = $request->input('singer_id');
        $song->path = $request->input('path');
        $song->lyric = $request->input('description');
        $song->author = $request->input('author');
        $song->save();
        return response()->json($song, 201);
    }

    public function show5()
    {
        $song = Song::orderBy('id', 'desc')->limit(5)->get();
        return response()->json($song);
    }

    public function mySong($id)
    {
        $user = User::findOrFail($id);
        $song = $user->songs()->get();
        return response()->json($song);
    }

    public function findSongById($id)
    {
        $song = Song::findOrFail($id);
        return response()->json($song);
    }
}
