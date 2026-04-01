/* ============================================================
   SHIRO DEV — PORTFOLIO INTERACTIONS
   Vanilla JS: cursor, scroll, tilt, navbar, contact form
   ============================================================ */

'use strict';

/* ─── UTILITIES ──────────────────────────────────────────── */
const $ = (sel, ctx = document) => ctx.querySelector(sel);
const $$ = (sel, ctx = document) => [...ctx.querySelectorAll(sel)];

/* RAF-throttled event handler */
function rafThrottle(fn) {
    let rafId = null;
    return function (...args) {
        if (rafId) return;
        rafId = requestAnimationFrame(() => {
            fn.apply(this, args);
            rafId = null;
        });
    };
}

/* ─── CURSOR GLOW FOLLOWER ───────────────────────────────── */
(function initCursor() {
    const glow = $('#cursorGlow');
    const dot  = $('#cursorDot');
    if (!glow || !dot) return;

    // Smooth position tracking
    let mouseX = 0, mouseY = 0;
    let glowX  = 0, glowY  = 0;
    let dotX   = 0, dotY   = 0;

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    // Lerp for smooth glow trailing
    function lerp(a, b, t) { return a + (b - a) * t; }

    function animateCursor() {
        // Glow follows with gentle lag
        glowX = lerp(glowX, mouseX, 0.08);
        glowY = lerp(glowY, mouseY, 0.08);
        glow.style.left = glowX + 'px';
        glow.style.top  = glowY + 'px';

        // Dot follows tightly
        dotX = lerp(dotX, mouseX, 0.25);
        dotY = lerp(dotY, mouseY, 0.25);
        dot.style.left = dotX + 'px';
        dot.style.top  = dotY + 'px';

        requestAnimationFrame(animateCursor);
    }

    animateCursor();

    // Expand dot on hoverable elements
    const hoverables = 'a, button, .project-card, .skill-card, .contact__link, .btn';
    document.addEventListener('mouseover', (e) => {
        if (e.target.closest(hoverables)) {
            dot.classList.add('hovering');
        }
    });
    document.addEventListener('mouseout', (e) => {
        if (e.target.closest(hoverables)) {
            dot.classList.remove('hovering');
        }
    });

    // Hide on mouse leave
    document.addEventListener('mouseleave', () => { dot.style.opacity = '0'; glow.style.opacity = '0'; });
    document.addEventListener('mouseenter', () => { dot.style.opacity = '1'; glow.style.opacity = '1'; });
})();

/* ─── NAVBAR: SCROLL BLUR + ACTIVE SECTION ──────────────── */
(function initNavbar() {
    const navbar     = $('#navbar');
    const links      = $$('.navbar__link');
    const hamburger  = $('#hamburger');
    const mobileMenu = $('#mobileMenu');
    const mobileLinks = $$('.navbar__mobile-link');

    if (!navbar) return;

    // Scroll handler — add blur class when scrolled
    const onScroll = rafThrottle(() => {
        navbar.classList.toggle('scrolled', window.scrollY > 20);

        // Highlight active nav link based on scroll position
        const sections = $$('section[id]');
        let current = '';
        sections.forEach(sec => {
            if (window.scrollY >= sec.offsetTop - 120) {
                current = sec.id;
            }
        });

        links.forEach(link => {
            link.classList.toggle('active', link.dataset.section === current);
        });
    });

    window.addEventListener('scroll', onScroll, { passive: true });

    // Smooth scroll for all anchor links
    function smoothScroll(e) {
        const href = this.getAttribute('href');
        if (!href || !href.startsWith('#')) return;
        e.preventDefault();

        const target = $(href);
        if (!target) return;

        const top = target.offsetTop - 70;
        window.scrollTo({ top, behavior: 'smooth' });

        // Close mobile menu if open
        closeMobile();
    }

    $$('a[href^="#"]').forEach(a => a.addEventListener('click', smoothScroll));

    // Mobile hamburger toggle
    function openMobile() {
        hamburger.classList.add('open');
        mobileMenu.classList.add('open');
        hamburger.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeMobile() {
        hamburger.classList.remove('open');
        mobileMenu.classList.remove('open');
        hamburger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    if (hamburger) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.contains('open') ? closeMobile() : openMobile();
        });
    }

    mobileLinks.forEach(link => link.addEventListener('click', closeMobile));
})();

/* ─── SCROLL REVEAL (IntersectionObserver) ───────────────── */
(function initScrollReveal() {
    // All elements with .section-reveal or .reveal-up
    const revealEls = $$('.section-reveal, .reveal-up, .skill-card, .project-card, .workflow__step, .contact__link');

    if (!revealEls.length || !window.IntersectionObserver) {
        // Fallback: show everything immediately
        revealEls.forEach(el => el.style.opacity = '1');
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;

            const el = entry.target;

            // Apply stagger delay if present
            const delay = el.style.getPropertyValue('--delay') || el.dataset.delay || '0ms';
            el.style.transitionDelay = delay;

            el.classList.add('revealed');
            observer.unobserve(el); // Fire once
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -60px 0px'
    });

    revealEls.forEach(el => {
        // CSS (scoped under body.js-ready) already hides elements.
        // Just observe — no need to set inline styles.
        observer.observe(el);
    });
})();

/* ─── HERO TITLE REVEAL ──────────────────────────────────── */
(function initHeroReveal() {
    const lines = $$('.hero__title-line, .hero__subtitle, .hero__actions, .hero__scroll');
    lines.forEach((el, i) => {
        const delay = parseInt(el.dataset.delay || i * 100, 10);
        setTimeout(() => {
            el.classList.add('revealed');
        }, delay + 100);
    });
})();

