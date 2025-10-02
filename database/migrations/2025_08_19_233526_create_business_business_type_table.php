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
        Schema::create('business_business_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_detail_id')->constrained('business_details')->cascadeOnDelete();
            $table->foreignId('business_type_id')->constrained('business_types')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_business_type');
    }
};
