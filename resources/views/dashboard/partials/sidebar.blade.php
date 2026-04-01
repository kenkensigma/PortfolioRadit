{{-- ============================================================
     DASHBOARD SIDEBAR
     ============================================================ --}}
<aside class="dash-sidebar" id="dashSidebar">

    {{-- Brand --}}
    <div class="sidebar-brand">
        <a href="{{ route('home') }}" class="sidebar-brand__logo">
            Shiro<span>.</span>Dev
        </a>
        <span class="sidebar-brand__badge">Admin</span>
    </div>

    {{-- Nav --}}
    <nav class="sidebar-nav">
        <p class="sidebar-nav__label">Manage</p>
        <ul>
            <li>
                <a href="{{ route('dashboard.index') }}"
                   class="sidebar-nav__link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                    <span class="sidebar-nav__icon">⊞</span>
                    Overview
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.projects') }}"
                   class="sidebar-nav__link {{ request()->routeIs('dashboard.projects*') ? 'active' : '' }}">
                    <span class="sidebar-nav__icon">◫</span>
                    Projects
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.skills') }}"
                   class="sidebar-nav__link {{ request()->routeIs('dashboard.skills*') ? 'active' : '' }}">
                    <span class="sidebar-nav__icon">⬡</span>
                    Skills
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.about') }}"
                   class="sidebar-nav__link {{ request()->routeIs('dashboard.about*') ? 'active' : '' }}">
                    <span class="sidebar-nav__icon">◉</span>
                    About
                </a>
            </li>
        </ul>

        <p class="sidebar-nav__label" style="margin-top:32px">Site</p>
        <ul>
            <li>
                <a href="{{ route('home') }}" target="_blank" class="sidebar-nav__link">
                    <span class="sidebar-nav__icon">↗</span>
                    View Portfolio
                </a>
            </li>
        </ul>
    </nav>

    {{-- Bottom: user + logout --}}
    <div class="sidebar-bottom">
        <div class="sidebar-user">
            <div class="sidebar-user__avatar">S</div>
            <div class="sidebar-user__info">
                <strong>Shiro Dev</strong>
                <span>Administrator</span>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-logout" title="Sign out">
                <span class="sidebar-nav__icon">⏻</span>
                Sign Out
            </button>
        </form>
    </div>

</aside>
