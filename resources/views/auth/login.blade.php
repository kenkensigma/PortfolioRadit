<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login — Shiro Dev</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Syne:wght@400;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

    {{-- Background grid --}}
    <div class="auth-grid-bg" aria-hidden="true"></div>

    {{-- Ambient glow --}}
    <div class="auth-glow" aria-hidden="true"></div>

    <div class="auth-wrap">

        {{-- Left panel: brand --}}
        <div class="auth-left">
            <a href="{{ route('home') }}" class="auth-brand">
                Shiro<span>.</span>Dev
            </a>
            <div class="auth-left__content">
                <p class="auth-left__label">Admin Panel</p>
                <h1 class="auth-left__title">
                    Manage<br>your<br><em>portfolio.</em>
                </h1>
                <p class="auth-left__sub">
                    Sign in to manage projects,<br>
                    skills, and your about page.
                </p>
            </div>
            <p class="auth-left__foot">© {{ date('Y') }} Shiro Dev</p>
        </div>

        {{-- Right panel: form --}}
        <div class="auth-right">
            <div class="auth-card">

                <div class="auth-card__header">
                    <div class="auth-card__icon" aria-hidden="true">⊕</div>
                    <h2 class="auth-card__title">Welcome back</h2>
                    <p class="auth-card__sub">Sign in to your admin account</p>
                </div>

                {{-- Error message --}}
                @if ($errors->any())
                    <div class="auth-alert" role="alert">
                        <span class="auth-alert__icon">⚠</span>
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('status'))
                    <div class="auth-alert auth-alert--success" role="alert">
                        <span class="auth-alert__icon">✓</span>
                        {{ session('status') }}
                    </div>
                @endif

                <form class="auth-form" method="POST" action="{{ route('login.submit') }}" novalidate>
                    @csrf

                    <div class="auth-field">
                        <label class="auth-field__label" for="password">Admin Password</label>
                        <div class="auth-field__wrap">
                            <input
                                class="auth-field__input @error('password') is-error @enderror"
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                autofocus
                                required
                            >
                            <button type="button" class="auth-field__toggle" id="togglePwd" aria-label="Toggle password visibility">
                                <span id="eyeIcon">◎</span>
                            </button>
                        </div>
                        <div class="auth-field__line" aria-hidden="true"></div>
                    </div>

                    <button type="submit" class="auth-submit">
                        <span>Sign In</span>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>

                <p class="auth-card__foot">
                    <a href="{{ route('home') }}">← Back to portfolio</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const toggleBtn = document.getElementById('togglePwd');
        const pwdInput  = document.getElementById('password');
        const eyeIcon   = document.getElementById('eyeIcon');

        toggleBtn?.addEventListener('click', () => {
            const isText = pwdInput.type === 'text';
            pwdInput.type = isText ? 'password' : 'text';
            eyeIcon.textContent = isText ? '◎' : '◉';
        });

        // Submit loading state
        document.querySelector('.auth-form')?.addEventListener('submit', function () {
            const btn  = this.querySelector('.auth-submit');
            const span = btn.querySelector('span');
            btn.disabled   = true;
            span.textContent = 'Signing in…';
            btn.style.opacity = '0.7';
        });
    </script>
</body>
</html>
