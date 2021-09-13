<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($id)
    {
        $likeSong= Like::where('song_id',$id)->where('user_id',Auth::id())->first();
        if ($likeSong){
            $likeSong->delete();
        }else{
            $like = new Like();
            $like->user_id = Auth::id();
            $like->song_id = $id;
            $like->status = true;
            $like->save();
        }
        $countLike = Like::where('song_id',$id)->count();
        return response()->json($countLike);

    }

}
