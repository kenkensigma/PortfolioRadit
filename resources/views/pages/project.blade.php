@extends('layouts.app')
@section('title', $project['title'] . ' — Shiro Dev')

@section('extra_css')
    <link rel="stylesheet" href="{{ asset('css/project-detail.css') }}">
@endsection

@section('content')

{{-- ── BACK BUTTON ─────────────────────────────────────────── --}}
<div class="project-detail-back">
    <div class="container">
        <a href="{{ route('home') }}#projects" class="back-link">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                <path d="M13 8H3M7 4L3 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Back to Projects
        </a>
    </div>
</div>

{{-- ── HERO ─────────────────────────────────────────────────── --}}
<section class="pd-hero" style="--accent: {{ $project['accent'] }}; --bg: {{ $project['color'] }}">
    <div class="pd-hero__bg" aria-hidden="true">
        <div class="pd-hero__grid"></div>
        <div class="pd-hero__glow"></div>
        <div class="pd-hero__pattern"></div>
    </div>

    <div class="container">
        <div class="pd-hero__inner">
            <div class="pd-hero__meta">
                <span class="pd-hero__num">{{ $project['num'] }}</span>
                <span class="pd-hero__type">{{ $project['type'] }}</span>
            </div>

            <h1 class="pd-hero__title">{{ $project['title'] }}</h1>
            <p class="pd-hero__desc">{{ $project['desc'] }}</p>

            <div class="pd-hero__actions">
                @if(!empty($project['url']))
                    <a href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer" class="btn btn--outline">
                        <span>Live Demo</span>
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M2 12L12 2M12 2H6M12 2v6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </a>
                @endif
                @if(!empty($project['github']))
                    <a href="{{ $project['github'] }}" target="_blank" rel="noopener noreferrer" class="btn btn--ghost">
                        <span>GitHub</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ── MAIN CONTENT ─────────────────────────────────────────── --}}
