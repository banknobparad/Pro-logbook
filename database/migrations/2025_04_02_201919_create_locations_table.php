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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('student_id1', 10)->unique()->nullable();
            $table->string('student_id2', 10)->unique()->nullable();
            $table->string('student_id3', 10)->unique()->nullable();
            $table->string('student_id4', 10)->unique()->nullable();
            $table->tinyInteger('mentor_id1')->nullable();
            $table->tinyInteger('mentor_id2')->nullable();
            $table->tinyInteger('mentor_id3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
