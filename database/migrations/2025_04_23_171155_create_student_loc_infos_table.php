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
        Schema::create('student_loc_infos', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 10)->unique()->nullable();

            // หน้าที่ประจำ
            $table->string('duty1')->nullable(); // หน้าที่ประจำ
            $table->string('duty2')->nullable(); // หน้าที่ประจำ
            $table->string('duty3')->nullable(); // หน้าที่ประจำ
            $table->string('duty4')->nullable(); // ...
            $table->string('duty5')->nullable();

            $table->text('work_issue')->nullable(); // ปัญหาที่พบในการปฏิบัติงาน
            $table->text('work_solution')->nullable(); // แนวทางในการแก้ไขปัญหาที่พบในการปฏิบัติงาน

            // รายชื่อวิชาและการนำไปใช้ในการปฏิบัติงาน
            $table->string('subject_name_1')->nullable();     // ชื่อวิชา 1
            $table->text('subject_usage_1')->nullable();      // การนำไปใช้ 1
            $table->string('subject_name_2')->nullable();     // ชื่อวิชา 2
            $table->text('subject_usage_2')->nullable();      // การนำไปใช้ 2
            $table->string('subject_name_3')->nullable();     // ชื่อวิชา 3
            $table->text('subject_usage_3')->nullable();      // การนำไปใช้ 3
            $table->string('subject_name_4')->nullable();     // ชื่อวิชา 4
            $table->text('subject_usage_4')->nullable();      // การนำไปใช้ 4
            $table->string('subject_name_5')->nullable();     // ชื่อวิชา 5
            $table->text('subject_usage_5')->nullable();      // การนำไปใช้ 5

            $table->integer('training_hours')->nullable(); // ระยะเวลาในการฝึก (ชั่วโมง)

            // งานที่ฝึก และ ผลการฝึก
            $table->text('training_task_1')->nullable();     // งานที่ฝึก 1
            $table->text('training_result_1')->nullable();   // ผลการฝึก 1
            $table->text('training_task_2')->nullable();     // งานที่ฝึก 2
            $table->text('training_result_2')->nullable();   // ผลการฝึก 2
            $table->text('training_task_3')->nullable();     // งานที่ฝึก 3
            $table->text('training_result_3')->nullable();   // ผลการฝึก 3
            $table->text('training_task_4')->nullable();     // งานที่ฝึก 4
            $table->text('training_result_4')->nullable();   // ผลการฝึก 4
            $table->text('training_task_5')->nullable();     // งานที่ฝึก 5
            $table->text('training_result_5')->nullable();   // ผลการฝึก 5


            // ปัญหาอุปสรรคในการฝึก และ ข้อคิดเห็นข้อเสนอแนะ
            $table->text('training_obstacle_1')->nullable();     // ปัญหาอุปสรรคในการฝึก 1
            $table->text('suggestion_1')->nullable();            // ข้อคิดเห็นข้อเสนอแนะ 1
            $table->text('training_obstacle_2')->nullable();     // ปัญหาอุปสรรคในการฝึก 2
            $table->text('suggestion_2')->nullable();            // ข้อคิดเห็นข้อเสนอแนะ 2
            $table->text('training_obstacle_3')->nullable();     // ปัญหาอุปสรรคในการฝึก 3
            $table->text('suggestion_3')->nullable();            // ข้อคิดเห็นข้อเสนอแนะ 3
            $table->text('training_obstacle_4')->nullable();     // ปัญหาอุปสรรคในการฝึก 4
            $table->text('suggestion_4')->nullable();            // ข้อคิดเห็นข้อเสนอแนะ 4
            $table->text('training_obstacle_5')->nullable();     // ปัญหาอุปสรรคในการฝึก 5
            $table->text('suggestion_5')->nullable();            // ข้อคิดเห็นข้อเสนอแนะ 5


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_loc_infos');
    }
};
