<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_category_id',
        'video',
        'is_active'
    ];

    public function videoCategory() {
        return $this->belongsTo(VideoCategory::class);
    }
}
