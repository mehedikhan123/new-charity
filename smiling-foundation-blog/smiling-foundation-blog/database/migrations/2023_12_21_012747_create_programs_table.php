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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('type');
            $table->text('short_description');
            $table->text('description');
            $table->string('photo')->nullable();
            $table->string('start_date_time');
            $table->string('end_date_time');
            $table->string('location');
            $table->integer('price')->nullable();
            $table->integer('total_seat')->nullable();
            $table->integer('booked_seat')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
