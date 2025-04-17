@extends('layouts.app')
@section('title', 'Subject')

@section('activeUsers')
    active border-2 border-bottom border-primary
@endsection

@section('content')
    <style>
        #usersTable thead th,
        #usersTable tbody td {
            text-align: center;
            vertical-align: middle;
        }
    </style>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center w-100 m-0">จัดการบทบาทผู้ใช้</h1>
            @php
                $notificationUsers = $confirm->where('req', 2);
                $notificationCount = $notificationUsers->count();
            @endphp

            <div class="position-relative dropdown">
                <button class="btn btn-light position-relative dropdown-toggle" type="button" id="notificationDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell fa-lg"></i>
                    @if ($notificationCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $notificationCount }}
                        </span>
                    @endif
                </button>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown" style="width: 300px;">
                    <li class="dropdown-header">การแจ้งเตือน</li>
                    @if ($notificationCount > 0)
                        @foreach ($notificationUsers as $confirmItem)
                            @php
                                $user = $users->firstWhere('id', $confirmItem->user_id); // 🔍 หา user ตาม user_id
                                $userLocation = $location->firstWhere('id', $confirmItem->location_id); // 🔍 หา location
                                $userLocationName = $userLocation ? $userLocation->name : 'ไม่พบข้อมูลสถานที่';
                            @endphp

                            @if ($user)
                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#userModal" data-user_id="{{ $user->id }}"
                                        data-name="{{ $user->name }}" data-student_id="{{ $user->student_id }}"
                                        data-branch="{{ $user->branch }}" data-year="{{ $user->year }}"
                                        data-location="{{ $userLocationName }}">
                                        {{ $user->name }} ขอการอนุมัติ
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @else
                        <li><span class="dropdown-item text-muted">ไม่มีการแจ้งเตือน</span></li>
                    @endif
                </ul>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="approveForm" method="POST" action="{{ route('approve.mentor') }}">
                        @csrf
                        <input type="hidden" name="user_id" id="modalUserId">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">รายละเอียดผู้ใช้</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>ชื่อ:</strong> <span id="modalUserName"></span></p>
                                <p><strong>รหัสนักศึกษา:</strong> <span id="modalStudentId"></span></p>
                                <p><strong>สาขา:</strong> <span id="modalBranch"></span></p>
                                <p><strong>ชั้นปี:</strong> <span id="modalYear"></span></p>
                                <p><strong>สถานที่ฝึก:</strong> <span id="modalLocation"></span></p> {{-- ✅ แสดง location --}}
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">อนุมัติ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ตารางผู้ใช้ -->
        <div class="table-responsive">
            <table id="usersTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ชื่อ-นามสกุล</th>
                        <th>รหัสนักศึกษา</th>
                        <th>ชั้นปี</th>
                        <th>สาขาวิชา</th>
                        <th>บทบาท</th>
                        <th>เปลี่ยนบทบาท</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->student_id }}</td>
                            <td>{{ $user->year }}</td>
                            <td>{{ $user->branch }}</td>
                            <td><span class="badge bg-primary">{{ $user->role }}</span></td>
                            <td>
                                <button class="btn btn-sm btn-warning changeRoleBtn" data-id="{{ $user->id }}"
                                    data-role="{{ $user->role }}">
                                    เปลี่ยนบทบาท
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal เปลี่ยนบทบาท -->
    <div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เปลี่ยนบทบาทผู้ใช้</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="roleForm">
                        @csrf
                        <input type="hidden" id="userId">
                        <label for="roleSelect">เลือกบทบาท:</label>
                        <select id="roleSelect" class="form-control">
                            <option value="Administrator">Administrator</option>
                            <option value="Teacher">Teacher</option>
                            <option value="Student">Student</option>
                            <option value="Mentor">Mentor</option>
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-primary" id="saveRoleBtn">บันทึก</button>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                responsive: true
            });

            $('.changeRoleBtn').click(function() {
                let userId = $(this).data('id');
                let currentRole = $(this).data('role');
                let userName = $(this).closest('tr').find('td:first').text();
                $('#userId').val(userId);
                $('#roleSelect').val(currentRole);
                $('#roleModal').modal('show');
                $('#roleModal').data('userName', userName);
            });

            $('#saveRoleBtn').click(function() {
                let userId = $('#userId').val();
                let newRole = $('#roleSelect').val();
                let userName = $('#roleModal').data('userName');

                $.ajax({
                    url: "{{ route('users.updateRole') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        userId: userId,
                        role: newRole
                    },
                    success: function(response) {
                        $('#roleModal').modal('hide');

                        Swal.fire({
                            title: 'เปลี่ยนบทบาทสำเร็จ!',
                            text: `${userName} ถูกเปลี่ยนเป็น ${newRole} สำเร็จ!`,
                            icon: 'success',
                            confirmButtonText: 'ตกลง'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'เกิดข้อผิดพลาด!',
                            text: 'ไม่สามารถเปลี่ยนบทบาทได้',
                            icon: 'error',
                            confirmButtonText: 'ตกลง'
                        });
                    }
                });
            });
        });

        // ✅ เพิ่มการอ่านค่าชื่อสถานที่ฝึก
        const userModal = document.getElementById('userModal');
        userModal.addEventListener('show.bs.modal', function(event) {
            const triggerLink = event.relatedTarget;
            document.getElementById('modalUserId').value = triggerLink.getAttribute('data-user_id');
            document.getElementById('modalUserName').textContent = triggerLink.getAttribute('data-name');
            document.getElementById('modalStudentId').textContent = triggerLink.getAttribute('data-student_id');
            document.getElementById('modalBranch').textContent = triggerLink.getAttribute('data-branch');
            document.getElementById('modalYear').textContent = triggerLink.getAttribute('data-year');
            document.getElementById('modalLocation').textContent = triggerLink.getAttribute('data-location'); // ✅
        });
    </script>
@endsection
@endsection
