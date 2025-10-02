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
        Schema::create('business_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');   // p.sh. Hotel, Bar, Restorant, Internet Cafe, Dyqan, Qendër tregtare, Fast Food, Klinikë, etj.
            $table->string('code')->unique(); // p.sh. HOTEL, BAR, RESTO, INTERNET_CAFE
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_types');
    }
};
