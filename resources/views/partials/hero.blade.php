{{-- ============================================================
     HERO — Cinematic full-viewport hero with abstract visual
     ============================================================ --}}
<section class="hero" id="home">

    {{-- Animated grid background --}}
    <div class="hero__grid-bg" aria-hidden="true"></div>

    {{-- Floating orbs for depth --}}
    <div class="hero__orb hero__orb--1" aria-hidden="true"></div>
    <div class="hero__orb hero__orb--2" aria-hidden="true"></div>

    <div class="hero__container">

        {{-- LEFT: Text content --}}
        <div class="hero__content">

            <p class="hero__eyebrow reveal-char">
                <span class="hero__eyebrow-line"></span>
                Hello, I'm
            </p>

            <h1 class="hero__title">
                <span class="hero__title-line hero__title-line--name reveal-up" data-delay="0">
                    <span class="name-hover">Raditya Putra</span>
                </span>
                <span class="hero__title-line hero__title-line--role reveal-up" data-delay="100">
                    Backend
                    <em>Developer</em>
                </span>
            </h1>

            <p class="hero__subtitle reveal-up" data-delay="250">
                I design and build modern web applications,<br>
                APIs, and digital products.
            </p>

            <div class="hero__actions reveal-up" data-delay="380">
                <a href="#projects" class="btn btn--outline">
                    <span>View Projects</span>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <a href="#contact" class="btn btn--ghost">
                    <span>Contact Me</span>
                </a>
            </div>

            {{-- Scroll indicator --}}
            <div class="hero__scroll reveal-up" data-delay="500" aria-hidden="true">
                <div class="hero__scroll-line"></div>
                <span>Scroll</span>
            </div>
        </div>

        {{-- RIGHT: Abstract developer visual --}}
        <div class="hero__visual" aria-hidden="true">
            <div class="hero__sphere-wrapper">

                {{-- Outer ring --}}
                <div class="hero__ring hero__ring--1"></div>
                <div class="hero__ring hero__ring--2"></div>
                <div class="hero__ring hero__ring--3"></div>

                {{-- Core glowing sphere --}}
                <div class="hero__sphere">
                    <div class="hero__sphere-core"></div>
                    <div class="hero__sphere-glow"></div>

                    {{-- Floating code snippets --}}
                    <div class="hero__code-tag hero__code-tag--1">
                        <span class="tag-bracket">&lt;</span>dev<span class="tag-bracket">/&gt;</span>
                    </div>
                    <div class="hero__code-tag hero__code-tag--2">
                        <span class="tag-func">fn</span>() { }
                    </div>
                    <div class="hero__code-tag hero__code-tag--3">
                        <span class="tag-var">$</span>build
                    </div>
                    <div class="hero__code-tag hero__code-tag--4">
                        0x1F
                    </div>
                </div>

                {{-- Orbiting dots --}}
                <div class="hero__orbit hero__orbit--1">
                    <div class="hero__orbit-dot"></div>
                </div>
                <div class="hero__orbit hero__orbit--2">
                    <div class="hero__orbit-dot"></div>
                </div>
            </div>

            {{-- Stats floating around sphere --}}
            <div class="hero__stat hero__stat--1">
                <strong>5+</strong>
                <span>Years Exp.</span>
            </div>
            <div class="hero__stat hero__stat--2">
                <strong>40+</strong>
                <span>Projects</span>
            </div>
        </div>
    </div>
</section>
