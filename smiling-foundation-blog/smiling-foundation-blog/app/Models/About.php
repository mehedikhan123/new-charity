<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = "about_sections";
    
    protected $fillable = [
        'heading',
        'category_id',
        'text',
        'photo',
        'is_active'
    ];

    public function aboutCategories()
    {
        return $this->belongsTo(AboutCategory::class, 'category_id');
    }
}
