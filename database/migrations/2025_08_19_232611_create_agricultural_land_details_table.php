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
        Schema::create('agricultural_land_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->cascadeOnDelete();

            $table->boolean('water_access')->default(false);
            $table->boolean('electricity_access')->default(false);
            $table->boolean('road_access')->default(false);

            $table->foreignId('land_type_id')->constrained('land_types')->cascadeOnDelete();
            $table->boolean('irrigation_system')->default(false);
            $table->foreignId('soil_quality_id')->constrained('soil_qualities')->cascadeOnDelete();
            $table->boolean('fenced')->default(false);

            $table->foreignId('terrain_type_id')->constrained('terrain_types')->cascadeOnDelete();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agricultural_land_details');
    }
};
