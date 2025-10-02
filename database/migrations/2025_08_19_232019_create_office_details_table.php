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
        Schema::create('office_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->cascadeOnDelete();

            $table->foreignId('year_build_id')->constrained('year_builds')->cascadeOnDelete();
            $table->foreignId('condition_id')->constrained('conditions')->cascadeOnDelete();
            $table->foreignId('furnishing_id')->constrained('furnishings')->cascadeOnDelete();
            $table->foreignId('orientation_id')->constrained('orientations')->cascadeOnDelete();
            $table->foreignId('heating_id')->constrained('heatings')->cascadeOnDelete();

            $table->integer('bathrooms');
            $table->boolean('parking')->default(false);
            $table->integer('rooms');
            $table->boolean('conference_hall')->default(false);

            $table->integer('floor');
            $table->boolean('meeting_room')->default(false);
            $table->boolean('open_space')->default(false);
            $table->boolean('reception')->default(false);
            $table->boolean('elevator')->default(false);

            $table->boolean('internet')->default(false);
            $table->boolean('air_conditioning')->default(false);
            $table->boolean('kitchenette')->default(false);
            $table->boolean('security_system')->default(false);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_details');
    }
};
