<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CausePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'cause_id',
        'photo',
        'is_active'
    ];
}
