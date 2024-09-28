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
        Schema::create('orphans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_of_birth');
            $table->integer('age');
            $table->string('gender'); 
            $table->string('economic_status'); 
            $table->string('guardian_name');
            $table->string('relationship_with_guardian'); 
            $table->string('mobile_number');
            $table->string('email_address')->unique();
            $table->text('description')->nullable();
            $table->string('support_type'); 
            $table->string('photo');
            $table->string('village_city');
            $table->foreignId('upazila')->constrained('upazilas');
            $table->foreignId('district')->constrained('districts');
            $table->foreignId('division')->constrained('divisions');
            $table->foreignId('reported_by')->constrained('volunteers');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orphans');
    }
};
