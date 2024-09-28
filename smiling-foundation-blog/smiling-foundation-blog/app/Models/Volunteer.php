<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $casts = [
        'skills' => 'array'
    ];

    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'dob',
        'age',
        'occupation',
        'institute',
        'phone',
        'email',
        'street',
        'city',
        'state',
        'post_code',
        'country_id',
        'skills',
        'experiences',
        'bring_change',
        'photo',
        'is_active'
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
