{{-- ============================================================
     SKILLS — Expertise grid with animated cards
     ============================================================ --}}
<section class="skills section-reveal" id="skills">
    <div class="container">

        <div class="section-label">
            <span class="section-label__num"></span>
            <span class="section-label__text">Expertise</span>
        </div>

        <div class="skills__header">
            <h2 class="section-title">
                Technologies &<br>
                <em>Capabilities</em>
            </h2>
            <p class="skills__intro">
                A curated set of tools and disciplines I've sharpened<br>
                across years of real-world project delivery.
            </p>
        </div>

        {{-- Skills grid --}}
        <div class="skills__grid">

            @php
            $skills = [
                [
                    'icon'  => '⬡',
                    'title' => 'Backend Development',
                    'desc'  => 'Building performant, scalable server-side systems with PHP, Laravel, Node.js, and RESTful architecture.',
                    'tags'  => ['PHP', 'Laravel', 'Node.js'],
                ],
                [
                    'icon'  => '◫',
                    'title' => 'Frontend Development',
                    'desc'  => 'Crafting responsive, interactive UIs using vanilla JS, modern CSS, and component-driven patterns.',
                    'tags'  => ['HTML', 'CSS', 'JavaScript'],
                ],
                [
                    'icon'  => '⊕',
                    'title' => 'REST API Development',
                    'desc'  => 'Designing clean, versioned APIs with proper authentication, rate limiting, and documentation.',
                    'tags'  => ['REST', 'OAuth', 'JSON'],
                ],
                [
                    'icon'  => '⊞',
                    'title' => 'Database Architecture',
                    'desc'  => 'Schema design, query optimisation, and data modelling for relational and document stores.',
                    'tags'  => ['MySQL', 'PostgreSQL', 'Redis'],
                ],
                [
                    'icon'  => '◈',
                    'title' => 'UI Implementation',
                    'desc'  => 'Translating high-fidelity designs into pixel-perfect, accessible, and animated interfaces.',
                    'tags'  => ['Figma → Code', 'A11y', 'Animation'],
                ],
                [
                    'icon'  => '⊗',
                    'title' => 'DevOps & Deployment',
                    'desc'  => 'CI/CD pipelines, Docker containerisation, Linux server management, and cloud deployments.',
                    'tags'  => ['Docker', 'Linux', 'CI/CD'],
                ],
            ];
            @endphp

            @foreach($skills as $index => $skill)
            <div class="skill-card" style="--delay: {{ $index * 80 }}ms">
                <div class="skill-card__inner">
                    <div class="skill-card__icon" aria-hidden="true">{{ $skill['icon'] }}</div>
                    <h3 class="skill-card__title">{{ $skill['title'] }}</h3>
                    <p class="skill-card__desc">{{ $skill['desc'] }}</p>
                    <div class="skill-card__tags">
                        @foreach($skill['tags'] as $tag)
                            <span class="skill-card__tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
                {{-- Hover glow --}}
                <div class="skill-card__glow" aria-hidden="true"></div>
            </div>
            @endforeach
        </div>

        {{-- Marquee tech strip --}}
        <div class="skills__marquee" aria-hidden="true">
            <div class="skills__marquee-track">
                @php
                $techs = ['PHP', 'Laravel', 'JavaScript', 'MySQL', 'PostgreSQL', 'Redis', 'Docker', 'Linux', 'REST API', 'Git', 'CSS', 'HTML5', 'Node.js', 'Vue.js'];
                @endphp
                @foreach(array_merge($techs, $techs) as $tech)
                    <span class="skills__marquee-item">{{ $tech }}<span class="skills__marquee-sep">·</span></span>
                @endforeach
            </div>
        </div>

    </div>
</section>
