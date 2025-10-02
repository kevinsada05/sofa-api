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
        Schema::create('shared_rent_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->cascadeOnDelete();

            $table->foreignId('year_build_id')->constrained('year_builds')->cascadeOnDelete();
            $table->foreignId('condition_id')->constrained('conditions')->cascadeOnDelete();
            $table->foreignId('furnishing_id')->constrained('furnishings')->cascadeOnDelete();
            $table->foreignId('orientation_id')->constrained('orientations')->cascadeOnDelete();
            $table->foreignId('heating_id')->constrained('heatings')->cascadeOnDelete();

            $table->unsignedInteger('bedrooms');
            $table->unsignedInteger('bathrooms');
            $table->unsignedInteger('floor');

            $table->boolean('balcony');
            $table->boolean('veranda');
            $table->boolean('garden');

            $table->foreignId('apartment_type_id')->constrained('apartment_types')->cascadeOnDelete();

            $table->boolean('room_available')->default(true);
            $table->integer('total_roommates');
            $table->string('gender_preference');
            $table->boolean('student_only')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_rent_details');
    }
};