<div class="pd-body">
    <div class="container">
        <div class="pd-grid">

            {{-- LEFT ─────────────────────────────────────────── --}}
            <div class="pd-main">

                {{-- Overview --}}
                <div class="pd-section">
                    <div class="pd-section__label">Overview</div>
                    <div class="pd-section__content">
                        @foreach($project['overview'] as $para)
                            <p class="pd-para">{{ $para }}</p>
                        @endforeach
                    </div>
                </div>

                {{-- Screenshots --}}
                @if(!empty($project['images']))
                <div class="pd-section">
                    <div class="pd-section__label">Screenshots</div>
                    <div class="pd-section__content">
                        <div class="pd-gallery">
                            @foreach($project['images'] as $i => $image)
                            @php
                                $isExternal = str_starts_with($image['src'], 'http');
                                $exists     = $isExternal || file_exists(public_path($image['src']));
                                $fullSrc    = $isExternal ? $image['src'] : asset($image['src']);
                            @endphp

                            <div class="pd-gallery__item {{ $i === 0 ? 'pd-gallery__item--featured' : '' }}
                                        {{ $exists ? 'pd-gallery__item--clickable' : '' }}"
                                 @if($exists) onclick="openLightbox('{{ $fullSrc }}', '{{ addslashes($image['caption']) }}')" @endif>

                                <div class="pd-gallery__img-wrap">
                                    @if($exists)
                                        <img src="{{ $fullSrc }}"
                                             alt="{{ $image['caption'] }}"
                                             loading="lazy">
                                        <div class="pd-gallery__overlay">
                                            <span>⊕ View</span>
                                        </div>
                                    @else
                                        <div class="pd-gallery__placeholder">
                                            <span>{{ $i + 1 }}</span>
                                            <p>{{ $image['caption'] }}</p>
                                        </div>
                                    @endif
                                </div>
                                <p class="pd-gallery__caption">{{ $image['caption'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- Features --}}
                @if(!empty($project['features']))
                <div class="pd-section">
                    <div class="pd-section__label">Key Features</div>
                    <div class="pd-section__content">
                        <ul class="pd-features">
                            @foreach($project['features'] as $feature)
                            <li class="pd-feature">
                                <span class="pd-feature__dot" style="background: {{ $project['accent'] }}"></span>
                                <div>
                                    <strong>{{ $feature['title'] }}</strong>
                                    <p>{{ $feature['desc'] }}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                {{-- Challenges --}}
                @if(!empty($project['challenges']))
                <div class="pd-section">
                    <div class="pd-section__label">Challenges & Solutions</div>
                    <div class="pd-section__content">
                        @foreach($project['challenges'] as $item)
                        <div class="pd-challenge">
                            <div class="pd-challenge__q">
                                <span class="pd-challenge__icon">⊗</span>
                                <strong>{{ $item['challenge'] }}</strong>
                            </div>
                            <div class="pd-challenge__a">
                                <span class="pd-challenge__icon pd-challenge__icon--solved">⊕</span>
                                <p>{{ $item['solution'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            {{-- RIGHT SIDEBAR ────────────────────────────────── --}}
            <aside class="pd-sidebar">

                {{-- Tech Stack --}}
                <div class="pd-card">
                    <div class="pd-card__header">
                        <span class="pd-card__icon">⟨⟩</span>
                        Tech Stack
                    </div>
                    <div class="pd-card__body">
                        @foreach($project['tech'] as $category => $items)
                        <div class="pd-tech-group">
                            <p class="pd-tech-group__label">{{ $category }}</p>
                            <div class="pd-tech-group__items">
                                @foreach($items as $item)
                                <span class="pd-tech-tag" style="--accent: {{ $project['accent'] }}">{{ $item }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Project Info --}}
                <div class="pd-card">
                    <div class="pd-card__header">
                        <span class="pd-card__icon">◉</span>
                        Project Info
                    </div>
                    <div class="pd-card__body">
                        @foreach($project['info'] as $label => $value)
                        <div class="pd-info-row">
                            <span class="pd-info-row__label">{{ $label }}</span>
                            <span class="pd-info-row__value">{{ $value }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Links --}}
                @if(!empty($project['url']) || !empty($project['github']))
                <div class="pd-card">
                    <div class="pd-card__header">
                        <span class="pd-card__icon">↗</span>
                        Links
                    </div>
                    <div class="pd-card__body" style="gap:8px;display:flex;flex-direction:column">
                        @if(!empty($project['url']))
                        <a href="{{ $project['url'] }}" target="_blank" class="pd-link-btn">
                            Live Demo <span>↗</span>
                        </a>
                        @endif
                        @if(!empty($project['github']))
                        <a href="{{ $project['github'] }}" target="_blank" class="pd-link-btn pd-link-btn--ghost">
                            GitHub <span>↗</span>
                        </a>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Next project --}}
                @if(!empty($project['next']))
                <a href="{{ route('project.show', $project['next']['slug']) }}" class="pd-next-card">
                    <span class="pd-next-card__label">Next Project</span>
                    <span class="pd-next-card__title">{{ $project['next']['title'] }}</span>
                    <span class="pd-next-card__arrow">→</span>
                </a>
                @endif

            </aside>
        </div>
    </div>
</div>

{{-- ── LIGHTBOX ─────────────────────────────────────────────── --}}
<div class="lightbox" id="lightbox">
    <button class="lightbox__close" id="lightboxClose">✕</button>
    <div class="lightbox__inner">
        <img class="lightbox__img" id="lightboxImg" src="" alt="">
        <p class="lightbox__caption" id="lightboxCaption"></p>
    </div>
</div>

<script>
function openLightbox(src, caption) {
    const lb  = document.getElementById('lightbox');
    const img = document.getElementById('lightboxImg');
    const cap = document.getElementById('lightboxCaption');

    img.src             = src;
    cap.textContent     = caption;
    lb.style.display    = 'flex';
    document.body.style.overflow = 'hidden';

    // Trigger transition after display:flex is applied
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            lb.classList.add('open');
        });
    });
}

function closeLightbox() {
    const lb = document.getElementById('lightbox');
    lb.classList.remove('open');
    document.body.style.overflow = '';
    setTimeout(() => {
        lb.style.display = 'none';
        document.getElementById('lightboxImg').src = '';
    }, 300);
}

// Close on backdrop click
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) closeLightbox();
});

// Close button
document.getElementById('lightboxClose').addEventListener('click', closeLightbox);

// Escape key
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeLightbox();
});
</script>

@endsection