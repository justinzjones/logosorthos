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
        Schema::create('atc_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('feedback_type'); // Country-specific Content, IFR Training, Additional Airports
            $table->string('country')->nullable(); // For country-specific content
            $table->string('airports')->nullable(); // For additional airports
            $table->text('comments')->nullable(); // Optional comments
            $table->string('device_id')->nullable(); // Device identifier
            $table->string('app_version')->nullable(); // App version
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atc_feedback');
    }
};
