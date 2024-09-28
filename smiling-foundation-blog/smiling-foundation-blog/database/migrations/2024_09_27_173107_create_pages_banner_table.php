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
        Schema::create('pages_banner', function (Blueprint $table) {
            $table->id();
            $table->string('appeal')->nullable();
            $table->string('about_history')->nullable();
            $table->string('about_who')->nullable();
            $table->string('executive')->nullable();
            $table->string('volunteer')->nullable();
            $table->string('program')->nullable();
            $table->string('photo_gallery')->nullable();
            $table->string('video_gallery')->nullable();
            $table->string('story')->nullable();
            $table->string('testimonial')->nullable();
            $table->string('join_volunteer')->nullable();
            $table->string('be_sponsor')->nullable();
            $table->string('blog')->nullable();
            $table->string('news')->nullable();
            $table->string('contact')->nullable();
            $table->string('donate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages_banner');
    }
};
