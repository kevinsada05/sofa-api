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
        Schema::create('plot_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->cascadeOnDelete();

            // Koeficient ndërtimi (si FAR, ose intensiteti i ndërtimit)
            $table->decimal('building_coefficient', 5, 2);

            // Leja e ndërtimit
            $table->boolean('construction_permit')->default(false);

            // Infrastruktura
            $table->boolean('water')->default(false);
            $table->boolean('electricity')->default(false);
            $table->boolean('sewerage')->default(false);
            $table->boolean('road_access')->default(false);

            // Terreni
            $table->foreignId('terrain_type_id')->constrained('terrain_types')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plot_details');
    }
};
