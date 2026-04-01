{{-- ============================================================
     WORKFLOW — Step-by-step process timeline
     ============================================================ --}}
<section class="workflow section-reveal" id="workflow">
    <div class="container">

        <div class="section-label">
            <span class="section-label__num"></span>
            <span class="section-label__text">Process</span>
        </div>

        <h2 class="section-title">
            How I<br>
            <em>work.</em>
        </h2>

        {{-- Process steps --}}
        <div class="workflow__steps">

            @php
            $steps = [
                [
                    'num'   => '01',
                    'title' => 'Planning',
                    'desc'  => 'Deep discovery of requirements, technical constraints, and business goals. Scoping the architecture before touching a keyboard.',
                    'icon'  => '◎',
                ],
                [
                    'num'   => '02',
                    'title' => 'Design',
                    'desc'  => 'Wireframes, system design, and UI decisions. Establishing a visual language and technical blueprint that guides every decision downstream.',
                    'icon'  => '◈',
                ],
                [
                    'num'   => '03',
                    'title' => 'Development',
                    'desc'  => 'Clean, documented, iterative code delivery. Feature branches, code reviews, and regular client check-ins keep everything on track.',
                    'icon'  => '⟨⟩',
                ],
                [
                    'num'   => '04',
                    'title' => 'Testing',
                    'desc'  => 'Automated tests, QA, and performance audits. Nothing ships until it is battle-tested across devices and load scenarios.',
                    'icon'  => '⊕',
                ],
                [
                    'num'   => '05',
                    'title' => 'Deployment',
                    'desc'  => 'CI/CD pipelines, zero-downtime releases, monitoring setup, and post-launch support to ensure a smooth go-live.',
                    'icon'  => '⟳',
                ],
            ];
            @endphp

            {{-- Connecting line --}}
            <div class="workflow__line" aria-hidden="true"></div>

            @foreach($steps as $index => $step)
            <div class="workflow__step" style="--delay: {{ $index * 120 }}ms">
                <div class="workflow__step-num" aria-hidden="true">
                    <span>{{ $step['num'] }}</span>
                </div>
                <div class="workflow__step-body">
                    <div class="workflow__step-icon" aria-hidden="true">{{ $step['icon'] }}</div>
                    <h3 class="workflow__step-title">{{ $step['title'] }}</h3>
                    <p class="workflow__step-desc">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