/* ─── PROJECT CARD TILT EFFECT ───────────────────────────── */
(function initCardTilt() {
    const cards = $$('.project-card[data-tilt]');
    if (!cards.length) return;

    cards.forEach(card => {
        const TILT_MAX   = 6;  // degrees
        const SCALE      = 1.02;
        let rect         = null;

        card.addEventListener('mouseenter', () => {
            rect = card.getBoundingClientRect();
        });

        card.addEventListener('mousemove', rafThrottle((e) => {
            if (!rect) rect = card.getBoundingClientRect();

            const x  = e.clientX - rect.left;
            const y  = e.clientY - rect.top;
            const cx = rect.width / 2;
            const cy = rect.height / 2;

            // Normalise to -1..1
            const nx = (x - cx) / cx;
            const ny = (y - cy) / cy;

            const rotateX = -ny * TILT_MAX;
            const rotateY =  nx * TILT_MAX;

            card.style.transform = `
                perspective(1000px)
                rotateX(${rotateX}deg)
                rotateY(${rotateY}deg)
                scale(${SCALE})
            `;
            card.style.transition = 'transform 0.1s linear';

            // Move glow spotlight to follow mouse
            const glow = card.querySelector('.project-card__glow');
            if (glow) {
                glow.style.background = `radial-gradient(
                    circle at ${x}px ${y}px,
                    rgba(255,255,255,0.06) 0%,
                    transparent 60%
                )`;
            }
        }));

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale(1)';
            card.style.transition = 'transform 0.5s cubic-bezier(0.22, 1, 0.36, 1)';
            rect = null;

            const glow = card.querySelector('.project-card__glow');
            if (glow) glow.style.background = '';
        });
    });
})();

/* ─── SKILL CARD GLOW FOLLOW ─────────────────────────────── */
(function initSkillGlow() {
    $$('.skill-card').forEach(card => {
        card.addEventListener('mousemove', rafThrottle((e) => {
            const rect = card.getBoundingClientRect();
            const x    = e.clientX - rect.left;
            const y    = e.clientY - rect.top;
            const glow = card.querySelector('.skill-card__glow');
            if (glow) {
                glow.style.left = x + 'px';
                glow.style.top  = y + 'px';
                glow.style.transform = 'translate(-50%, -50%) scale(1.5)';
            }
        }));

        card.addEventListener('mouseleave', () => {
            const glow = card.querySelector('.skill-card__glow');
            if (glow) {
                glow.style.transform = 'translate(-50%, -50%) scale(0)';
            }
        });
    });
})();

/* ─── CONTACT FORM HANDLER ───────────────────────────────── */
(function initContactForm() {
    const form       = $('#contactForm');
    const submitBtn  = $('#submitBtn');
    const submitLabel = $('#submitLabel');
    const formNote   = $('#formNote');

    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        // Simple client-side validation
        if (!data.name.trim() || !data.email.trim() || !data.message.trim()) {
            showNote('Please fill in all fields.', 'error');
            return;
        }

        if (!isValidEmail(data.email)) {
            showNote('Please enter a valid email address.', 'error');
            return;
        }

        // Disable button while submitting
        submitBtn.disabled = true;
        submitLabel.textContent = 'Sending...';

        try {
            const response = await fetch('/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                                   || getCsrfToken(),
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();

            if (result.success) {
                showNote(result.message || 'Message sent! I\'ll be in touch.', 'success');
                form.reset();
            } else {
                showNote(result.message || 'Something went wrong. Please try again.', 'error');
            }
        } catch (err) {
            console.error('Contact form error:', err);
            showNote('Unable to send. Try emailing me directly.', 'error');
        } finally {
            submitBtn.disabled = false;
            submitLabel.textContent = 'Send Message';
        }
    });

    function showNote(msg, type) {
        if (!formNote) return;
        formNote.textContent = msg;
        formNote.className   = 'contact__form-note ' + (type || '');
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function getCsrfToken() {
        // Fallback: read XSRF-TOKEN cookie set by Laravel
        const match = document.cookie.match(/XSRF-TOKEN=([^;]+)/);
        return match ? decodeURIComponent(match[1]) : '';
    }
})();

/* ─── FLOATING SECTION NUMBERS ───────────────────────────── */
/* Adds subtle counter lines between section transitions */
(function initSectionDecorators() {
    $$('section[id]').forEach(section => {
        // Create subtle side number
        const num = document.createElement('div');
        num.className   = 'section__side-num';
        num.textContent = section.querySelector('.section-label__num')?.textContent || '';
        num.setAttribute('aria-hidden', 'true');
        section.appendChild(num);
    });
})();

/* ─── PARALLAX HERO GRID ─────────────────────────────────── */
(function initParallax() {
    const grid = $('.hero__grid-bg');
    if (!grid) return;

    window.addEventListener('scroll', rafThrottle(() => {
        const y = window.scrollY;
        grid.style.transform = `translateY(${y * 0.3}px)`;
    }), { passive: true });
})();

/* ─── STAGGER WORKFLOW STEPS ON SCROLL ───────────────────── */
(function initWorkflowStagger() {
    const steps = $$('.workflow__step');
    if (!steps.length || !window.IntersectionObserver) return;

    // Already handled by the main scroll reveal system;
    // just add an extra bounce on each step
    steps.forEach((step, i) => {
        step.style.setProperty('--delay', `${i * 120}ms`);
    });
})();

/* ─── PAGE LOAD SEQUENCE ─────────────────────────────────── */
window.addEventListener('DOMContentLoaded', () => {
    // 'js-ready' gates all CSS animations — must be set FIRST
    // so elements are hidden before the first paint with animations.
    document.body.classList.add('js-ready');
    document.body.classList.add('loaded');
});

