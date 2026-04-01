@extends('dashboard.layout')
@section('title', 'Overview')
@section('breadcrumb', 'Overview')

@section('content')

<div class="dash-page-header">
    <div>
        <h1 class="dash-page-title">Overview</h1>
        <p class="dash-page-sub">Manage your portfolio content from here.</p>
    </div>
</div>

{{-- Flash message --}}
@if(session('success'))
    <div class="dash-flash dash-flash--success">✓ {{ session('success') }}</div>
@endif

{{-- Stats --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card__icon">◫</div>
        <div class="stat-card__body">
            <strong class="stat-card__num">{{ $projectCount }}</strong>
            <span class="stat-card__label">Projects</span>
        </div>
        <a href="{{ route('dashboard.projects') }}" class="stat-card__link">Manage →</a>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon">⬡</div>
        <div class="stat-card__body">
            <strong class="stat-card__num">{{ $skillCount }}</strong>
            <span class="stat-card__label">Skills</span>
        </div>
        <a href="{{ route('dashboard.skills') }}" class="stat-card__link">Manage →</a>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon">◉</div>
        <div class="stat-card__body">
            <strong class="stat-card__num">1</strong>
            <span class="stat-card__label">About Page</span>
        </div>
        <a href="{{ route('dashboard.about') }}" class="stat-card__link">Edit →</a>
    </div>
</div>

<div class="dash-section-title">Quick Actions</div>
<div class="quick-actions">
    <a href="{{ route('dashboard.projects') }}" class="quick-card">
        <div class="quick-card__icon">◫</div>
        <div class="quick-card__text"><strong>Add Project</strong><span>Showcase new work</span></div>
        <span class="quick-card__arrow">→</span>
    </a>
    <a href="{{ route('dashboard.skills') }}" class="quick-card">
        <div class="quick-card__icon">⬡</div>
        <div class="quick-card__text"><strong>Edit Skills</strong><span>Update your expertise</span></div>
        <span class="quick-card__arrow">→</span>
    </a>
    <a href="{{ route('dashboard.about') }}" class="quick-card">
        <div class="quick-card__icon">◉</div>
        <div class="quick-card__text"><strong>Edit About</strong><span>Update your bio</span></div>
        <span class="quick-card__arrow">→</span>
    </a>
</div>

@endsection
