/* ============================================================
   SHIRO DEV — DASHBOARD JS
   CRUD for Projects, Skills, About — persisted in localStorage
   ============================================================ */

'use strict';

/* ─── STORAGE HELPERS ────────────────────────────────────── */
const Store = {
    get(key, fallback = []) {
        try { return JSON.parse(localStorage.getItem(key)) ?? fallback; }
        catch { return fallback; }
    },
    set(key, value) {
        localStorage.setItem(key, JSON.stringify(value));
    },
    getObj(key, fallback = {}) {
        try { return JSON.parse(localStorage.getItem(key)) ?? fallback; }
        catch { return fallback; }
    }
};

const uid = () => Math.random().toString(36).slice(2, 10);

/* ─── MODAL SYSTEM ───────────────────────────────────────── */
const backdrop = document.getElementById('modalBackdrop');
const modals   = {};

function openModal(id) {
    const el = document.getElementById(id);
    if (!el) return;
    // Close any open modal first
    Object.keys(modals).forEach(k => { if (modals[k]) closeModal(k); });
    el.classList.add('open');
    backdrop.classList.add('open');
    modals[id] = true;
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.remove('open');
    backdrop.classList.remove('open');
    modals[id] = false;
    document.body.style.overflow = '';
}

// Close buttons via data-close attribute
document.addEventListener('click', e => {
    const closeBtn = e.target.closest('[data-close]');
    if (closeBtn) closeModal(closeBtn.dataset.close);
});

// Click backdrop to close
backdrop?.addEventListener('click', () => {
    Object.keys(modals).forEach(k => closeModal(k));
});

/* ─── SIDEBAR TOGGLE ─────────────────────────────────────── */
const sidebarToggle = document.getElementById('sidebarToggle');
const sidebar       = document.getElementById('dashSidebar');

sidebarToggle?.addEventListener('click', () => {
    sidebar.classList.toggle('open');
});

/* ─── TOAST NOTIFICATION ─────────────────────────────────── */
function toast(msg, type = 'success') {
    const existing = document.querySelector('.dash-toast');
    if (existing) existing.remove();

    const el = document.createElement('div');
    el.className = `dash-toast dash-toast--${type}`;
    el.textContent = msg;
    el.style.cssText = `
        position: fixed; bottom: 28px; right: 28px;
        padding: 12px 20px;
        background: ${type === 'success' ? '#22c55e' : '#ef4444'};
        color: #000;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px; font-weight: 500;
        z-index: 999; opacity: 0;
        transform: translateY(8px);
        transition: opacity 0.3s, transform 0.3s;
        border: 1px solid rgba(0,0,0,0.2);
    `;
    document.body.appendChild(el);
    requestAnimationFrame(() => {
        el.style.opacity = '1';
        el.style.transform = 'translateY(0)';
    });
    setTimeout(() => {
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 300);
    }, 2800);
}

/* ============================================================
   PROJECTS CRUD
   ============================================================ */
const PROJECTS_KEY = 'shiro_projects';

function getProjects()      { return Store.get(PROJECTS_KEY, defaultProjects()); }
function saveProjects(list) { Store.set(PROJECTS_KEY, list); }

function defaultProjects() {
    return [
        { id: uid(), title: 'Nexus Commerce',   type: 'E-Commerce Platform',   desc: 'A full-featured e-commerce system with real-time inventory, payment gateways, and an admin dashboard.', stack: ['Laravel','MySQL','Stripe','Redis'],      accent: '#4f46e5', bg: '#1a1a2e', url: '' },
        { id: uid(), title: 'Orion API',         type: 'SaaS REST API',         desc: 'A multi-tenant SaaS API platform with OAuth2, rate limiting, webhooks, and developer documentation.',  stack: ['PHP','PostgreSQL','OAuth2','Swagger'],   accent: '#06b6d4', bg: '#0a1628', url: '' },
        { id: uid(), title: 'Pulse Analytics',   type: 'Analytics Dashboard',   desc: 'Real-time analytics dashboard with WebSocket streaming, customisable charts, and role-based access.',  stack: ['Laravel','WebSockets','Chart.js','Redis'], accent: '#22c55e', bg: '#0d1b0d', url: '' },
        { id: uid(), title: 'Vault CMS',         type: 'Content Management',    desc: 'A headless CMS with a clean editor, media management, versioning, and a powerful REST API.',           stack: ['Laravel','MySQL','S3','REST'],           accent: '#f59e0b', bg: '#1c0a0a', url: '' },
    ];
}

