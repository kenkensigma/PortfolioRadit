{{-- ============================================================
     DASHBOARD TOPBAR
     ============================================================ --}}
<header class="dash-topbar">
    <div class="dash-topbar__left">
        <button class="dash-topbar__toggle" id="sidebarToggle" aria-label="Toggle sidebar">
            <span></span><span></span><span></span>
        </button>
        <div class="dash-topbar__breadcrumb">
            <span>Dashboard</span>
            @hasSection('breadcrumb')
                <span class="dash-topbar__sep">›</span>
                <span class="dash-topbar__current">@yield('breadcrumb')</span>
            @endif
        </div>
    </div>
    <div class="dash-topbar__right">
        <a href="{{ route('home') }}" target="_blank" class="dash-topbar__preview">
            <span>Preview Site</span>
            <span>↗</span>
        </a>
        <div class="dash-topbar__avatar">S</div>
    </div>
</header>
