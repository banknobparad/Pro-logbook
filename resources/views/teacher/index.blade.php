@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">ตรวจสอบบันทึกประจำวัน</h1>
    <p class="text-center">หน้านี้สำหรับอาจารย์และพี่เลี้ยงในการตรวจสอบบันทึกประจำวันของนักเรียน</p>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>รหัสนักศึกษา</th>
                <th>ชื่อ</th>
                <th>อีเมล</th>
                <th>การดำเนินการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                @if($student->student_id)
                <tr>
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        <a href="{{ url('student/log/' . $student->student_id) }}" class="btn btn-primary">ดูบันทึก</a>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
