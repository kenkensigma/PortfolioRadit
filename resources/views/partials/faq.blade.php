{{-- ============================================================
     FAQ SECTION — Knowledge Base + Voice Mode
     Free: uses Web Speech API (SpeechRecognition + SpeechSynthesis)
     No API key needed
     ============================================================ --}}
<section class="aifaq section-reveal" id="faq">
    <div class="container">

        <div class="section-label">
            <span class="section-label__text">FAQ</span>
        </div>

        <div class="aifaq__header">
            <div>
                <h2 class="section-title">
                    Got a<br>
                    <em>question?</em>
                </h2>
                <p class="aifaq__sub">
                    Click a question, type, or <strong>speak</strong> I'll answer instantly.
                </p>
            </div>
            <div class="aifaq__badge" aria-hidden="true">
                <div class="aifaq__badge-dot"></div>
                <span>Always Available</span>
            </div>
        </div>

        <div class="aifaq__body">

            {{-- LEFT: Question categories --}}
            <div class="aifaq__questions">

                @php
                    $categories = [
                        [
                            'icon' => '⟨⟩',
                            'label' => 'Tech & Stack',
                            'items' => [
                                ['id' => 'q1', 'q' => 'What tech stack do you use?'],
                                ['id' => 'q2', 'q' => 'Do you work with React or Vue?'],
                                ['id' => 'q3', 'q' => 'Can you build a REST API?'],
                                ['id' => 'q4', 'q' => 'Do you know DevOps / deployment?'],
                            ],
                        ],
                        [
                            'icon' => '◫',
                            'label' => 'Projects & Work',
                            'items' => [
                                ['id' => 'q5', 'q' => 'What kind of projects do you take?'],
                                ['id' => 'q6', 'q' => 'How long does a project take?'],
                                ['id' => 'q7', 'q' => 'Do you work with international clients?'],
                                ['id' => 'q8', 'q' => 'Can you work on an existing project?'],
                                ['id' => 'q13', 'q' => 'What are you studying now?'],
                            ],
                        ],
                        [
                            'icon' => '◉',
                            'label' => 'Hiring & Rates',
                            'items' => [
                                ['id' => 'q9', 'q' => 'Are you available for freelance?'],
                                ['id' => 'q10', 'q' => 'What are your rates?'],
                                ['id' => 'q11', 'q' => 'Do you do full-time / remote work?'],
                                ['id' => 'q12', 'q' => 'How do I start a project with you?'],
                            ],
                        ],
                    ];
                @endphp

                @foreach ($categories as $cat)
                    <div class="faq-category">
                        <div class="faq-category__header">
                            <span class="faq-category__icon">{{ $cat['icon'] }}</span>
                            <span class="faq-category__label">{{ $cat['label'] }}</span>
                        </div>
                        <div class="faq-category__items">
                            @foreach ($cat['items'] as $item)
                                <button class="faq-q-btn" data-id="{{ $item['id'] }}" data-q="{{ $item['q'] }}"
                                    aria-label="Ask: {{ $item['q'] }}">
                                    <span class="faq-q-btn__text">{{ $item['q'] }}</span>
                                    <span class="faq-q-btn__arrow">→</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- RIGHT: Chat panel --}}
            <div class="aifaq__chat">

                {{-- Voice mode overlay --}}
                <div class="voice-overlay" id="voiceOverlay">
                    <div class="voice-overlay__inner">
                        <div class="voice-rings" aria-hidden="true">
                            <div class="voice-ring voice-ring--1"></div>
                            <div class="voice-ring voice-ring--2"></div>
                            <div class="voice-ring voice-ring--3"></div>
                            <div class="voice-core" id="voiceCore">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"
                                        fill="currentColor" />
                                    <path d="M19 10v2a7 7 0 0 1-14 0v-2M12 19v4M8 23h8" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>
                        <p class="voice-status" id="voiceStatus">Listening...</p>
                        <p class="voice-transcript" id="voiceTranscript"></p>
                        <button class="voice-cancel" id="voiceCancel">Cancel</button>
                    </div>
                </div>

                {{-- Messages --}}
                <div class="aifaq__messages" id="faqMessages">
                    <div class="faq-msg faq-msg--ai">
                        <div class="faq-msg__avatar" aria-hidden="true">S</div>
                        <div class="faq-msg__bubble">
                            <p>Hey! Pick a question, type, or tap the 🎤 mic to speak I'll answer right away.</p>
                        </div>
                    </div>
                </div>

                {{-- Input bar --}}
                <div class="aifaq__input-wrap">
                    <div class="aifaq__input-inner">

                        {{-- Voice button --}}
                        <button class="aifaq__voice-btn" id="voiceBtn" aria-label="Voice input"
                            title="Ask with your voice">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z" fill="currentColor" />
                                <path d="M19 10v2a7 7 0 0 1-14 0v-2M12 19v4M8 23h8" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </button>

                        <input type="text" id="faqInput" class="aifaq__input"
                            placeholder="Type or speak your question..." maxlength="200" autocomplete="off"
                            list="faqSuggestions">
                        <datalist id="faqSuggestions">
                            @foreach ($categories as $cat)
                                @foreach ($cat['items'] as $item)
                                    <option value="{{ $item['q'] }}">
                                @endforeach
                            @endforeach
                        </datalist>

                        {{-- Send button --}}
                        <button class="aifaq__send" id="faqSend" aria-label="Send question">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                <path d="M14 8H2M8 2l6 6-6 6" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                    <p class="aifaq__hint" id="faqHint">
                        <span id="hintVoice">🎤 Voice supported in this browser</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    (function initFAQ() {

        /* ── Knowledge base ───────────────────────────────────── */
        const KB = {
            q1: {
                q: "What tech stack do you use?",
                a: `My core stack is Laravel and PHP on the backend and vanilla JS with CSS on the frontend. For databases I use MySQL, and for Auth i usually use Laravel Sanctum. I also work with Tailwind CSS, and have experience with AR.js and Three.js for 3D and AR web experiences.`
            },
            q2: {
                q: "Do you work with React or Vue?",
                a: `I primarily build with vanilla JS and Laravel Blade — which keeps things fast and dependency-free. I have working knowledge of Vue.js and can adapt to React projects if needed. For most web apps, a well-architected Laravel plus Alpine.js stack delivers the same result with less overhead.`
            },
            q3: {
                q: "Can you build a REST API?",
                a: `REST API development is one of the areas I'm actively developing. I've built a structured REST API with Laravel Sanctum authentication, role-based access control for multiple user types, a gamified course unlock system, and server-side exercise evaluation. Check out OOP School in my projects section for an example.`
            },
            q4: {
                q: "Do you know DevOps / deployment?",
                a: `Yes. I handle deployments using Vercel and I'm currently expanding my skills into Docker and CI/CD pipelines with GitHub Actions. I'm learning how to manage Linux servers, configure Nginx, and set up more robust production environments. I make sure what I build runs reliably, and I'm actively growing my DevOps knowledge.`
            },
            q5: {
                q: "What kind of projects do you take?",
                a: `I take on REST APIs and SaaS platforms, e-commerce sites, admin dashboards and CMS systems, product catalog and landing pages, and 3D and AR web experiences. Both greenfield projects and improvements to existing codebases.`
            },
            q6: {
                q: "How long does a project take?",
                a: `It depends on scope. A landing page or simple site takes one to two weeks. A product catalog or small web app takes two to four weeks. A full SaaS platform or complex API takes four to eight weeks. I always give a detailed timeline estimate after the first discovery call.`
            },
            q7: {
                q: "Do you work with international clients?",
                a: `Yes! I'm based in Indonesia but work with clients worldwide. I'm comfortable with async communication, different time zones, and tools like Slack, Notion, and Figma. Most of my workflow is remote-friendly by default.`
            },
            q8: {
                q: "Can you work on an existing project?",
                a: `Yes I'm comfortable jumping into existing codebases. I take time to understand the architecture first before making changes, write clean commits, and never break what's already working. I've done code reviews, performance optimizations, and feature additions on projects I didn't originally build.`
            },
            q9: {
                q: "Are you available for freelance?",
                a: `Yes, I'm currently open to freelance and contract work — both short-term projects and longer engagements. The best way to start is to reach out via the contact section below with a brief description of your project and timeline.`
            },
            q10: {
                q: "What are your rates?",
                a: `Rates vary based on project complexity, timeline, and scope. I work with both fixed-price for well-defined projects and hourly arrangements. Send me a message in the contact section with your project details and I'll get back with a custom quote — usually within 24 hours.`
            },
            q11: {
                q: "Do you do full-time / remote work?",
                a: `I'm open to discussing long-term remote contracts and retainer arrangements for ongoing development work. If you're looking for a dedicated developer for your team on a contract basis, feel free to reach out and we can talk about what works best.`
            },
            q12: {
                q: "How do I start a project with you?",
                a: `Simply fill in the contact form below with a brief description of what you want to build, your rough timeline, and any designs or references you have. I'll reply within 24 hours or if you need a faster response, feel free to reach out directly via WhatsApp. Either way, we'll schedule a discovery call to scope everything out properly.`
            },
            q13: {
                q: "What are you studying now?",
                a: `I'm currently expanding my skills in deployment and cloud infrastructure learning Docker, CI/CD pipelines, and diving deeper into backend development, while also exploring AI automation to build smarter, more scalable systems.`
            },
        };

        /* ── Fuzzy match ──────────────────────────────────────── */
        const keywords = {
            q1: ['stack', 'tech', 'language', 'php', 'laravel', 'use', 'tools'],
            q2: ['react', 'vue', 'angular', 'frontend', 'framework', 'javascript'],
            q3: ['api', 'rest', 'endpoint', 'sanctum', 'backend', 'swagger'],
            q4: ['devops', 'deploy', 'docker', 'server', 'linux', 'cicd', 'hosting'],
            q5: ['project', 'build', 'make', 'type', 'kind', 'what'],
            q6: ['long', 'time', 'duration', 'weeks', 'days', 'deadline', 'timeline'],
            q7: ['international', 'country', 'timezone', 'remote', 'abroad'],
            q8: ['existing', 'legacy', 'old', 'fix', 'maintain', 'improve'],
            q9: ['available', 'freelance', 'hire', 'open', 'work', 'contract'],
            q10: ['rate', 'price', 'cost', 'charge', 'pay', 'money', 'budget', 'fee'],
            q11: ['fulltime', 'full-time', 'permanent', 'ongoing', 'retainer'],
            q12: ['start', 'begin', 'contact', 'reach', 'how', 'process', 'step'],
            q13: ['study', 'learning', 'skills', 'currently', 'now', 'focus'],
        };

        function findBestMatch(input) {
            const q = input.toLowerCase().trim();
            for (const [id, item] of Object.entries(KB)) {
                if (item.q.toLowerCase() === q) return {
                    id,
                    item
                };
            }
            let best = null,
                bestScore = 0;
            for (const [id, words] of Object.entries(keywords)) {
                const score = words.filter(w => q.includes(w)).length;
                if (score > bestScore) {
                    bestScore = score;
                    best = {
                        id,
                        item: KB[id]
                    };
                }
            }
            return bestScore > 0 ? best : null;
        }

        /* ── DOM refs ─────────────────────────────────────────── */
        const messagesEl = document.getElementById('faqMessages');
        const inputEl = document.getElementById('faqInput');
        const sendBtn = document.getElementById('faqSend');
        const voiceBtn = document.getElementById('voiceBtn');
        const voiceOverlay = document.getElementById('voiceOverlay');
        const voiceStatus = document.getElementById('voiceStatus');
        const voiceTranscript = document.getElementById('voiceTranscript');
        const voiceCancel = document.getElementById('voiceCancel');
        const voiceCore = document.getElementById('voiceCore');
        const hintVoice = document.getElementById('hintVoice');
        const qBtns = document.querySelectorAll('.faq-q-btn');

        /* ── Speech Synthesis (text-to-speech) ───────────────── */
        const synth = window.speechSynthesis;
        let isSpeaking = false;

        function speak(text) {
            if (!synth) return;
            synth.cancel(); // stop any ongoing speech

            // Strip HTML tags for clean TTS
            const clean = text.replace(/<[^>]+>/g, '').replace(/\s+/g, ' ').trim();

            const utter = new SpeechSynthesisUtterance(clean);
            utter.rate = 0.95;
            utter.pitch = 1;
            utter.volume = 1;

            // Pick a nice English voice if available
            const voices = synth.getVoices();
            const preferred = voices.find(v =>
                v.lang.startsWith('en') && (v.name.includes('Google') || v.name.includes('Natural') || v.name
                    .includes('Premium'))
            ) || voices.find(v => v.lang.startsWith('en'));
            if (preferred) utter.voice = preferred;

            utter.onstart = () => {
                isSpeaking = true;
                voiceBtn.classList.add('speaking');
            };
            utter.onend = () => {
                isSpeaking = false;
                voiceBtn.classList.remove('speaking');
            };
            utter.onerror = () => {
                isSpeaking = false;
                voiceBtn.classList.remove('speaking');
            };

            synth.speak(utter);
        }

        /* ── Speech Recognition (voice input) ────────────────── */
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        let recognition = null;
        let isListening = false;

        if (SpeechRecognition) {
            recognition = new SpeechRecognition();
            recognition.lang = 'en-US';
            recognition.continuous = false;
            recognition.interimResults = true;

            recognition.onstart = () => {
                isListening = true;
                voiceOverlay.classList.add('open');
                voiceStatus.textContent = 'Listening...';
                voiceTranscript.textContent = '';
                voiceBtn.classList.add('listening');
            };

            recognition.onresult = (e) => {
                const transcript = Array.from(e.results)
                    .map(r => r[0].transcript)
                    .join('');
                voiceTranscript.textContent = transcript;

                // Final result — fire the question
                if (e.results[e.results.length - 1].isFinal) {
                    voiceStatus.textContent = 'Got it!';
                    setTimeout(() => {
                        stopListening();
                        if (transcript.trim()) ask(transcript.trim());
                    }, 500);
                }
            };

            recognition.onerror = (e) => {
                stopListening();
                if (e.error === 'no-speech') {
                    addAiMsg("I didn't catch that — try speaking a bit louder or use the text input below.",
                        200);
                } else if (e.error === 'not-allowed') {
                    addAiMsg(
                        "Microphone access was denied. Please allow microphone permission in your browser settings.",
                        200);
                }
            };

            recognition.onend = () => {
                stopListening();
            };

        } else {
            // Browser doesn't support voice
            voiceBtn.style.display = 'none';
            if (hintVoice) hintVoice.textContent = '⌨ Type your question below';
        }

        function startListening() {
            if (!recognition || isListening) return;
            synth?.cancel(); // stop any speaking
            recognition.start();
        }

        function stopListening() {
            isListening = false;
            voiceOverlay.classList.remove('open');
            voiceBtn.classList.remove('listening');
            try {
                recognition?.stop();
            } catch (e) {}
        }

        voiceBtn.addEventListener('click', () => {
            if (isSpeaking) {
                synth.cancel();
                return;
            }
            if (isListening) {
                stopListening();
                return;
            }
            startListening();
        });

        voiceCancel.addEventListener('click', stopListening);

        /* ── Render messages ──────────────────────────────────── */
        function addUserMsg(text) {
            const el = document.createElement('div');
            el.className = 'faq-msg faq-msg--user';
            el.innerHTML = `<div class="faq-msg__bubble faq-msg__bubble--user"><p>${escHtml(text)}</p></div>`;
            messagesEl.appendChild(el);
            scroll();
        }

        function addAiMsg(html, delay = 420) {
            const wrap = document.createElement('div');
            wrap.className = 'faq-msg faq-msg--ai';
            wrap.innerHTML = `
            <div class="faq-msg__avatar" aria-hidden="true">S</div>
            <div class="faq-msg__bubble">
                <div class="typing-dots"><span></span><span></span><span></span></div>
            </div>`;
            messagesEl.appendChild(wrap);
            scroll();

            setTimeout(() => {
                const bubble = wrap.querySelector('.faq-msg__bubble');
                bubble.innerHTML = `
                <p>${html}</p>
                <button class="faq-speak-btn" title="Read aloud" aria-label="Read answer aloud">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none">
                        <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z" fill="currentColor"/>
                        <path d="M19 10v2a7 7 0 0 1-14 0v-2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Read aloud
                </button>`;

                // Wire up the speak button
                bubble.querySelector('.faq-speak-btn').addEventListener('click', () => {
                    speak(html);
                });

                scroll();

                // Auto-read if answer came from voice input
                if (window._faqLastInputWasVoice) {
                    window._faqLastInputWasVoice = false;
                    setTimeout(() => speak(html), 200);
                }
            }, delay);
        }

        /* ── Ask ──────────────────────────────────────────────── */
        function ask(question, knownId = null, fromVoice = false) {
            if (!question.trim()) return;
            window._faqLastInputWasVoice = fromVoice;

            qBtns.forEach(b => b.classList.toggle('active', b.dataset.id === knownId));
            addUserMsg(question);

            const match = knownId ? {
                id: knownId,
                item: KB[knownId]
            } : findBestMatch(question);

            if (match) {
                addAiMsg(match.item.a);
            } else {
                addAiMsg(
                    `Hmm, I don't have a specific answer for that. Try one of the questions on the left, or reach out directly via the <strong>contact section</strong> below — I'll reply within 24 hours! 👇`
                    );
            }

            inputEl.value = '';
        }

        /* ── Events ───────────────────────────────────────────── */
        qBtns.forEach(btn => {
            btn.addEventListener('click', () => ask(btn.dataset.q, btn.dataset.id, false));
        });

        sendBtn.addEventListener('click', () => ask(inputEl.value, null, false));
        inputEl.addEventListener('keydown', e => {
            if (e.key === 'Enter') {
                e.preventDefault();
                ask(inputEl.value, null, false);
            }
        });

        // Stop speech when clicking elsewhere
        messagesEl.addEventListener('click', () => synth?.cancel());

        /* ── Helpers ──────────────────────────────────────────── */
        function scroll() {
            messagesEl.scrollTo({
                top: messagesEl.scrollHeight,
                behavior: 'smooth'
            });
        }

        function escHtml(s) {
            return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        }

        // Preload voices (Chrome loads them async)
        if (synth) {
            synth.getVoices();
            speechSynthesis.onvoiceschanged = () => synth.getVoices();
        }

        // Check voice support hint
        if (!SpeechRecognition && hintVoice) {
            hintVoice.textContent = '⌨ Type your question below';
        }

    })();
</script>
