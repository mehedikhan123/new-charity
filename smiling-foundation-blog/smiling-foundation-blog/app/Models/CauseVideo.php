<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauseVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cause_id',
        'video',
        'is_active'
    ];
}
