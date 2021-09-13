<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Play_list extends Model
{
    use HasFactory;
    protected $table = 'play_lists';

    public function songs()
    {
        return $this->belongsToMany(Song::class,'playLists_songs','playList_id','song_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
