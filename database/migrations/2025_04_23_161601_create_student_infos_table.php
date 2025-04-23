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
        Schema::create('student_infos', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 10)->unique()->nullable();

            $table->string('image_student')->nullable();
            $table->string('name_eng')->nullable();
            $table->date('birthday')->nullable();
            $table->string('age')->nullable();
            $table->string('religion')->nullable();
            $table->enum('degree_level', ['ปริญญาตรี', 'ปริญญาโท',])->nullable();
            $table->string('group')->nullable();
            $table->string('term_year')->nullable();
            $table->string('year')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_career')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_career')->nullable();

            // ภูมิลำเนาเดิม
            $table->string('old_house_no')->nullable();
            $table->string('old_moo')->nullable();
            $table->string('old_soi')->nullable();
            $table->string('old_road')->nullable();
            $table->string('old_subdistrict')->nullable();
            $table->string('old_district')->nullable();
            $table->string('old_province')->nullable();
            $table->string('old_zip_code')->nullable();
            $table->string('old_phone_number')->nullable();

            // ภูมิลำเนาปัจจุบัน
            $table->string('now_house_no')->nullable();
            $table->string('now_moo')->nullable();
            $table->string('now_soi')->nullable();
            $table->string('now_road')->nullable();
            $table->string('now_subdistrict')->nullable();
            $table->string('now_district')->nullable();
            $table->string('now_province')->nullable();
            $table->string('now_zip_code')->nullable();
            $table->string('now_phone_number')->nullable();

            // ข้อมูลการทำงาน
            $table->string('work_experience')->nullable();
            $table->string('talent')->nullable();
            $table->string('special_interests')->nullable();

            // สถานภาพ
            $table->enum('marital_status', ['โสด', 'แต่งงาน', 'หย่าร้าง'])->nullable();
            $table->string('spouse_name')->nullable(); // ชื่อสามีหรือภรรยา
            $table->string('spouse_job')->nullable();  // อาชีพสามีหรือภรรยา
            $table->string('children_count')->nullable(); // จำนวนบุตร

            // กรณีฉุกเฉิน
            $table->string('emg_name')->nullable();     // ชื่อผู้ติดต่อฉุกเฉิน
            $table->string('emg_address')->nullable();  // ที่อยู่ผู้ติดต่อฉุกเฉิน
            $table->string('emg_phone')->nullable();    // เบอร์ติดต่อฉุกเฉิน`


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_infos');
    }
};
