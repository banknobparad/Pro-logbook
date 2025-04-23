<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $studentId = $user->student_id;

        $location = Location::where('student_id1', $studentId)
            ->orWhere('student_id2', $studentId)
            ->orWhere('student_id3', $studentId)
            ->orWhere('student_id4', $studentId)
            ->first();

        return view('student.index', compact('user', 'location'));
    }
}
