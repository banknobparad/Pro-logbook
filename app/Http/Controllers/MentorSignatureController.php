<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentLog;

class MentorSignatureController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'log_date' => 'required|date',
            'signature' => 'required|boolean',
        ]);

        $studentLog = StudentLog::where('student_id', $request->student_id)->first();

        if ($studentLog) {
            $logs = collect($studentLog->log);
            $logs = $logs->map(function ($log) use ($request) {
                if ($log['log_date'] === $request->log_date) {
                    $log['signature'] = $request->signature ? 'yes' : 'no';
                }
                return $log;
            });

            $studentLog->log = $logs->toArray();
            $studentLog->save();

            return back()->with('success', 'ลายเซ็นต์พี่เลี้ยงถูกอัปเดตเรียบร้อยแล้ว');
        }

        return back()->with('error', 'ไม่พบข้อมูลบันทึก');
    }
}
