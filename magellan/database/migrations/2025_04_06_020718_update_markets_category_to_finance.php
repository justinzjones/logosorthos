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
        // Update category name from 'Markets' to 'Finance'
        DB::table('categories')
            ->where('name', 'Markets')
            ->update(['name' => 'Finance']);

        // Update any articles with the old category name
        DB::table('articles')
            ->where('category_name', 'Markets')
            ->update(['category_name' => 'Finance']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to 'Markets' if needed
        DB::table('categories')
            ->where('name', 'Finance')
            ->update(['name' => 'Markets']);

        // Revert any articles back to the old category name
        DB::table('articles')
            ->where('category_name', 'Finance')
            ->update(['category_name' => 'Markets']);
    }
};
