<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'user_id',
        'unit_price',
        'number_of_tickets',
        'total_price',
        'currency',
        'payment_id',
        'payment_method',
        'payment_status'
    ];

    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
