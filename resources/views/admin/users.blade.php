@extends('layouts.app')
@section('title')
    Subject
@endsection

@section('activeUsers')
    active border-2 border-bottom border-primary
@endsection

@section('content')
    <style>
        #usersTable thead th,
        #usersTable tbody td {
            text-align: center;
            /* จัดข้อความทุกช่องให้อยู่ตรงกลาง */
            vertical-align: middle;
            /* จัดแนวกลางแนวตั้งด้วย */
        }
    </style>

    <div class="container">
        <h1 class="mb-4 text-center text-bold">จัดการบทบาทผู้ใช้</h1>
        <table id="usersTable" class="table table-striped">
            <thead class="text-center">
                <tr>
                    <th>ชื่อ-นามสกุล</th>
                    <th>รหัสนักศึกษา</th>
                    <th>ชั้นปี</th>
                    <th>สาขาวิชา</th>
                    <th>บทบาท</th>
                    <th>เปลี่ยนบทบาท</th>
                </tr>
            </thead>
            <tbody class="text-center">
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

    <!-- ใช้งาน DataTables & JavaScript -->
    {{-- @section('scripts')
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable();

            $('.changeRoleBtn').click(function() {
                let userId = $(this).data('id');
                let currentRole = $(this).data('role');
                $('#userId').val(userId);
                $('#roleSelect').val(currentRole);
                $('#roleModal').modal('show');
            });

            $('#saveRoleBtn').click(function() {
                let userId = $('#userId').val();
                let newRole = $('#roleSelect').val();

                $.ajax({
                    url: "{{ route('users.updateRole') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        userId: userId,
                        role: newRole
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('เกิดข้อผิดพลาด');
                    }
                });
            });
        });
    </script>
@endsection --}}

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable();

            $('.changeRoleBtn').click(function() {
                let userId = $(this).data('id');
                let currentRole = $(this).data('role');
                let userName = $(this).closest('tr').find('td:first').text(); // ดึงชื่อผู้ใช้
                $('#userId').val(userId);
                $('#roleSelect').val(currentRole);
                $('#roleModal').modal('show');
                $('#roleModal').data('userName', userName); // เก็บชื่อไว้ใน modal
            });

            $('#saveRoleBtn').click(function() {
                let userId = $('#userId').val();
                let newRole = $('#roleSelect').val();
                let userName = $('#roleModal').data('userName'); // ดึงชื่อจาก modal

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

                        // แสดง SweetAlert แจ้งการเปลี่ยนแปลง
                        Swal.fire({
                            title: 'เปลี่ยนบทบาทสำเร็จ!',
                            text: `${userName} ถูกเปลี่ยนเป็น ${newRole} สำเร็จ!`,
                            icon: 'success',
                            confirmButtonText: 'ตกลง'
                        }).then(() => {
                            location.reload(); // รีเฟรชหน้าเว็บเมื่อกดตกลง
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
    </script>
@endsection

@endsection
