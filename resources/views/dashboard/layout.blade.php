<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Shiro Dev</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

    {{-- Sidebar --}}
    @include('dashboard.partials.sidebar')

    {{-- Main area --}}
    <div class="dash-main" id="dashMain">

        {{-- Top bar --}}
        @include('dashboard.partials.topbar')

        {{-- Page content --}}
        <main class="dash-content">
            @yield('content')
        </main>
    </div>

    {{-- Global modal backdrop --}}
    <div class="modal-backdrop" id="modalBackdrop"></div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
