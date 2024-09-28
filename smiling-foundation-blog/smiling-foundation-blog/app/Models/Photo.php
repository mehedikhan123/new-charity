<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_category_id',
        'photo',
        'is_active'
    ];

    public function photoCategory() {
        return $this->belongsTo(PhotoCategory::class);
    }
}
