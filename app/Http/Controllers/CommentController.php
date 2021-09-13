<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Play_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $comment=new Comment();
        $comment->content=$request->input('content');
        $comment->user_id=$request->input('user_id');
        $comment->play_list_id=$request->input('play_list_id');
        $comment->save();
        return response()->json('comment',201);
    }

    public function findCommentByPlaylistId($id)
    {
       $comment=DB::table('comments')
           ->join('users','users.id','=','comments.user_id')
           ->select('users.name','comments.content','comments.id','comments.user_id')
           ->where('play_list_id',$id)
           ->orderByDesc('id')
           ->get();
       return response()->json($comment);
    }

    public function delete($id)
    {

            $comment=Comment::findOrFail($id);
            $comment->delete();
            return response()->json('xoa thanh cong',201);


    }

}
