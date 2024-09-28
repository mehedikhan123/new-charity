<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $casts = [
        'seo_keywords' => 'array'
    ];

    protected $fillable = [
        'logo_1',
        'logo_2',
        'favicon',
        'banner',
        'seo_company_name',
        'seo_title',
        'seo_short_description',
        'seo_keywords',
        'top_address',
        'top_phone',
        'top_email',
        'footer_address',
        'footer_phone',
        'footer_email',
        'footer_logo',
        'facebook',
        'twitter',
        'youtube',
        'linkedin',
        'instagram',
        'copyright',
        'contact_address_1',
        'contact_phone_1',
        'contact_email_1',
        'contact_address_2',
        'contact_phone_2',
        'contact_email_2',
        'map_1_country_name',
        'map_1_country_photo',
        'map_2_country_name',
        'map_2_country_photo',
        'map_1',
        'map_2'
    ];
}
