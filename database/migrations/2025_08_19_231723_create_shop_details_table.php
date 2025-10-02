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
        Schema::create('shop_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->cascadeOnDelete();

            $table->foreignId('year_build_id')->constrained('year_builds')->cascadeOnDelete();
            $table->foreignId('condition_id')->constrained('conditions')->cascadeOnDelete();
            $table->foreignId('furnishing_id')->constrained('furnishings')->cascadeOnDelete();
            $table->foreignId('orientation_id')->constrained('orientations')->cascadeOnDelete();
            $table->foreignId('heating_id')->constrained('heatings')->cascadeOnDelete();

            $table->boolean('parking')->default(false);
            $table->boolean('warehouse')->default(false);
            $table->integer('bathrooms');

            $table->integer('floor');
            $table->boolean('main_street')->default(false);
            $table->boolean('corner_location')->default(false);
            $table->boolean('double_facade')->default(false);

            $table->boolean('electricity')->default(false);
            $table->boolean('water_supply')->default(false);
            $table->boolean('ventilation')->default(false);
            $table->boolean('fire_safety')->default(false);

            $table->decimal('ceiling_height_m', 4);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_details');
    }
};
