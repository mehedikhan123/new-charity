<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    protected $fillable = [
        'orphan_id',
        'name',
        'slug',
        'goal',
        'raised',
        'short_description',
        'description',
        'featured_photo',
        'is_featured'
    ];

    public function orphans()
    {
        return $this->belongsTo(Orphan::class, 'orphan_id');
    }
}
