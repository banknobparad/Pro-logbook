@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">รายการบันทึกประจำวัน</h1>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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

        @if(auth()->user()->role === 'Student')
            <div class="d-flex justify-content-between mb-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLogModal">เพิ่มบันทึก</button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editLogModal">แก้ไขบันทึก</button>
            </div>
        @endif

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

        <!-- Edit Log Modal -->
        <div class="modal fade" id="editLogModal" tabindex="-1" aria-labelledby="editLogModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('student.log.update') }}" method="POST" id="editLogForm">
                        @csrf
                        @method('PUT') 
                        <div class="modal-header">
                            <h5 class="modal-title" id="editLogModalLabel">แก้ไขบันทึก</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="editLogDate" class="form-label">เลือกวันที่</label>
                                <select class="form-select" id="editLogDate" name="date" required>
                                    @php
                                        $logs = collect($student_log->where('student_id', auth()->user()->student_id)->first()->log ?? [])->sortBy('log_date');
                                    @endphp
                                    @foreach($logs as $log)
                                        <option value="{{ $log['log_date'] }}">{{ \Carbon\Carbon::parse($log['log_date'])->format('d/m/Y') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editLogTitle" class="form-label">หัวข้อ</label>
                                <input type="text" class="form-control" id="editLogTitle" name="title" placeholder="หัวข้อบันทึก">
                            </div>
                            <div class="mb-3">
                                <label for="editLogDetails" class="form-label">รายละเอียด</label>
                                <textarea class="form-control" id="editLogDetails" name="details" rows="3" placeholder="รายละเอียดบันทึก"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @php
            $logs = collect($student_log->where('student_id', auth()->user()->student_id)->first()->log ?? [])->sortBy('log_date');
        @endphp

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
                @forelse($logs as $log)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($log['log_date'])->format('d/m/Y') }}</td>
                    <td>{{ $log['log_header'] }}</td>
                    <td>{{ $log['log_detail'] }}</td>
                    @if(auth()->user()->role === 'Teacher' || auth()->user()->role === 'Mentor')
                    <td>{{ \Carbon\Carbon::parse($log['created_date'])->format('d/m/Y') }}</td>
                    @endif
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-sm viewTeacherComments" data-bs-toggle="modal" data-bs-target="#teacherCommentsModal">
                            <i class="bi bi-eye"></i> 
                            @if(auth()->user()->role === 'Teacher')
                                เพิ่มความคิดเห็น
                            @else
                                ดูความคิดเห็น
                            @endif
                        </button>
                        <input type="hidden" value="{{ json_encode($log['t_comments'] ?? []) }}">
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-sm viewMentorComments" data-bs-toggle="modal" data-bs-target="#mentorCommentsModal">
                            <i class="bi bi-eye"></i> 
                            @if(auth()->user()->role === 'Mentor')
                                เพิ่มความคิดเห็น
                            @else
                                ดูความคิดเห็น
                            @endif
                        </button>
                        <input type="hidden" value="{{ json_encode($log['m_comments'] ?? []) }}">
                    </td>
                    <td>
                        <form action="{{ route('mentor.signature.update', $log['id'] ?? '') }}" method="POST">
                            @csrf
                            @if(auth()->user()->role === 'Mentor')
                                <input type="checkbox" name="signature" value="1" onchange="this.form.submit()" {{ $log['signature'] ?? false ? 'checked' : '' }}>
                            @else
                                <input type="checkbox" disabled {{ $log['signature'] ?? false ? 'checked' : '' }}>
                            @endif
                        </form>
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
    <!-- Teacher Comments Modal -->
<div class="modal fade" id="teacherCommentsModal" tabindex="-1" aria-labelledby="teacherCommentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('teacher.comment.update') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="teacherCommentsModalLabel">ความเห็นจากอาจารย์</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" id="modalTeacherComments" name="teacher_comments" rows="5" {{ auth()->user()->role === 'Teacher' ? '' : 'readonly' }}></textarea>
                </div>
                @if(auth()->user()->role === 'Teacher')
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
    <!-- Mentor Comments Modal -->
<div class="modal fade" id="mentorCommentsModal" tabindex="-1" aria-labelledby="mentorCommentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('mentor.comment.update') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="mentorCommentsModalLabel">ความเห็นจากพี่เลี้ยง</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" id="modalMentorComments" name="mentor_comments" rows="5" {{ auth()->user()->role === 'Mentor' ? '' : 'readonly' }}></textarea>
                </div>
                @if(auth()->user()->role === 'Mentor')
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logs = @json($logs->toArray()); 
        const editLogDate = document.getElementById('editLogDate');
        const editLogTitle = document.getElementById('editLogTitle');
        const editLogDetails = document.getElementById('editLogDetails');
        const editLogForm = document.getElementById('editLogForm');

        editLogDate.addEventListener('change', function () {
            const selectedDate = this.value;
            const log = logs.find(log => log.log_date === selectedDate);
            if (log) {
                editLogTitle.value = log.log_header;
                editLogDetails.value = log.log_detail;
            }
        });

        editLogForm.addEventListener('submit', function (event) {
            const selectedDate = editLogDate.value;
            const log = logs.find(log => log.log_date === selectedDate);

            if (log) {
                if (!editLogTitle.value.trim() || editLogTitle.value.trim() === log.log_header) {
                    editLogTitle.value = log.log_header;
                }
                if (!editLogDetails.value.trim() || editLogDetails.value.trim() === log.log_detail) {
                    editLogDetails.value = log.log_detail;
                }
            }
        });

        // Trigger change event to populate fields for the first option
        editLogDate.dispatchEvent(new Event('change'));
    });
</script>
@endsection
