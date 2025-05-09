<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    {{-- pusher --}}
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anuphan&family=Bai+Jamjuree:wght@400&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Anuphan', sans-serif !important;
            /*font-family: 'Bai Jamjuree', sans-serif !important;*/

        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


</head>

<body data-bs-theme="dark">
    <div id="app">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            {{-- @else
                            @if (Auth::user()->role == 'Administrator')
                                <li class="nav-item">
                                    <a class="nav-link  @yield('activeHome')"
                                        href="{{ route('home') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  @yield('activeUsers')"
                                        href="{{ route('user.index') }}">{{ __('Users') }}</a>
                                </li>
                            @endif

                            @if (Auth::user()->role == 'Teacher')
                                <li class="nav-item">
                                    <a class="nav-link  @yield('activeSubject')" href=" ">{{ __('Subject') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  @yield('activeAttendance')" href=" ">{{ __('Attendance') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  @yield('activeReport')" href=" ">{{ __('Report') }}</a>
                                </li>
                            @endif

                            @if (Auth::user()->role == 'Student')
                                <li class="nav-item">
                                    <a class="nav-link  @yield('activeStudent')"
                                        href=" ">{{ __('ประวัติการเช็คชื่อ') }}</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest --}}
                        @else
                            <!-- สำหรับ Administrator -->
                            @if (Auth::user()->role == 'Administrator')
                                <li class="nav-item">
                                    <a class="nav-link  @yield('activeHome')" href=" ">{{ __('Home') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  @yield('activeUsers')"
                                        href="{{ route('user.index') }}">{{ __('Users') }}</a>
                                </li>
                                {{-- <li class="nav-item">
                                <a class="nav-link  @yield('activeReport')" href=" ">{{ __('Report') }}</a>
                            </li> --}}
                            @endif

                            <!-- สำหรับ Teacher -->
                            @if (Auth::user()->role == 'Teacher')
                                <li class="nav-item">
                                    <a class="nav-link  @yield('activeSubject')"
                                        href="{{ route('location.index') }}">{{ __('สถานที่') }}</a>
                                </li>
                            @endif

                            <!-- สำหรับ Student -->
                            @if (Auth::user()->role == 'Student')
                                <li class="nav-item">
                                    <a class="nav-link  @yield('activeStudent')"
                                        href=" {{ route('student.index') }}">{{ __('หน้าแรก') }}</a>
                                </li>
                            @endif

                            <!-- สำหรับ Mentor -->
                            @if (Auth::user()->role == 'Mentor')
                                <li class="nav-item">
                                    <a class="nav-link  @yield('activeStudent')" href=" ">{{ __('พี่เลี้ยง') }}</a>
                                </li>
                            @endif

                            <!-- เมนู "เปลี่ยนบทบาท" สำหรับทุก role -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('req') }}">{{ __('ลงทะเบียนพี่เลี้ยง') }}</a>
                            </li>

                            <!-- เมนู Logout -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- ajax --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <!-- DataTables Responsive JS -->
    <script src="https://cdn.datatables.net/responsive/3.0.1/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.1/js/responsive.bootstrap5.js"></script>

    <!-- Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @yield('scripts')

</body>

</html>
