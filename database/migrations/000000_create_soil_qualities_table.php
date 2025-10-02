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
        Schema::create('soil_qualities', function (Blueprint $table) {
            $table->id();
            $table->string('name');   // Display name (e.g., Fertile, Medium, Poor)
            $table->string('code');   // Short code (e.g., fertile, medium, poor)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soil_qualities');
    }
};
