<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'counter',
        'text',
        'button_text',
        'button_link',
        'is_active'
    ];
}
