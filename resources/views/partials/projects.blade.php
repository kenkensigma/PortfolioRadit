{{-- ============================================================
     PROJECTS — Portfolio grid with tilt & glow interactions
     ============================================================ --}}
<section class="projects section-reveal" id="projects">
    <div class="container">

        <div class="section-label">
            <span class="section-label__text">Selected Work</span>
        </div>

        <div class="projects__header">
            <h2 class="section-title">
                Products I've<br>
                <em>shipped.</em>
            </h2>
            <a href="#contact" class="btn btn--outline btn--sm">Start a project</a>
        </div>

        @php
            $projects = [
                [
                    'num' => '01',
                    'slug' => 'imaji-digital',
                    'title' => 'IMAJI DIGITAL',
                    'type' => 'Digital Agency Landing Page',
                    'desc' =>
                        'A Landing page for a digital agency, showcasing their services, contact form and highlighting their product with AR Mode and 3D models.',
                    'stack' => ['Laravel', 'MySQL', 'AR.js', 'Tailwind CSS'],
                    'color' => '#050a0e',
                    'accent' => '#22c55e',
                ],
                [
                    'num' => '02',
                    'slug' => 'oop-school',
                    'title' => 'OOP WEB API',
                    'type' => 'SaaS REST API',
                    'desc' =>
                        'A multi-tenant SaaS API platform with Laravel Sanctum authentication, rate limiting, webhooks, and developer-friendly documentation.',
                    'stack' => ['Laravel', 'MySQL', 'Sanctum', 'Swagger/OpenAPI'],
                    'color' => '#0a1520',
                    'accent' => '#22d3ee',
                ],
                [
                    'num' => '03',
                    'slug' => 'noja-garage',
                    'title' => 'Noja Garage',
                    'type' => 'Product Catalog Website',
                    'desc' =>
                        'A Laravel-based car promotional website with MySQL database, TailwindCSS frontend, and simple admin dashboard for managing car listings.',
                    'stack' => ['Laravel', 'MySQL', 'TailwindCSS'],
                    'color' => '#0a1a0f',
                    'accent' => '#4ade80',
                ],
                [
                    'num' => '04',
                    'slug' => 'ZBooks',
                    'title' => 'ZBooks SMK',
                    'type' => 'Digital Library Management',
                    'desc' =>
                        'A full-featured digital library management system built with Laravel 12, MySQL, and Bootstrap 5.',
                    'stack' => ['Laravel', 'MySQL', 'Bootstrap'],
                    'color' => '#0f1117',
                    'accent' => '#7c6ff7',
                ],
                [
                    'num' => '05',
                    'slug' => 'bible-bake',
                    'title' => 'Bible-Bake Website',
                    'type' => 'E-commerce Website',
                    'desc' =>
                        'A modern, aesthetic landing page for a bakery brand featuring interactive UI, animated elements, and a simple shopping cart experience.',
                    'stack' => ['Laravel', 'MySQL'],
                    'color' => '#1a1200',
                    'accent' => '#f472b6',
                ],
                [
                    'num' => '06',
                    'slug' => 'house-of-burger',
                    'title' => 'House of Burger',
                    'type' => 'Food Delivery Website',
                    'desc' => 'A responsive food delivery website for a burger chain, featuring a modern design and seamless ordering experience.',
                    'stack' => ['Laravel', 'MySQL'],
                    'color' => '#100a1a',
                    'accent' => '#a78bfa',
                ],
            ];
        @endphp

        <div class="projects__grid">
            @foreach ($projects as $index => $project)
                <div class="project-card {{ $index === 0 ? 'project-card--featured' : '' }}"
                    style="--accent: {{ $project['accent'] }}; --bg: {{ $project['color'] }}; --delay: {{ $index * 100 }}ms"
                    data-tilt>

                    <div class="project-card__visual">
                        <div class="project-card__visual-bg">
                            <div class="project-card__visual-pattern" aria-hidden="true"></div>
                            <div class="project-card__visual-accent" aria-hidden="true"></div>
                        </div>
                        <span class="project-card__num" aria-hidden="true">{{ $project['num'] }}</span>
                        <span class="project-card__type">{{ $project['type'] }}</span>
                    </div>

                    <div class="project-card__body">
                        <h3 class="project-card__title">{{ $project['title'] }}</h3>
                        <p class="project-card__desc">{{ $project['desc'] }}</p>

                        <div class="project-card__stack">
                            @foreach ($project['stack'] as $tech)
                                <span class="project-card__tech">{{ $tech }}</span>
                            @endforeach
                        </div>

                        <div class="project-card__footer">
                            <a href="{{ route('project.show', $project['slug']) }}" class="project-card__link"
                                aria-label="View {{ $project['title'] }} project">
                                View Project
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    aria-hidden="true">
                                    <path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="project-card__glow" aria-hidden="true"></div>
                </div>
            @endforeach
        </div>
    </div>
</section>
