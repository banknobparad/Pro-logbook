@extends('layouts.app')

    @section('title')
        Subject
    @endsection

    @section('activeUsers')
        active border-2 border-bottom border-primary
    @endsection

    @section('content')
        <div class="container py-4">
            <!-- ปุ่มเพิ่มสถานที่ฝึกงาน และ ช่องค้นหา และลงทะเบียนที่ปรึกษา -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <!-- Search Bar -->
                <form action="{{ route('location.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" style="width: 300px;" placeholder="ค้นหาสถานที่ฝึกงานหรือภาคการศึกษา" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> ค้นหา
                    </button>
                </form>

                <!-- Buttons on the right -->
                <div>
                    <!-- Register as Advisor Button -->
                    <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#registerAdvisorModal">
                        <i class="fas fa-user-plus me-1"></i> ลงทะเบียนที่ปรึกษา
                    </button>

                    <!-- Add Location Button -->
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLocationModal">
                        <i class="fas fa-plus-circle me-1"></i> เพิ่มสถานที่ฝึกงาน
                    </button>
                </div>
            </div>

            <div class="row">
                @foreach ($locations as $location)
                    @if (empty(request('search')) || stripos($location->name . ' ' . $location->term_year, request('search')) !== false)
                    <div class="col-md-5 mb-4">
                        <div class="card border-0 shadow-lg h-100 hover-shadow">
                            <div class="card-body">
                                <!-- ชื่อสถานที่ -->
                                <h3 class="card-title mb-3 text-primary">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $location->name }} {{ $location->term_year }}
                                </h3>
                                <hr>
                                <!-- รายชื่อนักศึกษาฝึกงาน -->
                                <h6 class="text-muted mb-2">รายชื่อนักศึกษาฝึกงาน</h6>
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                @if ($location->student_id1)
                                                    <i class="fa-solid fa-graduation-cap me-1"></i>
                                                    {{ $location->student_id1 }}
                                                    @if (!empty($students[$location->student_id1]->name))
                                                        - {{ $students[$location->student_id1]->name }}
                                                    @endif
                                                @else
                                                    <i class="fa-solid fa-minus me-1 text-muted"></i>
                                                @endif
                                            </li>
                                            <li class="list-group-item">
                                                @if ($location->student_id2)
                                                    <i class="fa-solid fa-graduation-cap me-1"></i>
                                                    {{ $location->student_id2 }}
                                                    @if (!empty($students[$location->student_id2]->name))
                                                        - {{ $students[$location->student_id2]->name }}
                                                    @endif
                                                @else
                                                    <i class="fa-solid fa-minus me-2 text-muted"></i>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-12">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                @if ($location->student_id3)
                                                    <i class="fa-solid fa-graduation-cap me-1"></i>
                                                    {{ $location->student_id3 }}
                                                    @if (!empty($students[$location->student_id3]->name))
                                                        - {{ $students[$location->student_id3]->name }}
                                                    @endif
                                                @else
                                                    <i class="fa-solid fa-minus me-1 text-muted"></i>
                                                @endif
                                            </li>
                                            <li class="list-group-item">
                                                @if ($location->student_id4)
                                                    <i class="fa-solid fa-graduation-cap me-1"></i>
                                                    {{ $location->student_id4 }}
                                                    @if (!empty($students[$location->student_id4]->name))
                                                        - {{ $students[$location->student_id4]->name }}
                                                    @endif
                                                @else
                                                    <i class="fa-solid fa-minus me-1 text-muted"></i>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- รายชื่อพี่เลี้ยง -->
                                <h6 class="text-muted mt-4 mb-2">รายชื่อพี่เลี้ยง</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        @if ($location->mentor_id1 && !empty($mentors[$location->mentor_id1]->name))
                                            <i class="fa-solid fa-user-tie me-2"></i>
                                            {{ $mentors[$location->mentor_id1]->name }}
                                        @else
                                            <i class="fa-solid fa-minus me-2 text-muted"></i>
                                        @endif
                                    </li>
                                    <li class="list-group-item">
                                        @if ($location->mentor_id2 && !empty($mentors[$location->mentor_id2]->name))
                                            <i class="fa-solid fa-user-tie me-2"></i>
                                            {{ $mentors[$location->mentor_id2]->name }}
                                        @else
                                            <i class="fa-solid fa-minus me-2 text-muted"></i>
                                        @endif
                                    </li>
                                    <li class="list-group-item">
                                        @if ($location->mentor_id3 && !empty($mentors[$location->mentor_id3]->name))
                                            <i class="fa-solid fa-user-tie me-2"></i>
                                            {{ $mentors[$location->mentor_id3]->name }}
                                        @else
                                            <i class="fa-solid fa-minus me-2 text-muted"></i>
                                        @endif
                                    </li>
                                </ul>

                                <!-- รายชื่อที่ปรึกษา -->
                                <h6 class="text-muted mt-4 mb-2">รายชื่อที่ปรึกษา</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        @if ($location->teacher_id && !empty($teachers[$location->teacher_id]->name))
                                            <i class="fa-solid fa-chalkboard-teacher me-2"></i>
                                            {{ $teachers[$location->teacher_id]->name }}
                                        @else
                                            <i class="fa-solid fa-minus me-2 text-muted"></i>
                                        @endif
                                    </li>
                                </ul>

                            </div>

                            <!-- ปุ่มแก้ไขสถานที่ฝึกงาน -->
                            <div class="card-footer text-end border-0 bg-light-mode">
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editLocationModal-{{ $location->id }}">
                                    <i class="fas fa-edit me-1"></i> แก้ไขสถานที่ฝึกงาน
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach

                <!-- Modal แก้ไขสถานที่ฝึกงาน -->
                @foreach ($locations as $location)
                <div class="modal fade" id="editLocationModal-{{ $location->id }}" tabindex="-1" aria-labelledby="editLocationModalLabel-{{ $location->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('location.update', $location->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="editLocationModalLabel-{{ $location->id }}">แก้ไขสถานที่ฝึกงาน</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <!-- ชื่อสถานที่ฝึกงาน -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">ชื่อสถานที่ฝึกงาน</label>
                                        <input type="text" class="form-control" name="name" value="{{ $location->name }}" required>
                                    </div>

                                    <!-- ภาคการศึกษา -->
                                    <div class="mb-3">
                                        <label for="term_year" class="form-label">ภาคการศึกษา</label>
                                        <input type="text" class="form-control" name="term_year" value="{{ $location->term_year }}" required>
                                    </div>

                                    <!-- รหัสนักศึกษา -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="student_id1" class="form-label">รหัสนักศึกษาคนที่ 1</label>
                                            <input type="text" class="form-control" name="student_id1" value="{{ $location->student_id1 }}" maxlength="10">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="student_id2" class="form-label">รหัสนักศึกษาคนที่ 2</label>
                                            <input type="text" class="form-control" name="student_id2" value="{{ $location->student_id2 }}" maxlength="10">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="student_id3" class="form-label">รหัสนักศึกษาคนที่ 3</label>
                                            <input type="text" class="form-control" name="student_id3" value="{{ $location->student_id3 }}" maxlength="10">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="student_id4" class="form-label">รหัสนักศึกษาคนที่ 4</label>
                                            <input type="text" class="form-control" name="student_id4" value="{{ $location->student_id4 }}" maxlength="10">
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer bg-light-mode">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

        <!-- Modal เพิ่มสถานที่ฝึกงาน -->
        <div class="modal fade" id="addLocationModal" tabindex="-1" aria-labelledby="addLocationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('location.store') }}" method="POST">
                        @csrf
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addLocationModalLabel">เพิ่มสถานที่ฝึกงาน</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <!-- ชื่อสถานที่ฝึกงาน -->
                            <div class="mb-3">
                                <label for="name" class="form-label">ชื่อสถานที่ฝึกงาน</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <!-- ภาคการศึกษา -->
                            <div class="mb-3">
                                <label for="term_year" class="form-label">ภาคการศึกษา</label>
                                <input type="text" class="form-control" name="term_year" required>
                            </div>

                            <!-- รหัสนักศึกษา -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="student_id1" class="form-label">รหัสนักศึกษาคนที่ 1</label>
                                    <input type="text" class="form-control" name="student_id1" maxlength="10" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="student_id2" class="form-label">รหัสนักศึกษาคนที่ 2</label>
                                    <input type="text" class="form-control" name="student_id2" maxlength="10" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="student_id3" class="form-label">รหัสนักศึกษาคนที่ 3</label>
                                    <input type="text" class="form-control" name="student_id3" maxlength="10">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="student_id4" class="form-label">รหัสนักศึกษาคนที่ 4</label>
                                    <input type="text" class="form-control" name="student_id4" maxlength="10">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer bg-light-mode">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal ลงทะเบียนที่ปรึกษา -->
        <div class="modal fade" id="registerAdvisorModal" tabindex="-1" aria-labelledby="registerAdvisorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('location.registerAdvisor') }}" method="POST">
                        @csrf
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="registerAdvisorModalLabel">ลงทะเบียนที่ปรึกษา</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <!-- เลือกสถานที่ฝึกงาน -->
                            <div class="mb-3">
                                <label for="location_id" class="form-label">เลือกสถานที่ฝึกงาน</label>
                                <select class="form-select" name="location_id" required>
                                    <option value="" disabled selected>กรุณาเลือกสถานที่ฝึกงาน</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }} - {{ $location->term_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer bg-light-mode">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-warning">ลงทะเบียน</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'สำเร็จ!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'ตกลง'
                    });
                });
            </script>
        @endif
    @endsection

    <style>
        .hover-shadow:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease-in-out;
        }

        .bg-light-mode {
            background-color: var(--bs-light);
        }

        .bg-light-mode[data-theme="dark"] {
            background-color: var(--bs-dark);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const root = document.documentElement;
            const theme = localStorage.getItem('theme') || 'light';
            root.setAttribute('data-theme', theme);

            // Update theme dynamically if toggled
            document.querySelectorAll('[data-theme-toggle]').forEach(toggle => {
                toggle.addEventListener('click', function () {
                    const newTheme = root.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
                    root.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                });
            });
        });
    </script>
