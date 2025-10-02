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
        Schema::create('villa_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->cascadeOnDelete();
            $table->foreignId('year_build_id')->constrained('year_builds')->cascadeOnDelete();
            $table->foreignId('condition_id')->constrained('conditions')->cascadeOnDelete();
            $table->foreignId('furnishing_id')->constrained('furnishings')->cascadeOnDelete();
            $table->foreignId('orientation_id')->constrained('orientations')->cascadeOnDelete();
            $table->foreignId('heating_id')->constrained('heatings')->cascadeOnDelete();
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('floors');
            $table->boolean('balcony')->default(false);
            $table->boolean('veranda')->default(false);
            $table->boolean('garden')->default(false);
            $table->boolean('parking')->default(false);
            $table->boolean('pool')->default(false);
            $table->boolean('basement')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villa_details');
    }
};
