<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentLog;
use App\Models\User;

class TeacherController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'Student')->get(); // Fetch users with role 'Student'
        return view('teacher.index', compact('students')); // Pass $students to the view
    }

    public function updateComment(Request $request)
    {
        $log = StudentLog::findOrFail($request->id);

        if (auth()->user()->role === 'Teacher') {
            $log->teacher_comments = $request->teacher_comments;
            $log->save();
        }

        return redirect()->back()->with('success', 'ความคิดเห็นของอาจารย์ถูกอัปเดตเรียบร้อยแล้ว');
    }
}