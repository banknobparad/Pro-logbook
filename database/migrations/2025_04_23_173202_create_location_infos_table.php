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
        Schema::create('location_infos', function (Blueprint $table) {
            $table->id();
            $table->string('loc_house_no')->nullable();
            $table->string('loc_moo')->nullable();
            $table->string('loc_soi')->nullable();
            $table->string('loc_road')->nullable();
            $table->string('loc_subdistrict')->nullable();
            $table->string('loc_district')->nullable();
            $table->string('loc_province')->nullable();
            $table->string('loc_zip_code')->nullable();
            $table->string('loc_phone_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_infos');
    }
};
