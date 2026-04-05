<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('favicon.jpg') }}" type="image/jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shiro Dev — Full Stack Developer. Designing and building modern web applications, APIs, and digital products.">
    <title>@yield('title', 'Shiro Dev — Full Stack Developer')</title>

    {{-- Google Fonts: Bebas Neue for display, Syne for headings, DM Sans for body --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

    {{-- Assets: Laravel 12 uses Vite by default.
         Option A (Vite — recommended for L12): use @vite(['resources/css/style.css','resources/js/script.js'])
         Option B (public/ folder, no build step): use asset() as below.
         This template uses Option B so no npm/Vite setup is required. --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/faq.css') }}">
    @hasSection('extra_css')
        @yield('extra_css')
    @endif
</head>
<body>

    {{-- Custom cursor glow follower --}}
    <div class="cursor-glow" id="cursorGlow"></div>
    <div class="cursor-dot" id="cursorDot"></div>

    {{-- Noise overlay for premium texture --}}
    <div class="noise-overlay"></div>

    {{-- Navigation --}}
    @include('partials.navbar')

    {{-- Main content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Main JavaScript --}}
    {{-- Anthropic API key — set ANTHROPIC_API_KEY in .env --}}
    @if(config('services.anthropic.key'))
    <script>window.ANTHROPIC_API_KEY = '{{ config('services.anthropic.key') }}';</script>
    @endif
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>