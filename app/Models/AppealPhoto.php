<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppealPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'appeal_id',
        'photo',
        'is_active'
    ];
}