function renderProjects() {
    const tbody  = document.getElementById('projectsBody');
    const empty  = document.getElementById('projectsEmpty');
    if (!tbody) return;

    const projects = getProjects();
    tbody.innerHTML = '';

    if (!projects.length) {
        empty && (empty.style.display = 'flex');
        document.getElementById('projectsTable') && (document.getElementById('projectsTable').style.display = 'none');
        return;
    }

    empty && (empty.style.display = 'none');
    document.getElementById('projectsTable') && (document.getElementById('projectsTable').style.display = '');

    projects.forEach((p, i) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td style="color:rgba(255,255,255,0.25);font-size:11px">${String(i + 1).padStart(2, '0')}</td>
            <td><strong>${escHtml(p.title)}</strong></td>
            <td>${escHtml(p.type)}</td>
            <td>
                <div class="table-stack">
                    ${p.stack.map(t => `<span class="table-tag">${escHtml(t)}</span>`).join('')}
                </div>
            </td>
            <td>
                <span class="table-color-dot" style="background:${escHtml(p.accent)}"></span>
                <span style="font-size:11px;color:rgba(255,255,255,0.3)">${escHtml(p.accent)}</span>
            </td>
            <td>
                <div class="table-actions">
                    <button class="btn-icon" title="Edit" data-action="edit-project" data-id="${p.id}">✎</button>
                    <button class="btn-icon btn-icon--danger" title="Delete" data-action="delete-project" data-id="${p.id}" data-name="${escHtml(p.title)}">✕</button>
                </div>
            </td>
        `;
        tbody.appendChild(tr);
    });

    // Update overview stat
    const stat = document.getElementById('statProjects');
    if (stat) stat.textContent = projects.length;
}

// Open add modal
document.getElementById('btnAddProject')?.addEventListener('click', () => {
    document.getElementById('projectModalTitle').textContent = 'Add Project';
    document.getElementById('projectId').value    = '';
    document.getElementById('pTitle').value       = '';
    document.getElementById('pType').value        = '';
    document.getElementById('pDesc').value        = '';
    document.getElementById('pStack').value       = '';
    document.getElementById('pAccent').value      = '#4f46e5';
    document.getElementById('pAccentPicker').value = '#4f46e5';
    document.getElementById('pBg').value          = '#1a1a2e';
    document.getElementById('pBgPicker').value    = '#1a1a2e';
    document.getElementById('pUrl').value         = '';
    openModal('projectModal');
});

// Edit / delete delegate
document.addEventListener('click', e => {
    const btn = e.target.closest('[data-action]');
    if (!btn) return;
    const action = btn.dataset.action;
    const id     = btn.dataset.id;

    if (action === 'edit-project') {
        const p = getProjects().find(x => x.id === id);
        if (!p) return;
        document.getElementById('projectModalTitle').textContent = 'Edit Project';
        document.getElementById('projectId').value     = p.id;
        document.getElementById('pTitle').value        = p.title;
        document.getElementById('pType').value         = p.type;
        document.getElementById('pDesc').value         = p.desc;
        document.getElementById('pStack').value        = p.stack.join(', ');
        document.getElementById('pAccent').value       = p.accent;
        document.getElementById('pAccentPicker').value = p.accent;
        document.getElementById('pBg').value           = p.bg;
        document.getElementById('pBgPicker').value     = p.bg;
        document.getElementById('pUrl').value          = p.url || '';
        openModal('projectModal');
    }

    if (action === 'delete-project') {
        document.getElementById('deleteProjectName').textContent = btn.dataset.name;
        document.getElementById('confirmDeleteBtn').dataset.id  = id;
        openModal('deleteModal');
    }

    if (action === 'edit-skill') {
        const skills = getSkills();
        const s = skills.find(x => x.id === id);
        if (!s) return;
        document.getElementById('skillModalTitle').textContent = 'Edit Skill';
        document.getElementById('skillId').value  = s.id;
        document.getElementById('sTitle').value   = s.title;
        document.getElementById('sIcon').value    = s.icon || '';
        document.getElementById('sDesc').value    = s.desc;
        document.getElementById('sTags').value    = s.tags.join(', ');
        openModal('skillModal');
    }

    if (action === 'delete-skill') {
        document.getElementById('deleteSkillName').textContent = btn.dataset.name;
        document.getElementById('confirmDeleteSkillBtn').dataset.id = id;
        openModal('deleteSkillModal');
    }
});

// Color pickers sync
function syncColorPicker(textId, pickerId) {
    const text   = document.getElementById(textId);
    const picker = document.getElementById(pickerId);
    if (!text || !picker) return;
    picker.addEventListener('input', () => { text.value = picker.value; });
    text.addEventListener('input', () => {
        if (/^#[0-9A-Fa-f]{6}$/.test(text.value)) picker.value = text.value;
    });
}
syncColorPicker('pAccent', 'pAccentPicker');
syncColorPicker('pBg',     'pBgPicker');

// Save project
document.getElementById('projectForm')?.addEventListener('submit', e => {
    e.preventDefault();
    const id    = document.getElementById('projectId').value;
    const title = document.getElementById('pTitle').value.trim();
    const type  = document.getElementById('pType').value.trim();
    const desc  = document.getElementById('pDesc').value.trim();

    if (!title || !type || !desc) { toast('Please fill in required fields.', 'error'); return; }

    const project = {
        id:     id || uid(),
        title,
        type,
        desc,
        stack:  document.getElementById('pStack').value.split(',').map(s => s.trim()).filter(Boolean),
        accent: document.getElementById('pAccent').value || '#ffffff',
        bg:     document.getElementById('pBg').value     || '#111111',
        url:    document.getElementById('pUrl').value.trim(),
    };

    let projects = getProjects();
    if (id) {
        projects = projects.map(p => p.id === id ? project : p);
        toast('Project updated!');
    } else {
        projects.push(project);
        toast('Project added!');
    }

    saveProjects(projects);
    renderProjects();
    closeModal('projectModal');
});

// Confirm delete project
document.getElementById('confirmDeleteBtn')?.addEventListener('click', function () {
    const id       = this.dataset.id;
    const projects = getProjects().filter(p => p.id !== id);
    saveProjects(projects);
    renderProjects();
    closeModal('deleteModal');
    toast('Project deleted.', 'error');
});

/* ============================================================
   SKILLS CRUD
   ============================================================ */
const SKILLS_KEY = 'shiro_skills';

function getSkills()      { return Store.get(SKILLS_KEY, defaultSkills()); }
function saveSkills(list) { Store.set(SKILLS_KEY, list); }

function defaultSkills() {
    return [
        { id: uid(), icon: '⬡', title: 'Backend Development',  desc: 'Building performant, scalable server-side systems with PHP, Laravel, Node.js, and RESTful architecture.', tags: ['PHP','Laravel','Node.js'] },
        { id: uid(), icon: '◫', title: 'Frontend Development', desc: 'Crafting responsive, interactive UIs using vanilla JS, modern CSS, and component-driven patterns.',     tags: ['HTML','CSS','JavaScript'] },
        { id: uid(), icon: '⊕', title: 'REST API Development', desc: 'Designing clean, versioned APIs with proper authentication, rate limiting, and documentation.',           tags: ['REST','OAuth','JSON'] },
        { id: uid(), icon: '⊞', title: 'Database Architecture',desc: 'Schema design, query optimisation, and data modelling for relational and document stores.',               tags: ['MySQL','PostgreSQL','Redis'] },
        { id: uid(), icon: '◈', title: 'UI Implementation',    desc: 'Translating high-fidelity designs into pixel-perfect, accessible, and animated interfaces.',              tags: ['Figma → Code','A11y','Animation'] },
        { id: uid(), icon: '⊗', title: 'DevOps & Deployment',  desc: 'CI/CD pipelines, Docker containerisation, Linux server management, and cloud deployments.',              tags: ['Docker','Linux','CI/CD'] },
    ];
}

function renderSkills() {
    const grid  = document.getElementById('skillsGrid');
    const empty = document.getElementById('skillsEmpty');
    if (!grid) return;

    const skills = getSkills();
    grid.innerHTML = '';

    if (!skills.length) {
        empty && (empty.style.display = 'flex');
        return;
    }
    empty && (empty.style.display = 'none');

    skills.forEach(s => {
        const card = document.createElement('div');
        card.className = 'skill-dash-card';
        card.innerHTML = `
            <div class="skill-dash-card__top">
                <span class="skill-dash-card__icon">${escHtml(s.icon || '⬡')}</span>
                <div class="skill-dash-card__actions">
                    <button class="btn-icon" title="Edit" data-action="edit-skill" data-id="${s.id}">✎</button>
                    <button class="btn-icon btn-icon--danger" title="Delete" data-action="delete-skill" data-id="${s.id}" data-name="${escHtml(s.title)}">✕</button>
                </div>
            </div>
            <div class="skill-dash-card__title">${escHtml(s.title)}</div>
            <div class="skill-dash-card__desc">${escHtml(s.desc)}</div>
            <div class="skill-dash-card__tags">
                ${s.tags.map(t => `<span class="skill-dash-card__tag">${escHtml(t)}</span>`).join('')}
            </div>
        `;
        grid.appendChild(card);
    });

    const stat = document.getElementById('statSkills');
    if (stat) stat.textContent = skills.length;
}

// Add skill
document.getElementById('btnAddSkill')?.addEventListener('click', () => {
    document.getElementById('skillModalTitle').textContent = 'Add Skill';
    document.getElementById('skillId').value  = '';
    document.getElementById('sTitle').value   = '';
    document.getElementById('sIcon').value    = '⬡';
    document.getElementById('sDesc').value    = '';
    document.getElementById('sTags').value    = '';
    openModal('skillModal');
});

// Save skill
document.getElementById('skillForm')?.addEventListener('submit', e => {
    e.preventDefault();
    const id    = document.getElementById('skillId').value;
    const title = document.getElementById('sTitle').value.trim();
    const desc  = document.getElementById('sDesc').value.trim();

    if (!title || !desc) { toast('Title and description are required.', 'error'); return; }

    const skill = {
        id:    id || uid(),
        icon:  document.getElementById('sIcon').value.trim() || '⬡',
        title,
        desc,
        tags:  document.getElementById('sTags').value.split(',').map(s => s.trim()).filter(Boolean),
    };

    let skills = getSkills();
    if (id) {
        skills = skills.map(s => s.id === id ? skill : s);
        toast('Skill updated!');
    } else {
        skills.push(skill);
        toast('Skill added!');
    }

    saveSkills(skills);
    renderSkills();
    closeModal('skillModal');
});

// Confirm delete skill
document.getElementById('confirmDeleteSkillBtn')?.addEventListener('click', function () {
    const id     = this.dataset.id;
    const skills = getSkills().filter(s => s.id !== id);
    saveSkills(skills);
    renderSkills();
    closeModal('deleteSkillModal');
    toast('Skill deleted.', 'error');
});

/* ============================================================
   ABOUT CRUD
   ============================================================ */
const ABOUT_KEY = 'shiro_about';

function getAbout() {
    return Store.getObj(ABOUT_KEY, {
        name: 'Shiro Dev',
        role: 'Full Stack Developer',
        years: '5',
        projects: '40',
        bio1: 'I am a passionate full stack developer who focuses on building scalable systems, modern web applications, and clean user experiences.',
        bio2: 'I enjoy working on complex problems and transforming ideas into powerful digital products.',
        heroSubtitle: 'I design and build modern web applications, APIs, and digital products.',
        email: 'hello@shiro.dev',
        github: 'https://github.com/shirodev',
        linkedin: 'https://linkedin.com/in/shirodev',
        values: [
            { icon: '⟳', title: 'Iterative Thinking', desc: 'Continuous improvement in every build cycle.' },
            { icon: '◈', title: 'Systems Design',     desc: 'Architecture that scales without compromise.' },
            { icon: '◉', title: 'Clean Code',         desc: 'Readable, maintainable, intentional.' },
        ],
    });
}

function loadAboutForm() {
    const about = getAbout();
    const set   = (id, val) => { const el = document.getElementById(id); if (el) el.value = val || ''; };

    set('aName',         about.name);
    set('aRole',         about.role);
    set('aYears',        about.years);
    set('aProjects',     about.projects);
    set('aBio1',         about.bio1);
    set('aBio2',         about.bio2);
    set('aHeroSubtitle', about.heroSubtitle);
    set('aEmail',        about.email);
    set('aGithub',       about.github);
    set('aLinkedin',     about.linkedin);

    renderValues(about.values || []);
    updatePreview(about);
}

// Live preview update
function updatePreview(about) {
    const setEl = (id, txt) => { const el = document.getElementById(id); if (el) el.textContent = txt; };
    setEl('previewName',     about.name     || 'Shiro Dev');
    setEl('previewRole',     about.role     || 'Full Stack Developer');
    setEl('previewYears',    (about.years   || '5') + '+');
    setEl('previewProjects', (about.projects|| '40') + '+');
    setEl('previewBio',      about.bio1     || '');
    setEl('previewMonogram', (about.name    || 'S').charAt(0).toUpperCase());
}

// Attach live preview listeners
['aName','aRole','aYears','aProjects','aBio1'].forEach(id => {
    document.getElementById(id)?.addEventListener('input', () => {
        updatePreview(readAboutForm());
    });
});

function readAboutForm() {
    const val = id => document.getElementById(id)?.value?.trim() || '';
    return {
        name:         val('aName'),
        role:         val('aRole'),
        years:        val('aYears'),
        projects:     val('aProjects'),
        bio1:         val('aBio1'),
        bio2:         val('aBio2'),
        heroSubtitle: val('aHeroSubtitle'),
        email:        val('aEmail'),
        github:       val('aGithub'),
        linkedin:     val('aLinkedin'),
        values:       readValues(),
    };
}

// Save about
document.getElementById('btnSaveAbout')?.addEventListener('click', () => {
    const data = readAboutForm();
    Store.set(ABOUT_KEY, data);
    updatePreview(data);

    const status = document.getElementById('saveStatus');
    if (status) {
        status.textContent = '✓ Saved successfully';
        status.className   = 'save-status success';
        setTimeout(() => { status.textContent = ''; status.className = 'save-status'; }, 3000);
    }
    toast('About page saved!');
});

/* ─── VALUES LIST ────────────────────────────────────────── */
function renderValues(values) {
    const list = document.getElementById('valuesList');
    if (!list) return;
    list.innerHTML = '';
    values.forEach((v, i) => addValueRow(v, i));
}

function addValueRow(v = {}, idx) {
    const list = document.getElementById('valuesList');
    if (!list) return;
    const row = document.createElement('div');
    row.className = 'value-item';
    row.dataset.index = idx ?? list.children.length;
    row.innerHTML = `
        <div class="value-item__fields">
            <input type="text" placeholder="Icon (e.g. ⟳)" value="${escHtml(v.icon || '')}" data-field="icon">
            <input type="text" placeholder="Title" value="${escHtml(v.title || '')}" data-field="title">
            <input type="text" placeholder="Short description" value="${escHtml(v.desc || '')}" data-field="desc">
        </div>
        <button class="value-item__remove" title="Remove">✕</button>
    `;
    row.querySelector('.value-item__remove').addEventListener('click', () => {
        row.remove();
    });
    list.appendChild(row);
}

function readValues() {
    const rows = document.querySelectorAll('.value-item');
    return [...rows].map(row => ({
        icon:  row.querySelector('[data-field="icon"]')?.value?.trim()  || '',
        title: row.querySelector('[data-field="title"]')?.value?.trim() || '',
        desc:  row.querySelector('[data-field="desc"]')?.value?.trim()  || '',
    })).filter(v => v.title);
}

document.getElementById('btnAddValue')?.addEventListener('click', () => {
    addValueRow();
});

/* ─── ESCAPE HTML ────────────────────────────────────────── */
function escHtml(str) {
    return String(str ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

/* ─── INIT ───────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
    renderProjects();
    renderSkills();
    loadAboutForm();
});
