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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('dob');
            $table->integer('age');
            $table->string('occupation');
            $table->string('institute')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('post_code');
            $table->foreignId('country_id')->constrained('countries');
            $table->json('skills')->nullable();
            $table->text('experiences')->nullable();
            $table->text('bring_change')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
