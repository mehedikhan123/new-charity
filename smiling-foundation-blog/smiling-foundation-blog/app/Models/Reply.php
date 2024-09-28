<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'reply',
        'comment_id',
        'name',
        'email',
        'user_type',
        'status'
    ];

    public function rComment()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }
}
