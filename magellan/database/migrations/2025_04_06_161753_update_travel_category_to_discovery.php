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
        // Update category name from 'Travel' to 'Discovery'
        DB::table('categories')
            ->where('name', 'Travel')
            ->update(['name' => 'Discovery']);

        // Update any articles with the old category name
        DB::table('articles')
            ->where('category_name', 'Travel')
            ->update(['category_name' => 'Discovery']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to 'Travel' if needed
        DB::table('categories')
            ->where('name', 'Discovery')
            ->update(['name' => 'Travel']);

        // Revert any articles back to the old category name
        DB::table('articles')
            ->where('category_name', 'Discovery')
            ->update(['category_name' => 'Travel']);
    }
};
