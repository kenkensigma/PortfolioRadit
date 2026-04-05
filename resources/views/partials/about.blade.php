{{-- ============================================================
     ABOUT — Two-column layout with text and image
     ============================================================ --}}
<section class="about section-reveal" id="about">
    <div class="container">

        {{-- Section label --}}
        <div class="section-label">
            <span class="section-label__num"></span>
            <span class="section-label__text">About Me</span>
        </div>

        <div class="about__grid">

            {{-- Left: Text content --}}
            <div class="about__text">
                <h2 class="about__title section-title">
                    Crafting digital<br>
                    <em>experiences</em> with<br>
                    precision.
                </h2>

                <p class="about__body">
                    I am a passionate full stack developer who focuses on building scalable systems,
                    modern web applications, and clean user experiences. My work sits at the intersection
                    of engineering and design — I care as much about how something looks as how it runs.
                </p>

                <p class="about__body">
                    I enjoy working on complex problems and transforming ideas into powerful digital products.
                    Whether it's architecting a robust backend API or crafting a pixel-perfect interface,
                    I bring the same level of intentionality to every layer of the stack.
                </p>

                {{-- Key values --}}
                <ul class="about__values" role="list">
                    <li class="about__value">
                        <div class="about__value-icon" aria-hidden="true">⟳</div>
                        <div>
                            <strong>Iterative Thinking</strong>
                            <p>Continuous improvement in every build cycle.</p>
                        </div>
                    </li>
                    <li class="about__value">
                        <div class="about__value-icon" aria-hidden="true">◈</div>
                        <div>
                            <strong>Systems Design</strong>
                            <p>Architecture that scales without compromise.</p>
                        </div>
                    </li>
                    <li class="about__value">
                        <div class="about__value-icon" aria-hidden="true">◉</div>
                        <div>
                            <strong>Clean Code</strong>
                            <p>Readable, maintainable, intentional.</p>
                        </div>
                    </li>
                </ul>
            </div>

            {{-- Right: Image / visual --}}
            <div class="about__visual">
                <div class="about__image-frame">
                    <div class="about__image-placeholder">
                        {{-- Abstract developer portrait placeholder --}}
                        <img src="{{ asset('images/profile.jpeg') }}" alt="Raditya Putra"
                            style="width:100%;height:100%;object-fit:cover;object-position:center top;display:block;">

                        {{-- Floating tech tags --}}
                        <div class="about__tech-tag about__tech-tag--1">
                            <i class="devicon-php-plain colored"></i>
                            <span>PHP</span>
                        </div>

                        <div class="about__tech-tag about__tech-tag--2">
                            <i class="devicon-laravel-plain colored"></i>
                            <span>Laravel</span>
                        </div>

                        <div class="about__tech-tag about__tech-tag--3">
                            <i class="devicon-mysql-plain colored"></i>
                            <span>MySQL</span>
                        </div>

                        <div class="about__tech-tag about__tech-tag--4">
                            <i class="devicon-javascript-plain colored"></i>
                            <span>JS</span>
                        </div>
                    </div>

                    {{-- Corner accents --}}
                    <div class="about__frame-corner about__frame-corner--tl" aria-hidden="true"></div>
                    <div class="about__frame-corner about__frame-corner--br" aria-hidden="true"></div>
                </div>

                {{-- Experience badge --}}
                <div class="about__badge">
                    <strong class="about__badge-num">5+</strong>
                    <span class="about__badge-label">Years of<br>Experience</span>
                </div>
            </div>
        </div>
    </div>
</section>
