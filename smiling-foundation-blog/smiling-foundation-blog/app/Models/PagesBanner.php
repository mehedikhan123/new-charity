<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagesBanner extends Model
{
    use HasFactory;

    protected $table = 'pages_banner';

    protected $fillable = [
        'appeal',
        'about_history',
        'about_who',
        'executive',
        'volunteer',
        'program',
        'photo_gallery',
        'video_gallery',
        'story',
        'testimonial',
        'join_volunteer',
        'be_sponsor',
        'blog',
        'news',
        'contact',
        'donate'
    ];
}