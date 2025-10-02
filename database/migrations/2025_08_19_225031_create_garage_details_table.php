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
        Schema::create('garage_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->cascadeOnDelete();

            $table->integer('capacity'); // number of cars

            // amenities
            $table->boolean('electric_door')->default(false);
            $table->boolean('security_camera')->default(false);
            $table->boolean('lighting')->default(false);
            $table->boolean('electricity')->default(false);
            $table->boolean('indoor')->default(true);
            $table->integer('floor');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garage_details');
    }
};
