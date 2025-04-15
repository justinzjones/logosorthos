<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('color')->default('hippie-blue-500');
            $table->timestamps();
        });

        // Insert default categories
        DB::table('categories')->insert([
            ['name' => 'News', 'color' => 'hippie-blue-500'],
            ['name' => 'Discovery', 'color' => 'san-felix-500'],
            ['name' => 'Aviation', 'color' => 'gable-green-500'],
            ['name' => 'Finance', 'color' => 'hippie-blue-600'],
            ['name' => 'History', 'color' => 'san-felix-600'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
