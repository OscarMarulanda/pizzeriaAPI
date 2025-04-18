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
        Schema::table('sabor', function (Blueprint $table) {
            $table->string('imageUrl')->nullable(); // Add the imageUrl column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sabor', function (Blueprint $table) {
            $table->dropColumn('imageUrl'); // Drop the imageUrl column if rolling back
        });
    }
};
