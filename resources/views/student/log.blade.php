@extends('layouts.app')

@section('content')
<div class="container">
    <h1>บันทึกประจำวัน</h1>
    <form action="{{ route('student.log.store') }}" method="POST" id="logForm">
        @csrf
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="studentName" class="form-label">ชื่อ-นามสกุล</label>
                <input type="text" class="form-control" id="studentName" name="student_name" value="{{ auth()->user()->name }}" readonly>
            </div>
            <div class="col-md-2">
                <label for="studentId" class="form-label">รหัสนักศึกษา</label>
                <input type="text" class="form-control" id="studentId" name="student_id" value="{{ auth()->user()->student_id }}" readonly>
            </div>
            <div class="col-md-3">
                <label for="advisorName" class="form-label">ชื่ออาจารย์นิเทศก์</label>
                <input type="text" class="form-control" id="advisorName" name="advisor_name" value="{{ $locations->advisor_name ?? 'ไม่พบข้อมูล' }}" readonly>
            </div>
            <div class="col-md-2">
                <label for="supervisionType" class="form-label">ประเภทของการนิเทศ</label>
                <input type="text" class="form-control" id="supervisionType" name="supervision_type" value="{{ $locations->supervision_type ?? 'ไม่พบข้อมูล' }}" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="locationName" class="form-label">ชื่อสถานที่ฝึกงาน</label>
                <input type="text" class="form-control" id="locationName" name="location_name" value="{{ $locations->name ?? 'ไม่พบข้อมูล' }}" readonly>
            </div>
            <div class="col-md-2">
                <label for="term" class="form-label">เทอมการศึกษา</label>
                <input type="text" class="form-control" id="term" name="term" value="{{ $locations->term ?? 'ไม่พบข้อมูล' }}" readonly>
            </div>
            <div class="col-md-3">
                <label for="mentorName" class="form-label">ชื่อพี่เลี้ยง</label>
                <input type="text" class="form-control" id="mentorName" name="mentor_name" value="{{ $locations->mentor_name ?? 'ไม่พบข้อมูล' }}" readonly>
            </div>
        </div>
        <table class="table" id="logEntries">
            <thead>
                <tr>
                    <th><center>วันที่</center></th>
                    <th><center>หัวข้อ</center></th>
                    <th><center>รายละเอียด</center></th>
                    <th></th>
                    <th><center>วันที่สร้าง</center></th>
                    <th><center>ความเห็นจากอาจารย์</center></th>
                    <th><center>ความเห็นจากพี่เลี้ยง</center></th>
                    <th><center>ลายเซ็นต์พี่เลี้ยง</center></th>
                </tr>
            </thead>
            <tbody>
                <tr class="log-entry">
                    <td>
                        <input type="date" class="form-control" name="date[]">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="title[]" placeholder="หัวข้อบันทึก">
                    </td>
                    <td>
                        <textarea class="form-control" name="details[]" rows="3" placeholder="รายละเอียดบันทึก"></textarea>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger removeEntry">ลบ</button>
                    </td>
                    <td>
                        <input type="hidden" class="form-control" name="created_at[]" value="{{ now()->format('Y-m-d') }}">
                        <span>{{ now()->format('d/m/Y') }}</span>
                    </td>
                    <td>
                        @if(auth()->user()->role === 'Teacher')
                        <textarea class="form-control" name="teacher_comments[]" rows="2" placeholder="ความเห็นจากอาจารย์"></textarea>
                        @else
                        <textarea class="form-control" name="teacher_comments[]" rows="2" placeholder="ความเห็นจากอาจารย์" readonly></textarea>
                        @endif
                    </td>
                    <td>
                        @if(auth()->user()->role === 'Mentor')
                        <textarea class="form-control" name="mentor_comments[]" rows="2" placeholder="ความเห็นจากพี่เลี้ยง"></textarea>
                        @else
                        <textarea class="form-control" name="mentor_comments[]" rows="2" placeholder="ความเห็นจากพี่เลี้ยง" readonly></textarea>
                        @endif
                    </td>
                    <td>
                        @if(auth()->user()->role === 'Mentor')
                        <input type="text" class="form-control" name="mentor_signature[]" placeholder="ลายเซ็นต์พี่เลี้ยง">
                        @else
                        <input type="text" class="form-control" name="mentor_signature[]" placeholder="ลายเซ็นต์พี่เลี้ยง" readonly>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-secondary" id="addEntry">เพิ่มช่อง</button>

        <button type="submit" class="btn btn-primary">บันทึก</button>
    </form>
</div>

<div style="display: none;">
    <script>
        document.getElementById('addEntry').addEventListener('click', function() {
            const logEntries = document.querySelector('#logEntries tbody');
            const newRow = document.createElement('tr');
            newRow.classList.add('log-entry');
            const now = new Date();
            const formattedDate = now.toLocaleDateString('th-TH', { day: '2-digit', month: '2-digit', year: 'numeric' });
            newRow.innerHTML = `
                <td>
                    <input type="date" class="form-control" name="date[]">
                </td>
                <td>
                    <input type="text" class="form-control" name="title[]" placeholder="หัวข้อบันทึก">
                </td>
                <td>
                    <textarea class="form-control" name="details[]" rows="3" placeholder="รายละเอียดบันทึก"></textarea>
                </td>
                <td>
                    <button type="button" class="btn btn-danger removeEntry">ลบ</button>
                </td>
                <td>
                    <input type="hidden" name="created_at[]" value="${now.toISOString().slice(0, 10)}">
                    <span>${formattedDate}</span>
                </td>
                <td>
                    <textarea class="form-control" name="teacher_comments[]" rows="2" placeholder="ความเห็นจากอาจารย์" readonly></textarea>
                </td>
                <td>
                    <textarea class="form-control" name="mentor_comments[]" rows="2" placeholder="ความเห็นจากพี่เลี้ยง" readonly></textarea>
                </td>
                <td>
                    <input type="text" class="form-control" name="mentor_signature[]" placeholder="ลายเซ็นต์พี่เลี้ยง" readonly>
                </td>
            `;
            logEntries.appendChild(newRow);
        });

        document.getElementById('logEntries').addEventListener('click', function(e) {
            if (e.target.classList.contains('removeEntry')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
</div>
@endsection
