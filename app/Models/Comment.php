<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'post_id',
        'name',
        'email',
        'status'
    ];

    public function rPost()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
