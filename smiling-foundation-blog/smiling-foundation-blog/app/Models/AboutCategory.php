<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_active'
    ];

    public function abouts()
    {
        return $this->hasMany(About::class, 'category_id');
    }
}
