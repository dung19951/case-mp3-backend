<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
<<<<<<< HEAD
     protected $table = 'songs';
protected $fillable=[
    'song_name',
    'song_imgae',
    'path',
    'singer_id'
];
=======

    protected $table = 'songs';

>>>>>>> d635206fb8fbfa6eabf646bb3b8e10303543ac3c
    public function singer()
    {
        return $this->belongsTo(Singer::class);
    }
}
