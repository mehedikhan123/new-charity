<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauseDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'cause_id',
        // 'user_id',
        'name',
        'email',
        'address',
        'phone',
        'price',
        'currency',
        'donation_type',
        'payment_id',
        'payment_method',
        'payment_status'
    ];

    public function cause() {
        return $this->belongsTo(Cause::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
