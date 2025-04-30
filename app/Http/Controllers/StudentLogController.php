<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentLogController extends Controller
{
    public function index()
    {
        return view('student.log');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'date' => 'required|date',
            'title.*' => 'required|string|max:255',
            'details.*' => 'required|string',
        ]);

        // Process and save the data (example logic)
        foreach ($request->title as $index => $title) {
            // Save each log entry
            // Example: Log::create([...]);
        }

        // Redirect back with success message
        return redirect()->route('student.log')->with('success', 'บันทึกประจำวันสำเร็จ');
    }
}
