<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
     protected $table = 'songs';
     function category(){
         return $this->belongsTo(Category::class);
     }
     function singer(){
         return $this->belongsTo(Singer::class);
     }
}
