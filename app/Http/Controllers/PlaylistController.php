<?php

namespace App\Http\Controllers;

use App\Models\Play_list;
use App\Models\User;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function create(Request $request)
    {
        $playlist=new Play_list();
        $playlist->name=$request->input('name');
        $playlist->description=$request->input('description');
        $playlist->image=$request->input('image');
        $playlist->user_id=$request->input('user_id');
        $playlist->save();
        return response()->json('succsess',201);
   }

    public function getPlaylistByUserId($id)
    {
        $playlist=User::findOrFail($id)->playlists()->get();
        return response()->json($playlist);
   }

    public function delete($id)
    {
        $playlist=Play_list::findOrFail($id);
        $playlist->delete();
        return response()->json('delete success',201);
   }

    public function edit($id)
    {
        $playlist=Play_list::findOrFail($id);
        return response()->json($playlist);
   }

    public function update(Request $request,$id)
    {
        $playlist=Play_list::findOrFail($id);
        $playlist->name=$request->input('name');
        $playlist->description=$request->input('description');
        $playlist->image=$request->input('image');
        $playlist->save();
        return response()->json('succsess',201);
   }

    public function songOfPlaylist($id)
    {
        $song=Play_list::findOrFail($id)->songs;
        return response()->json($song);
   }

    public function removeSong($id,$songid)
    {
        $playlist=Play_list::findOrFail($id);
        $playlist->songs()->detach($songid);
        return response()->json('xoa bai hat khoi playlist thanh cong',201);
   }

    public function addSong($id,$song_id)
    {
        $playlist=Play_list::findOrFail($id);
        $playlist->songs()->attach($song_id);
        return response()->json('them bai hat vao playlist',201);
   }

    public function countSongPlaylist($id)
    {
        $count=Play_list::findOrFail($id)->songs()->count();
        return response()->json($count);
   }

  public function countPlaylistUser($id)
    {
        $count=User::findOrFail($id)->playlists()->count();
        return response()->json($count);
   }

    public function getAll()
    {
        $playlists=Play_list::all();
        return response()->json($playlists);
   }

}
