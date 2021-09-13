<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';

    public function playlist()
    {
       return $this->belongsTo(Play_list::class);
}

    public function user()
    {
        return $this->belongsTo(User::class);
}
}
