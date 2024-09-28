<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo_1')->nullable();
            $table->string('logo_2')->nullable();
            $table->string('favicon')->nullable();
            $table->string('banner')->nullable();
            $table->string('seo_company_name')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_short_description')->nullable();
            $table->json('seo_keywords')->nullable();
            $table->string('top_address')->nullable();
            $table->string('top_phone')->nullable();
            $table->string('top_email')->nullable();
            $table->string('footer_address')->nullable();
            $table->string('footer_phone')->nullable();
            $table->string('footer_email')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('copyright')->nullable();
            $table->string('contact_address_1')->nullable();
            $table->string('contact_phone_1')->nullable();
            $table->string('contact_email_1')->nullable();
            $table->string('contact_address_2')->nullable();
            $table->string('contact_phone_2')->nullable();
            $table->string('contact_email_2')->nullable();
            $table->string('map_1_country_name')->nullable();
            $table->string('map_1_country_photo')->nullable();
            $table->string('map_2_country_name')->nullable();
            $table->string('map_2_country_photo')->nullable();
            $table->text('map_1')->nullable();
            $table->text('map_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
