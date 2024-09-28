<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Executive extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'phone',
        'email',
        'country_id',
        'photo',
        'is_active'
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
