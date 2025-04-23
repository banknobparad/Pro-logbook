<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // php artisan db:seed --class=UserSeeder

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminadmin'),
            'role' => 'Administrator',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'อาจารย์สุวาณี คำศรี',
            'email' => 'teacher@gmail.com',
            'password' => Hash::make('teacherteacher'),
            'role' => 'Student',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'นายซีเมเจอร์ บลูโซล',
            'email' => 'mentor1@gmail.com',
            'password' => Hash::make('mentormentor'),
            'role' => 'Student',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'นายผ้าพันคอ ดวงดาว',
            'email' => 'mentor2@gmail.com',
            'password' => Hash::make('mentormentor'),
            'role' => 'Student',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'นางสาวแทนรัก ประนา',
            'email' => 'student@gmail.com',
            'password' => Hash::make('studentstudent'),
            'role' => 'Student',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
