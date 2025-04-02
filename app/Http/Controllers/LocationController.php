<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{


    public function add()
    {
        return view('location.add');
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
