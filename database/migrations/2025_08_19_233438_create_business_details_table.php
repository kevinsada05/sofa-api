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
        Schema::create('business_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->cascadeOnDelete();

            // Karakteristikat bazë
            $table->string('business_name')->nullable();
            $table->unsignedInteger('established_year')->nullable();
            $table->integer('employees')->nullable();

            // Lokacioni
            $table->boolean('on_main_street')->default(false);
            $table->boolean('parking')->default(false);

            // Ambienti
            $table->integer('floors');
            $table->integer('bathrooms');
            $table->boolean('kitchen')->default(false);
            $table->boolean('outdoor_area')->default(false);
            $table->boolean('storage_room')->default(false);

            // Siguria
            $table->boolean('alarm_system')->default(false);
            $table->boolean('fire_safety')->default(false);
            $table->boolean('handicap_accessible')->default(false);

            // Asetet / Licencat
            $table->boolean('equipment_included')->default(false);
            $table->boolean('inventory_included')->default(false);
            $table->boolean('license_included')->default(false);
            $table->boolean('franchise')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_details');
    }
};
