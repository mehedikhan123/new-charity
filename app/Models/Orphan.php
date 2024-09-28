<?php

namespace App\Models;

use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orphan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_of_birth',
        'age',
        'gender',
        'economic_status',
        'guardian_name',
        'relationship_with_guardian',
        'mobile_number',
        'email_address',
        'description',
        'support_type',
        'photo',
        'village_city',
        'upazila',
        'district',
        'division',
        'reported_by',
        'status'
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'reported_by');
    }

    public function upazilaName()
    {
        return $this->belongsTo(Upazila::class, 'upazila');
    }

    public function districtName()
    {
        return $this->belongsTo(District::class, 'district');
    }

    public function divisionName()
    {
        return $this->belongsTo(Division::class, 'division');
    }
}
