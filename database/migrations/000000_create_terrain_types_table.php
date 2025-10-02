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
        Schema::create('terrain_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');   // Display name (e.g., Flat, Hilly, Mountainous)
            $table->string('code');   // Short code (e.g., flat, hilly, mountain)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terrain_types');
    }
};
