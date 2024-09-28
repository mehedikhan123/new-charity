<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'video',
        'is_active'
    ];

    public function program()
    {
        return $this->hasOne(ProgramVideo::class, 'program_id');
    }
}
