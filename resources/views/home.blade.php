@extends('layouts.app')

@section('title')
    Subject
@endsection

@section('activeUsers')
    active border-2 border-bottom border-primary
@endsection

@section('welcome')
    @if(Auth::check())
        <h1 class="fw-bold">ยินดีต้อนรับ {{ Auth::user()->name }}</h1>
        <p class="mt-3">สมุดบันทึกดิจิทัลสำหรับการฝึกประสบการณ์วิชาชีพของนักศึกษาปริญญาตรี</p>
        <p class="text-muted">Digital Logbook for Undergraduate Internship</p>
    @else
        <h1 class="fw-bold">ยินดีต้อนรับ</h1>
        <p class="mt-3">กรุณาลงทะเบียน หรือ เข้าสู่ระบบ เพื่อเข้าใช้งานสมุดบันทึกดิจิทัลสำหรับการฝึกประสบการณ์วิชาชีพของนักศึกษาปริญญาตรี</p>
    @endif
@endsection

@section('content')
    {{-- Add additional content for the home page here --}}
@endsection

@section('scripts')
@endsection
