<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppealVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'appeal_id',
        'video',
        'is_active'
    ];
}
