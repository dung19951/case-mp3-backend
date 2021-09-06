<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    use HasFactory;

    protected $table = 'singers';

    function song()
    {
        return $this->hasMany(Song::class);
    }
}
