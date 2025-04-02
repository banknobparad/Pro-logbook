@extends('layouts.app')

@section('title', '403 Forbidden')

@section('content')
    <div class="container text-center mt-5">
        <img src="{{ asset('images/error-outline.svg') }}" width="230" height="230" class="d-inline-block align-top"
            alt="">
        <h1 class="display-4 text-danger">403</h1>
        <h2 class="mb-4">Forbidden</h2>
        <p class="lead">คุณไม่ได้รับอนุญาตให้เข้าถึงหน้านี้</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">กลับหน้าหลัก</a>
    </div>
@endsection
