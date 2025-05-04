@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">รายการบันทึกประจำวัน</h1>
    <form action="{{ route('student.log.store') }}" method="POST" id="logForm">
        @csrf
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="studentName" class="form-label">ชื่อ-นามสกุล</label>
                <input type="text" class="form-control" id="studentName" name="student_name" value="{{ auth()->user()->name }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="studentId" class="form-label">รหัสนักศึกษา</label>
                <input type="text" class="form-control" id="studentId" name="student_id" value="{{ auth()->user()->student_id }}" readonly>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="advisorName" class="form-label">ชื่ออาจารย์นิเทศก์</label>
                <input type="text" class="form-control" id="advisorName" name="advisor_name" value="{{ $locations->teacher_name ?? 'ไม่พบข้อมูล' }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="mentorName" class="form-label">ชื่อพี่เลี้ยง</label>
                <input type="text" class="form-control" id="mentorName" name="mentor_name" value="{{ $locations->mentor_name ?? 'ไม่พบข้อมูล' }}" readonly>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="supervisionType" class="form-label">ประเภทของการนิเทศ</label>
                <input type="text" class="form-control" id="supervisionType" name="supervision_type" value="{{ $locations->type_supervision ?? 'ไม่พบข้อมูล' }}" readonly>
            </div>
            <div class="col-md-4">
                <label for="locationName" class="form-label">ชื่อสถานที่ฝึกงาน</label>
                <input type="text" class="form-control" id="locationName" name="location_name" value="{{ $locations->name ?? 'ไม่พบข้อมูล' }}" readonly>
            </div>
            <div class="col-md-4">
                <label for="term" class="form-label">เทอมการศึกษา</label>
                <input type="text" class="form-control" id="term" name="term" value="{{ $locations->term_year ?? 'ไม่พบข้อมูล' }}" readonly>
            </div>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLogModal">เพิ่มบันทึก</button>
        </div>

        <!-- Add Log Modal -->
        <div class="modal fade" id="addLogModal" tabindex="-1" aria-labelledby="addLogModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('student.log.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addLogModalLabel">เพิ่มบันทึก</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="logDate" class="form-label">วันที่</label>
                                <input type="date" class="form-control" id="logDate" name="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="logTitle" class="form-label">หัวข้อ</label>
                                <input type="text" class="form-control" id="logTitle" name="title" placeholder="หัวข้อบันทึก" required>
                            </div>
                            <div class="mb-3">
                                <label for="logDetails" class="form-label">รายละเอียด</label>
                                <textarea class="form-control" id="logDetails" name="details" rows="3" placeholder="รายละเอียดบันทึก" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped table-hover text-center align-middle" id="logEntries">
            <thead class="table-primary">
                <tr>
                    <th class="text-center" style="width: 10%;">วันที่</th>
                    <th class="text-center" style="width: 15%;">หัวข้อ</th>
                    <th class="text-center" style="width: 50%;">รายละเอียด</th>
                    @if(auth()->user()->role === 'Teacher' || auth()->user()->role === 'Mentor')
                    <th class="text-center" style="width: 10%;">วันที่สร้าง</th>
                    @endif
                    <th class="text-center" style="width: 10%;">ความเห็นจากอาจารย์</th>
                    <th class="text-center" style="width: 10%;">ความเห็นจากพี่เลี้ยง</th>
                    <th class="text-center" style="width: 10%;">ลายเซ็นต์พี่เลี้ยง</th>
                </tr>
            </thead>
            <tbody>
                @forelse(collect($student_log) as $log)
                <tr>
                    <td>{{ $log->log_day }}</td>
                    <td>{{ $log->log_header }}</td>
                    <td>{{ $log->log_detail }}</td>
                    @if(auth()->user()->role === 'Teacher' || auth()->user()->role === 'Mentor')
                    <td>{{ $log->created_date }}</td>
                    @endif
                    <td>
                        <!-- Teacher comments logic -->
                    </td>
                    <td>
                        <!-- Mentor comments logic -->
                    </td>
                    <td>
                        <!-- Mentor signature logic -->
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">ไม่มีข้อมูลบันทึก</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </form>
</div>

<div class="modal fade" id="teacherCommentsModal" tabindex="-1" aria-labelledby="teacherCommentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="teacherCommentsModalLabel">ความเห็นจากอาจารย์</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" id="modalTeacherComments" rows="5" readonly></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mentorCommentsModal" tabindex="-1" aria-labelledby="mentorCommentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mentorCommentsModalLabel">ความเห็นจากพี่เลี้ยง</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" id="modalMentorComments" rows="5" readonly></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.viewTeacherComments').forEach(button => {
            button.addEventListener('click', function () {
                const comments = this.nextElementSibling.value;
                document.getElementById('modalTeacherComments').value = comments;
            });
        });

        document.querySelectorAll('.viewMentorComments').forEach(button => {
            button.addEventListener('click', function () {
                const comments = this.nextElementSibling.value;
                document.getElementById('modalMentorComments').value = comments;
            });
        });
    });
</script>
@endsection
