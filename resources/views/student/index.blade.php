{{-- @extends('layouts.app')

@section('title')
    Subject
@endsection

@section('activeUsers')
    active border-2 border-bottom border-primary
@endsection

@section('content')
    <div class="container mt-4">
        @if ($location)
            <h2 class="display-4 mb-4">ชื่อที่ฝึกงาน {{ $location->name ?? '-' }}</h2>
            <hr>
            <div class="card mb-4 shadow-sm border-2 p-4">

                <!-- แถวแรก: ข้อมูลของคุณ (ขวาว่าง) -->
                <div class="row">
                    <div class="col-md-4 "></div>
                    <div class="col-md-3 mb-4">
                        <h2 class="mb-3 text-center">ข้อมูลของคุณ <i class="fa-regular fa-user"></i></h2>
                        <hr>

                    </div>
                    <div class="col-md-4 "></div>
                </div>

                <!-- แถวที่สอง: ซ้ายชื่อ ขวาสาขา -->
                <div class="row fs-5">
                    <div class="col-md-4 ">
                        <p><strong>ชื่อ:</strong> {{ $user->name }}</p>
                    </div>
                    <div class="col-md-4 ">
                        <p><strong>รหัสนักศึกษา:</strong> {{ $user->student_id }}</p>
                    </div>
                    <div class="col-md-4 ">
                        <p><strong>รหัสนักศึกษา:</strong> {{ $user->student_id }}</p>
                    </div>

                    <div class="col-md-4 ">
                        <p><strong>ชั้นปี:</strong> {{ $user->year }}</p>

                    </div>
                    <div class="col-md-4 ">
                        <p><strong>สาขา:</strong> {{ $user->branch }}</p>
                    </div>
                    <div class="col-md-4 ">
                        <p><strong>เบอร์ติดต่อ:</strong> {{ $user->phone_number }}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="alert
                        alert-warning">
                ยังไม่พบสถานที่ฝึกงานของคุณในระบบ
            </div>
        @endif
    </div>
@endsection --}}

@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('activeUsers')
    active border-2 border-bottom border-primary
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <div class="row">
                <!-- Profile Picture -->
                <div class="col-md-3 text-center">
                    <img src="https://picsum.photos/id/1/200/300" class=" img-fluid mb-3" alt="User Profile">
                    <h5 class="mt-2">ชื่อผู้ใช้</h5>
                    <p class="text-muted">รหัสนักศึกษา: <strong>65123456</strong></p>
                </div>

                <!-- Main Info -->
                <div class="col-md-9">
                    <h4>ข้อมูลนักศึกษา</h4>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>ชื่อ-นามสกุล:</strong> นาย นพรัตน์ ธนสารศิริกุล</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>รหัสนักศึกษา:</strong> 6314631017</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>ชื่อ-นามสกุล:</strong> นาย นพรัตน์ ธนสารศิริกุล</p>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                    <div class="col-md-9">
                        <h5 class="mb-3">ข้อมูลส่วนตัว</h5>
                        <div class="row">
                            <p><strong>เบอร์โทร:</strong> 098-123-4567</p>
                            <p><strong>Email:</strong> student@example.com</p>
                            <p><strong>ที่อยู่:</strong> 123/4 หมู่ 5 ต.ทดสอบ อ.เมือง จ.การฝึกงาน</p>
                        </div>
                        <!-- Friends Section -->
                        <div class="mt-4">
                            <h6 class="text-muted">เพื่อนที่ฝึกงานด้วยกัน</h6>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="card shadow-sm" style="width: 10rem;">
                                    <div class="card-body text-center p-2">
                                        <p class="card-text mb-0">เพื่อน A</p>
                                        <small class="text-muted">IT ปี 3</small>
                                    </div>
                                </div>
                                <div class="card shadow-sm" style="width: 10rem;">
                                    <div class="card-body text-center p-2">
                                        <p class="card-text mb-0">เพื่อน B</p>
                                        <small class="text-muted">IT ปี 3</small>
                                    </div>
                                </div>
                                <!-- เพิ่มเพื่อนเพิ่มได้ที่นี่ -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
