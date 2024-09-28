<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;

    protected $fillable = [
        'counter1_number',
        'counter1_name',
        'counter2_number',
        'counter2_name',
        'counter3_number',
        'counter3_name',
        'counter4_number',
        'counter4_name',
        'status'
    ];
}
