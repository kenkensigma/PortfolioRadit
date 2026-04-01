{{-- ============================================================
     NAVBAR — Floating minimal navbar with blur on scroll
     ============================================================ --}}
<nav class="navbar" id="navbar">
    <div class="navbar__inner">

        {{-- Brand --}}
        <a href="#home" class="navbar__brand" aria-label="Shiro Dev home">
            <span class="navbar__brand-text">Raditya<span class="navbar__brand-dot"></span>Putra</span>
        </a>

        {{-- Desktop navigation links --}}
        <ul class="navbar__links" role="list">
            <li><a href="#home"     class="navbar__link" data-section="home">Home</a></li>
            <li><a href="#about"    class="navbar__link" data-section="about">About</a></li>
            <li><a href="#skills"   class="navbar__link" data-section="skills">Skills</a></li>
            <li><a href="#projects" class="navbar__link" data-section="projects">Projects</a></li>
            <li><a href="#contact"  class="navbar__link navbar__link--cta" data-section="contact">Contact</a></li>
        </ul>

        {{-- Mobile hamburger --}}
        <button class="navbar__hamburger" id="hamburger" aria-label="Toggle menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    {{-- Mobile menu overlay --}}
    <div class="navbar__mobile" id="mobileMenu">
        <ul role="list">
            <li><a href="#home"     class="navbar__mobile-link">Home</a></li>
            <li><a href="#about"    class="navbar__mobile-link">About</a></li>
            <li><a href="#projects" class="navbar__mobile-link">Projects</a></li>
            <li><a href="#skills"   class="navbar__mobile-link">Skills</a></li>
            <li><a href="#contact"  class="navbar__mobile-link">Contact</a></li>
        </ul>
    </div>
</nav>
