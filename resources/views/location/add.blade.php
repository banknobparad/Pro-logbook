@extends('layouts.app')

@section('title')
    Subject
@endsection

@section('activeUsers')
    active border-2 border-bottom border-primary
@endsection

@section('content')
    <div class="container mt-3">
        <h2>ฟอร์มกรอกข้อมูลสถานที่ฝึกงาน</h2>

        <form action="{{ route('location.store') }}" method="POST">
            @csrf

            <!-- ชื่อสถานที่ฝึกงาน -->
            <div class="form-group">
                <label for="name">ชื่อสถานที่ฝึกงาน</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <h5 class="m-3 text-center">กรอกรหัสนักศึกษาที่ฝึกงาน</h5>

            <!-- รหัสนักศึกษาคนที่ 1 และ 2 -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="student_id1">รหัสนักศึกษาคนที่ 1</label>
                        <input type="text" class="form-control" id="student_id1" name="student_id1" maxlength="10"
                            required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="student_id2">รหัสนักศึกษาคนที่ 2</label>
                        <input type="text" class="form-control" id="student_id2" name="student_id2" maxlength="10"
                            required>
                    </div>
                </div>
            </div>

            <!-- รหัสนักศึกษาคนที่ 3 และ 4 -->
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="student_id3">รหัสนักศึกษาคนที่ 3</label>
                        <input type="text" class="form-control" id="student_id3" name="student_id3" maxlength="10">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="student_id4">รหัสนักศึกษาคนที่ 4</label>
                        <input type="text" class="form-control" id="student_id4" name="student_id4" maxlength="10">
                    </div>
                </div>
            </div>

            <!-- ปุ่มบันทึกข้อมูล -->
            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "สำเร็จ!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "ตกลง"
                });
            });
        </script>
    @endif
@endsection
