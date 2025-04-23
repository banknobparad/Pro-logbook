<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;

class LocationController extends Controller
{


    public function index()
    {
        $locations = Location::all();

        // รวม student_id1-4
        $studentIds = $locations->flatMap(function ($loc) {
            return [
                $loc->student_id1,
                $loc->student_id2,
                $loc->student_id3,
                $loc->student_id4,
            ];
        })->filter()->unique();

        // รวม mentor_id1-3
        $mentorIds = $locations->flatMap(function ($loc) {
            return [
                $loc->mentor_id1,
                $loc->mentor_id2,
                $loc->mentor_id3,
            ];
        })->filter()->unique();

        // ดึง users ทั้งนักศึกษาและพี่เลี้ยง
        $users = User::whereIn('student_id', $studentIds)
            ->orWhereIn('id', $mentorIds)
            ->get();

        // สร้าง 2 map แยก: student → keyBy student_id, mentor → keyBy id
        $students = $users->whereNotNull('student_id')->keyBy('student_id');
        $mentors = $users->keyBy('id');

        return view('location.index', compact('locations', 'students', 'mentors'));
    }

    public function store(Request $request)
    {
        // Validate ข้อมูลที่รับมาจากฟอร์ม
        $request->validate([
            'name' => 'required|string|max:255',
            'student_id1' => 'nullable|size:10',
            'student_id2' => 'nullable|size:10',
            'student_id3' => 'nullable|size:10',
            'student_id4' => 'nullable|size:10',
        ]);

        // สร้างข้อมูลในฐานข้อมูล
        Location::create([
            'name' => $request->name,
            'student_id1' => $request->student_id1,
            'student_id2' => $request->student_id2,
            'student_id3' => $request->student_id3,
            'student_id4' => $request->student_id4,
        ]);

        // แสดงผลข้อความเมื่อบันทึกสำเร็จ
        return redirect()->back()->with('success', 'ข้อมูลสถานที่ฝึกงานบันทึกสำเร็จ');
    }
}
