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
        Schema::create('warehouse_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->cascadeOnDelete();
            $table->foreignId('year_build_id')->constrained('year_builds')->cascadeOnDelete();
            $table->foreignId('condition_id')->constrained('conditions')->cascadeOnDelete();
            $table->integer('floor_height_m');
            $table->boolean('parking')->default(false);
            $table->boolean('loading_dock')->default(false);
            $table->boolean('water')->default(false);
            $table->boolean('security')->default(false);
            $table->boolean('office_space')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_details');
    }
};
