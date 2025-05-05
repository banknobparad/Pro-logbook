<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentLog;

class TeacherController extends Controller
{
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