<?php
namespace App\Http\Controllers;

use App\Models\StudentLog;
use App\Models\Location; // Import the Location model
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StudentLogController extends Controller
{
    public function index()
    {
        $student_log = StudentLog::where('student_id', auth()->user()->student_id)->get();
        
        return view('student.log', compact('student_log'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'details' => 'required|string',
        ]);

        // Retrieve or create the student log record
        $studentLog = StudentLog::firstOrCreate(
            ['student_id' => auth()->user()->student_id],
            ['log' => []] 
        );

        // Create a new log entry
        $newLog = [
            'log_date' => $request->date,
            'log_header' => $request->title,
            'log_detail' => $request->details,
            'created_date' => Carbon::now()->toDateTimeString(),
        ];

        // Append the new log to the log array
        $log = $studentLog->log;
        $log[] = $newLog;
        $studentLog->log = $log;
        $studentLog->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function update(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'details' => 'required|string',
        ]);

        $studentLog = StudentLog::where('student_id', auth()->user()->student_id)->first();

        if ($studentLog) {
            $logs = collect($studentLog->log)->toArray(); // Convert the Collection to an array
            $logIndex = array_search($request->date, array_column($logs, 'log_date'));

            if ($logIndex !== false) {
                $logs[$logIndex]['log_header'] = $request->title;
                $logs[$logIndex]['log_detail'] = $request->details;
                $studentLog->log = $logs; // Assign the modified array back to the model
                $studentLog->save();
            }
        }

        return redirect()->back()->with('success', 'แก้ไขข้อมูลสำเร็จ');
    }

    public function show($student_id)
    {
        $user = auth()->user();

        // Allow Teacher and Mentor roles to access without matching student_id
        if ($user->role === 'Teacher' || $user->role === 'Mentor') {
            $locations = Location::where(function ($query) use ($student_id) {
                $query->where('student_id1', $student_id)
                      ->orWhere('student_id2', $student_id)
                      ->orWhere('student_id3', $student_id)
                      ->orWhere('student_id4', $student_id);
            })->first();

            $student_log = StudentLog::whereIn('student_id', Location::all()->flatMap(function ($location) {
                return [
                    $location->student_id1,
                    $location->student_id2,
                    $location->student_id3,
                    $location->student_id4,
                ];
            })->filter()->unique())->where('student_id', $student_id)->get();

            return view('student.log', compact('locations', 'student_log'));
        }

        // Default behavior for Student role
        if ($user->student_id != $student_id) {
            abort(403, 'Unauthorized access');
        }

        $locations = Location::where(function ($query) use ($student_id) {
            $query->where('student_id1', $student_id)
                  ->orWhere('student_id2', $student_id)
                  ->orWhere('student_id3', $student_id)
                  ->orWhere('student_id4', $student_id);
        })->first();

        $student_log = StudentLog::whereIn('student_id', Location::all()->flatMap(function ($location) {
            return [
                $location->student_id1,
                $location->student_id2,
                $location->student_id3,
                $location->student_id4,
            ];
        })->filter()->unique())->where('student_id', $student_id)->get();

        return view('student.log', compact('locations', 'student_log'));
    }
}
