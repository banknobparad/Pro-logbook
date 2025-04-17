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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('student_id', 10)->unique()->nullable();
            $table->enum('branch', ['วิทยาการคอมพิวเตอร์', 'เทคโนโลยีสารสนเทศ', 'เทคโนโลยีเครือข่าย', 'ภูมิสารสนเทศ'])->nullable();
            $table->enum('year', ['1', '2', '3', '4', '5'])->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['Administrator', 'Teacher', 'Student', 'Mentor'])->default('Student');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
